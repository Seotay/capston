
#define motorAA 3
#define motorAB 5

void setup() {
  Serial.begin(9600);
  pinMode(motorAA, OUTPUT);
  pinMode(motorAB, OUTPUT);
}

void loop() {
  if(Serial.available()) {
    char c = Serial.read();

    if(c == 'A') {
      digitalWrite(motorAA, HIGH);
      digitalWrite(motorAB, LOW);
      return;
    }
    if(c == 'B') {
      digitalWrite(motorAA, LOW);
      digitalWrite(motorAB, LOW);
      return;
    }
  }
  // put your main code here, to run repeatedly:
  /*digitalWrite(motorAA, HIGH);
  digitalWrite(motorAB, LOW);
  delay(2000);

  digitalWrite(motorAA, LOW);
  digitalWrite(motorAB, LOW);
  delay(2000);*/
}
