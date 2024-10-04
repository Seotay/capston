#include <DHT.h>

#define DHTPIN A0  // DHT11 센서 핀 (아날로그 0번 핀)
#define DHTTYPE DHT11  // DHT11 센서 타입 정의
DHT dht(DHTPIN, DHTTYPE);

const int lightSensorPin = A1;  // 조도 센서 핀 (아날로그 1번 핀)
const int soilMoisturePin = A2; // 토양 수분 센서 핀 (아날로그 2번 핀)

// 모터 핀 (디지털 4, 5번)
const int motorPinA = 5; // A-1A 핀 (검은선)
const int motorPinB = 4; // A-1B 핀 (빨간선)

const int ledPinR = 11;  // 빨간색 (디지털  8번 핀)
const int ledPinG = 10;  // 초록색 (디지털  9번 핀)
const int ledPinB = 9; // 파란색 (디지털 10번 핀)

// 블루투스 모듈 핀
#define bluetoothSerial Serial1

void setup() {
  Serial.begin(9600);
  dht.begin(); // DHT11 센서 초기화

   // 모터 핀을 출력 모드로 설정
  pinMode(motorPinA, OUTPUT);
  pinMode(motorPinB, OUTPUT);

  // 모터 테스트: 한 방향으로 회전
  digitalWrite(motorPinA, HIGH); // A-1A에 HIGH 신호
  digitalWrite(motorPinB, LOW);  // A-1B에 LOW 신호

  // LED 핀을 출력 모드로 설정
  pinMode(ledPinR, OUTPUT);
  pinMode(ledPinG, OUTPUT);
  pinMode(ledPinB, OUTPUT);
  
  // 블루투스 시리얼 초기화
  bluetoothSerial.begin(9600); // HC-06 기본 보드레이트는 9600
  
  // 블루투스 모듈 연결 확인
  Serial.println("Bluetooth module initialized.");
  bluetoothSerial.println("Bluetooth is ready.");
}

void loop() {
  // DHT11 센서 읽기
  float temperature = dht.readTemperature(); // 섭씨 온도 읽기
  float humidity = dht.readHumidity(); // 습도 읽기
  
  // 조도 센서 값 읽기, 0~100%로 변환하기
  int lightLevel = analogRead(lightSensorPin);
  int lightPercent = map(lightLevel, 1000, 0, 0, 100);

  // 토양 수분 센서 값 읽기
  int soilMoistureLevel = analogRead(soilMoisturePin);

  // 측정 결과 출력
  Serial.println("----------- Sensor Readings -----------");
  
  if (isnan(temperature) || isnan(humidity)) {
    Serial.println("DHT11 Sensor Error!");
  } else {
    Serial.print("Temperature: ");
    Serial.print(temperature);
    Serial.println("℃");

    Serial.print("Humidity: ");
    Serial.print(humidity);
    Serial.println("%");
  }

  Serial.print("Light: ");
  Serial.print(lightLevel);
  Serial.print("(");
  Serial.print(lightPercent);
  Serial.println("%)");

  Serial.print("Soil Moisture Level: ");
  Serial.println(soilMoistureLevel);

  // LED ON (R, G, B : 0~255로 조절)
  digitalWrite(ledPinR, 255);
  digitalWrite(ledPinG, 255);
  digitalWrite(ledPinB, 255);

  // 블루투스 메시지 수신 확인 (현재 미작동)
  if (bluetoothSerial.available()) {
    String receivedData = bluetoothSerial.readString(); // 받은 메시지를 읽음
    Serial.print("Received via Bluetooth: ");
    Serial.println(receivedData);
  }

  Serial.println("--------------------------------------");
  
  // 1초에 한번 측정
  delay(1000);
}