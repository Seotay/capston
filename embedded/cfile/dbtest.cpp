#include <iostream>
#include <mariadb/mysql.h>
#include <chrono>
#define DB_HOST "localhost"
#define DB_USER "root"
#define DB_PASS "admin"
#define DB_NAME "embedded"

char query[500];

int main() {
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

    /*query_stat = mysql_query(connection, "SELECT * FROM test");

    if(query_stat != 0) {
        fprintf(stderr, "Mysql Query Error : %s", mysql_error(&conn));
        return 1;
    }

    sql_result = mysql_store_result(connection);

    while((sql_row = mysql_fetch_row(sql_result)) != NULL) {
        std::cout << sql_row[0] << " " << sql_row[1] << " "<< sql_row[2] << " "<< sql_row[3] << "\n";
    }*/

    /*sprintf(query, "INSERT INTO test VALUES(%s, %s, %s, %s)", "1", "2", "3", "4");
    query_stat = mysql_query(connection, query);

    if(query_stat != 0){
        fprintf(stderr, "Mysql Query Error : %s", mysql_error(&conn));
        return 1;
    }*/

    auto now = std::chrono::system_clock::now();
    std::time_t tm_now = std::chrono::system_clock::to_time_t(now);
    struct tm tstruct = *localtime(&tm_now);

    char temp[128];
    snprintf(temp, sizeof(temp), "%04d-%02d-%02d %02d:%02d:%02d",
        tstruct.tm_year + 1900, tstruct.tm_mon + 1, tstruct.tm_mday,
        tstruct.tm_hour, tstruct.tm_min, tstruct.tm_sec);

    std::cout << temp;

    mysql_close(connection);
}