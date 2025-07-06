// MQ4 Gas Sensor Example Code
#include <LiquidCrystal.h>
#include <LiquidCrystal_I2C.h>
int sensorValue1 =0;
int sensorValue2 =0;
int sensorValue3 =0;
int sensorValue4 =0;
int MQ4_PIN = A0; // Define the pin for the MQ4 sensor
int MQ2_PIN = A1; // Define the pin for the MQ-2 sensor
int MQ7_PIN = A2; // Define the pin for the MQ-7 sensor
int MQ135_PIN = A3; // Define the pin for the MQ-7 sensor
int led2 = 6;
int led4 = 3;
int led = 7;
LiquidCrystal_I2C lcd = LiquidCrystal_I2C(0x27, 16, 2);
int buzzer = 8;
//int touch = 7;

void setup() {
  Serial.begin(9600); // Start the serial communication
  pinMode(MQ4_PIN,INPUT);
  pinMode(MQ2_PIN,INPUT);
  pinMode(MQ7_PIN,INPUT);
  pinMode(MQ135_PIN,INPUT);
  pinMode(led,OUTPUT);
  lcd.init();
  lcd.backlight();
//  pinMode(buzzer,OUTPUT);
 
}
//void (*resetFunc)(void)=0;

// void reset(){
//   byte state=digitalRead(touch);
//   if(state=LOW){
//     resetFunc();
//   }
//   delay(100);
//   //read();

// }
void loop() {

  // digitalWrite(led,LOW);
  // digitalWrite(buzzer,LOW);
  
  sensorValue1 = analogRead(MQ4_PIN); // Read the analog value from the MQ4 sensor  
  Serial.print("CO2: ");  
  Serial.println(sensorValue1);
  
  
  sensorValue2 = analogRead(MQ2_PIN);
  Serial.print("CH4: ");  
  Serial.println(sensorValue2);

  lcd.setCursor(2, 0);
  lcd.print("CO2: ");
  lcd.setCursor(2, 1);
  lcd.print("CH4: "); 
  lcd.setCursor(7, 0);
  lcd.print(sensorValue1);
  lcd.setCursor(7, 1);
  lcd.print(sensorValue2); 
  if(sensorValue1>20){

    analogWrite(led2,100);
  }
  else if(sensorValue1>50){
    analogWrite(led2,250);
  }
  else{
    analogWrite(led2,0);
  }
   if(sensorValue2>100){
    analogWrite(led4,100);
  }
  else if(sensorValue2>200){
    analogWrite(led4,250);
  }
  else{
    analogWrite(led4,0);
  }

  delay(2000);
  // sensorValue3 += analogRead(MQ7_PIN);
  // sensorValue4 += analogRead(MQ135_PIN);
  int avg=((sensorValue1+sensorValue2 )/2);
  //Serial.println(avg);
  if(avg>100){
    digitalWrite(led,HIGH);
    analogWrite(led4,0);
    analogWrite(led2,0);
    digitalWrite(buzzer,HIGH);
  }
  else{
    digitalWrite(led,LOW);
  }
  // Serial.print(" : MQ2 PPM: "); 
  // Serial.print(sensorValue2);
  // Serial.print(" : MQ7 PPM: "); 
  // Serial.print(sensorValue3);
  // Serial.print(" : MQ135 PPM: "); 
  // Serial.println(sensorValue4);
  delay(1000);
 // int avg=(sensorValue1+sensorValue2+sensorValue3+sensorValue4)/4;
//  Serial.println(avg);
  
  }
