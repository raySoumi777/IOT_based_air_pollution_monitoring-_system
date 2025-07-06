#include <SPI.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>

#define SCREEN_WIDTH 128 // OLED display width, in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

// Declaration for an SSD1306 display connected to I2C (SDA, SCL pins)
#define OLED_RESET     -1 // Reset pin # (or -1 if sharing Arduino reset pin)
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);

#define NUMFLAKES     10 // Number of snowflakes in the animation example

#define LOGO_HEIGHT   16
#define LOGO_WIDTH    16
static const unsigned char PROGMEM logo_bmp[] =
{ B00000000, B11000000,
  B00000001, B11000000,
  B00000001, B11000000,
  B00000011, B11100000,
  B11110011, B11100000,
  B11111110, B11111000,
  B01111110, B11111111,
  B00110011, B10011111,
  B00011111, B11111100,
  B00001101, B01110000,
  B00011011, B10100000,
  B00111111, B11100000,
  B00111111, B11110000,
  B01111100, B11110000,
  B01110000, B01110000,
  B00000000, B00110000 };
   int smokeA0=A0;// Define the pin for the MQ-2 sensx4tb5or
  const int DOUTpin=8;
  int smokeA1=A1;// Define the pin for the MQ4 sensor
  int smokeA2=A2;
  int smokeA3=A3;
  int led2 = 9;//MQ-2
  int led4 = 3;//MQ-4
  int led7 = 7;
  int led8 = 11;
  int sT1=350;
  int sT2=300;
  int sT3=100;
  int sT4=100; 
 

void setup() {
  Serial.begin(9600);
  pinMode(smokeA0,INPUT);
  pinMode(smokeA1,INPUT);
  pinMode(smokeA2,INPUT);
  pinMode(smokeA3,INPUT);
  pinMode(led2,OUTPUT);
  pinMode(led4,OUTPUT);
  pinMode(led7,OUTPUT);
  pinMode(led8,OUTPUT);
  // SSD1306_SWITCHCAPVCC = generate display voltage from 3.3V internally
  if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) { 
    Serial.println(F("SSD1306 allocation failed"));
    for(;;); // Don't proceed, loop forever
  }

  // Show initial display buffer contents on the screen --
  // the library initializes this with an Adafruit splash screen.
  display.display();
  delay(2000); // Pause for 2 seconds

  // Clear the buffer
  display.clearDisplay();

  // Draw a single pixel in white
  display.drawPixel(10, 10, WHITE);

  // Show the display buffer on the screen. You MUST call display() after
  // drawing commands to make them visible on screen!
  display.display();
  delay(2000);
  

}

void loop() {

   testscrolltext();    // Draw scrolling text

  // Invert and restore display, pausing in-between
  display.invertDisplay(true);
  delay(1000);
  display.invertDisplay(false);
  delay(1000);

}


void testscrolltext() {
  display.clearDisplay();
  
  int analogSensor1 = analogRead(smokeA0)-150;
  int analogSensor2 = analogRead(smokeA1)-450;
  int analogSensor3 = analogRead(smokeA2)-500;
  int analogSensor4 = analogRead(smokeA3)-500;
  Serial.println("Pin A1:");//CO2
  Serial.println(analogSensor1);
  Serial.println("Pin A2:");//CH4
  Serial.println(analogSensor2);
  Serial.println("Pin A3:");//CO
  Serial.println(analogSensor3);
  Serial.println("Pin A4:");//NH3
  Serial.println(analogSensor4);
  display.setTextSize(2); // Draw 2X-scale text
  display.setTextColor(WHITE);
  display.setCursor(9, 0);
  display.print(F("CO2-> "));
  display.println(analogSensor1);
  display.setCursor(9, 15);
   display.print(F("CH4-> "));
  display.println(analogSensor2);
  display.setCursor(9, 30);
   display.print(F("CO -> "));
  display.println(analogSensor3);
  display.setCursor(9, 45);
   display.print(F("NH3-> "));
  display.println(analogSensor4);
  display.display();      // Show initial text
  delay(100);

  if(analogSensor1 > sT1){
  analogWrite(led2,200);
  delay(1000);
  analogWrite(led2,0);
  delay(1000);
 analogWrite(led2,200);
  delay(1000);
//  digitalWrite(greenled,LOW);
}
else{
  analogWrite(led2,0);
//  digitalWrite(greenled,HIGH);
}
if(analogSensor3 > sT3){
    analogWrite(led7,250);
    delay(1000);
    analogWrite(led7,0);
    delay(1000);
    analogWrite(led7,250);
    delay(1000);
  }
  else{
    analogWrite(led7,0);
  }
  //warning for high temparature
 if(analogSensor2 > sT2){
  analogWrite(led4,200);
  delay(1000);
  analogWrite(led4,0);
  delay(1000);
 analogWrite(led4,200);
  delay(1000);
//  digitalWrite(greenled,LOW);
}
else{
  analogWrite(led4,0);
//  digitalWrite(greenled,HIGH);
}
if(analogSensor4 > sT4){
  analogWrite(led8,200);
  delay(1000);
  analogWrite(led8,0);
  delay(1000);
 analogWrite(led8,200);
  delay(1000);
//  digitalWrite(greenled,LOW);
}
else{
  analogWrite(led8,0);
//  digitalWrite(greenled,HIGH);
}


  // Scroll in various directions, pausing in-between:
  display.startscrollright(0x00, 0x0F);
  delay(2000);
  display.stopscroll();
  delay(1000);
  display.startscrollleft(0x00, 0x0F);
  delay(2000);
  display.stopscroll();
  delay(1000);
  display.startscrolldiagright(0x00, 0x07);
  delay(2000);
  display.startscrolldiagleft(0x00, 0x07);
  delay(2000);
  display.stopscroll();
  delay(1000);
}
