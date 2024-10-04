#include <DHT.h>

unsigned long previousMillis = 0;
const long sensorInterval = 10000;

#define DHTPIN A0  // DHT11 센서 핀 (아날로그 0번 핀)
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

const int lightSensorPin = A1;  // 조도 센서 핀 (아날로그 1번 핀)
const int soilMoisturePin = A2; // 토양 수분 센서 핀 (아날로그 2번 핀)

// 모터 핀 (디지털 4, 5번)
const int motorPinA = 4; // A-1A 핀 (검은선)
const int motorPinB = 5; // A-1B 핀 (빨간선)

const int ledPinR = 8;  // 빨간색 (디지털  8번 핀)
const int ledPinG = 9;  // 초록색 (디지털  9번 핀)
const int ledPinB = 10; // 파란색 (디지털 10번 핀)

void setup() {
  Serial.begin(9600);
  dht.begin();

  pinMode(motorPinA, OUTPUT);
  pinMode(motorPinB, OUTPUT);

  pinMode(ledPinR, OUTPUT);
  pinMode(ledPinG, OUTPUT);
  pinMode(ledPinB, OUTPUT);
}

void loop() {
  ReadSensorValue();
  ControlUnit();
}

void ReadSensorValue() {
  unsigned long currentMillis = millis();

   if (currentMillis - previousMillis >= sensorInterval) {
    previousMillis = currentMillis;

    float temperature = dht.readTemperature();
    float humidity = dht.readHumidity();
    int lightLevel = analogRead(lightSensorPin);
    int lightPercent = map(lightLevel, 1000, 0, 0, 100);
    int soilMoistureLevel = analogRead(soilMoisturePin);

    Serial.println(temperature);
    Serial.println(humidity);
    Serial.println(lightLevel);
    Serial.println(soilMoistureLevel);
  }
}

void ControlUnit() {
    if(Serial.available() > 0){
      char command = Serial.read();

      if(command == '0') {
        digitalWrite(motorPinA, HIGH);
      }
      else if(command == '1') {
        digitalWrite(motorPinA, LOW);
      }
      else if(command == '2') {
        digitalWrite(ledPinR, 255);
        digitalWrite(ledPinG, 255);
        digitalWrite(ledPinB, 255);
      }
      else if(command == '3') {
        digitalWrite(ledPinR, 0);
        digitalWrite(ledPinG, 0);
        digitalWrite(ledPinB, 0);
      }
      else if(command == '4') {

      }
      else if(command == '5') {

      }
  }
}
