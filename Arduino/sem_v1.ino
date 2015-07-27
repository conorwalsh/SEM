#include <Bridge.h>
#include <HttpClient.h>
#include "DHT.h"
#define DHTPIN 2     // what pin we're connected to

#define DHTTYPE DHT22

DHT dht(DHTPIN, DHTTYPE);

double Light (int RawADC0){
  double Vout=RawADC0*0.0048828125;
  int lux=(2500/Vout-500)/10;
  return lux;
}

  String pass = "semcw2015";
  int sendled = 3;

void setup() {
  pinMode(13, OUTPUT);
  digitalWrite(13, LOW);
  Bridge.begin();
  digitalWrite(13, HIGH);
  
  pinMode(sendled, OUTPUT);
  
  dht.begin();
  delay(1000);
}

void loop() {
  
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  int l = Light(analogRead(A0));
  
  HttpClient client;
  
  client.get("http://sem.conorwalsh.net/arduino.php?p=" + pass + "&t=" + String(t) + "&h=" + String(h) + "&l=" + String(l));
  
  digitalWrite(sendled, HIGH);
  delay(1000);
  digitalWrite(sendled, LOW); 
  
  delay(180000);
}
