int pumpPin = 22;

void setup() {
  // put your setup code here, to run once:
  pinMode(pumpPin, OUTPUT);
  Serial.begin(9600);
}

void loop() {
  // put your main code here, to run repeatedly:
  digitalWrite(pumpPin, LOW);
}
