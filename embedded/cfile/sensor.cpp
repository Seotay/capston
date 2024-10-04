#include <iostream>
#include <cstring>
#include <chrono>
#include <mariadb/mysql.h>
#include <errno.h>
#include <unistd.h>
#include <sys/types.h>
#include <wiringPi.h>
#include <wiringPiSPI.h>
#include <mariadb/mysql.h>

//데이터베이스 호스트, 사용자, 비밀번호, 데이터베이스 이름 정의
#define DB_HOST "localhost"
#define DB_USER "root"
#define DB_PASS "admin"
#define DB_NAME "embedded"

//아두이노 센서 정의
#define CS_MCP3208 8 //GPIO 8
#define SPI_CHANNEL 0
#define SPI_SPEED 1000000 //1Mhz
#define MAXTIMINGS 85
float temperature, humidity;
static int DHTPIN = 7;
static int dht22_dat[5] = {0,0,0,0,0};

char query[500];

static uint8_t sizecvt(const int read) {
    if (read > 255 || read < 0) {
        printf("Invalid data from wiringPi library\n");
        exit(EXIT_FAILURE);
    }

    return (uint8_t)read;
}

//온도 습도 측정 함수
int read_dht22_dat() {
    uint8_t laststate = HIGH;
    uint8_t counter = 0;
    uint8_t j = 0, i;
    dht22_dat[0] = dht22_dat[1] = dht22_dat[2] = dht22_dat[3] = dht22_dat[4] = 0;

    pinMode(DHTPIN, OUTPUT);
    digitalWrite(DHTPIN, HIGH);
    delay(10);
    digitalWrite(DHTPIN, LOW);
    delay(18);

    digitalWrite(DHTPIN, HIGH);
    delayMicroseconds(40);

    pinMode(DHTPIN, INPUT);

    for (i = 0; i < MAXTIMINGS; i++) {
        counter = 0;
        while (sizecvt(digitalRead(DHTPIN)) == laststate) {
            counter++;
            delayMicroseconds(1);
            if (counter == 255)
            {
                break;
            }
        }
        laststate = sizecvt(digitalRead(DHTPIN));
        if (counter == 255)
            break;

        if ((i >= 4) && (i % 2 == 0)) {
            dht22_dat[j / 8] <<= 1;
            if (counter > 16)
                dht22_dat[j / 8] |= 1;
            j++;
        }
    }
    // check we read 40 bits (8bit x 5 ) + verify checksum in the last byte
    // print it out if data is good
    if ((j >= 40) && (dht22_dat[4] == ((dht22_dat[0] + dht22_dat[1] + dht22_dat[2] + dht22_dat[3]) & 0xFF))) {
        float t, h;
        h = (float)dht22_dat[0] * 256 + (float)dht22_dat[1];
        h /= 10;
        t = (float)(dht22_dat[2] & 0x7F) * 256 + (float)dht22_dat[3];
        t /= 10.0;
        if ((dht22_dat[2] & 0x80) != 0)
            t *= -1;

        //전역변수로 된 온도, 습도 값 변경
        temperature = t;
        humidity = h;

        return 1;
    }
    else {
        return 0;
    }
}

//조도센서 값 읽기
int read_mcp3208_adc(unsigned char adcChannel) {
    unsigned char buff[3];
    int adcValue = 0;

    buff[0] = 0x06 | ((adcChannel & 0x07) >> 2);
    buff[1] = ((adcChannel & 0x07) << 6);
    buff[2] = 0x00;
    digitalWrite(CS_MCP3208, 0);
    wiringPiSPIDataRW(SPI_CHANNEL, buff, 3);
    buff[1] = 0x0f & buff[1];
    adcValue = (buff[1] << 8) | buff[2];
    digitalWrite(CS_MCP3208, 1);

    return adcValue;
}

char* getCurrentDate() {
    auto now = std::chrono::system_clock::now();
    std::time_t tm_now = std::chrono::system_clock::to_time_t(now);
    struct tm tstruct = *localtime(&tm_now);

    static char date[128];
    snprintf(date, sizeof(date), "%04d-%02d-%02d %02d:%02d:%02d",
        tstruct.tm_year + 1900, tstruct.tm_mon + 1, tstruct.tm_mday,
        tstruct.tm_hour, tstruct.tm_min, tstruct.tm_sec);

    return date;
}

int main(void) {
    unsigned char adcChannel_light = 0;
    int adcValue_light = 0;

    //DB Connect
    MYSQL* connection = NULL, conn;
    MYSQL_RES* sql_result;
    MYSQL_ROW sql_row;
    int query_stat;

    mysql_init(&conn);

    connection = mysql_real_connect(&conn, DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306, (char*)NULL, 0);

    if(connection == NULL) {
        fprintf(stderr, "Mysql Connection Error : %s", mysql_error(&conn));
        return 1;
    }

    //Sensor Connect
    if (wiringPiSetup() == -1) {
        exit(EXIT_FAILURE);
    }

    if (setuid(getuid()) < 0) {
        perror("Dropping privileges failed\n");
        exit(EXIT_FAILURE);
    }

    printf("start\n");

    if (wiringPiSetupGpio() == -1) {
        fprintf(stdout, "Unable to start wiringPi :%s\n", strerror(errno));
        return 1;
    }
    if (wiringPiSPISetup(SPI_CHANNEL, SPI_SPEED) == -1) {
        fprintf(stdout, "wiringPiSPISetup Failed :%s\n", strerror(errno));
        return 1;
    }

    pinMode(CS_MCP3208, OUTPUT);

    while (1) {
        adcValue_light = read_mcp3208_adc(adcChannel_light);

        while(read_dht22_dat() == 0) {
            delay(500);
        }
        //printf("light sensor = %d, temp : %.2f, humidity : %.2f\n", adcValue_light, temperature, humidity);
        
        //쿼리문 실행 -- 현재날짜, 온도, 습도, 조도 순으로 들어가는 중
        //테이블에는 6개의 컬럼이 있으나, serial_no는 자동입력, 토양수분은 측정불가
        char* date = getCurrentDate();
        sprintf(query, "INSERT INTO sensor(date, temp, humidity, illumination) VALUES ('%s', '%f', '%f', '%d')", 
            date, temperature, humidity, adcValue_light);
        query_stat = mysql_query(connection, query);

        printf("%s 저장\n", date);

        if(query_stat != 0){
            fprintf(stderr, "Mysql Query INSERT Error : %s", mysql_error(&conn));
            return 1;
        }

        //1000 * 원하는 초 현재는 10초마다 데이터베이스에 저장
        delay(1000 * 10);
    }

    mysql_close(connection);

    return 0;
}
