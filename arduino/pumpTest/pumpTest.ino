int pumpPin = 4;

void setup() {
  // put your setup code here, to run once:
  pinMode(pumpPin, OUTPUT);
  Serial.begin(9600);
}

void loop() {
  // put your main code here, to run repeatedly:

  if(Serial.available() > 0){
    char command = Serial.read();
    
    if(command == '0') {
      digitalWrite(pumpPin, HIGH);
    }
    else if(command == '1') {
      digitalWrite(pumpPin, LOW);
    }
  }
}
