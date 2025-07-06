
#include <ArduinoJson.h>
#include <ArduinoJson.hpp>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>
#include <Base64.h>
#include <dht11.h>
#define DHT11PIN D4
int led = D3;
int buzzer = D6;
int enA = D0;
int in1 = D1;
int in2 = D2;
//#include <ArduinoJson.h>
 dht11 DHT11;
const char *ssid ="Kumro";// "Kumro"; //Enter your WIFI ssid
const char *password = "fata1234";//"fata1234"; //Enter your WIFI password
const char *server_url = "http://192.168.40.253:3030/postData";// Nodejs application endpoint
const char* accountSid = "AC3aa5d9c250a14de5719acf256673cc7d";
const char* authToken = "b63556777fcd1b3d3a1208ad0b911cf1";
const char* fromNumber = "+13184884923";
const char* toNumber = "+916291219824";
StaticJsonDocument<256> jsonBuffer;
// Set up the client objet
WiFiClient client;
HTTPClient http;

void setup() {
  // pinMode(A0,INPUT);
  // delay(3000);
//  Wire.begin(D2,D1);
   pinMode(enA, OUTPUT);
   pinMode(in1, OUTPUT);
  pinMode(in2, OUTPUT);
  digitalWrite(in1, LOW);
  digitalWrite(in2, LOW);
   pinMode(led, OUTPUT);
    pinMode(buzzer, OUTPUT);
   Serial.begin(9600);
   //pinMode(fan,OUTPUT);
   WiFi.begin(ssid, password);
   while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
   }
   Serial.println("WiFi connected");
   delay(1000);
   
}
//void datapost(int value){
// 
//}
void twillow(){
   WiFiClientSecure client;
  client.setInsecure();
  if (!client.connect("api.twilio.com", 443)) {
    Serial.println("Connection failed!");
    return;
  }

  String message = "Hello from NodeMCU!";
  String url = "/2010-04-01/Accounts/" + String(accountSid) + "/Messages.json";
  String auth = String(accountSid) + ":" + String(authToken);
  String encodedAuth = base64::encode(auth);

  String postData = "To=" + String(toNumber) + "&From=" + String(fromNumber) + "&Body=" + message;
  String header = "POST " + url + " HTTP/1.1\r\n" +
                  "Host: api.twilio.com\r\n" +
                  "Authorization: Basic " + encodedAuth + "\r\n" +
                  "Content-Type: application/x-www-form-urlencoded\r\n" +
                  "Content-Length: " + String(postData.length()) + "\r\n" +
                  "Connection: close\r\n\r\n";

  client.print(header + postData);
  delay(500);

  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

  Serial.println("\nMessage sent!");
  delay(5000);
}

void loop() {
  //value=analogRead(A0);
   int chk = DHT11.read(DHT11PIN);
   float temp=(float)DHT11.temperature;
  String value,val1="";
  Serial.println("agayakk");
   Serial.print("Temperature:");
  Serial.println((float)DHT11.temperature, 2);
  if(temp>40){
      Serial.println("agaya");
      twillow();
      digitalWrite(led,HIGH);
      digitalWrite(buzzer,HIGH);
      
    
  }
  //value=220;
   if(Serial.available()>0){
     value=Serial.readString();
    Serial.print(value);
    
     
   http.begin(client, server_url);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
   String data= "&value="+String(value);
    int httpCode = http.POST(data); 
    if(httpCode > 0){
      if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
          String payload = http.getString();
          Serial.print("Response: ");//Serial.println(payload);
        }
    }else{
         Serial.printf("[HTTP] GET... failed, error: %s");
    }
    http.end();
   }
delay(5000);
}
