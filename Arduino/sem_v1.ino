
 /*-------------------------------------------- LICENSE (MIT) -------------------------------------------------

         				                        Copyright (c) 2015 Conor Walsh
         			                        Website: http://www.conorwalsh.net
                                    GitHub:  https://github.com/conorwalsh
                             Project: Smart Environment Monitoring system (S.E.M.)
        
        		Permission is hereby granted, free of charge, to any person obtaining a copy
        		of this software and associated documentation files (the "Software"), to deal
        		in the Software without restriction, including without limitation the rights
        		to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
        		copies of the Software, and to permit persons to whom the Software is
        		furnished to do so, subject to the following conditions:
        		
        		The above copyright notice and this permission notice shall be included in all
        		copies or substantial portions of the Software.
        		
        		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
        		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
        		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
        		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
        		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
        		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
        		SOFTWARE.
        	   __  __   ____                        __        __    _     _       ____   ___  _ ____  
        	  / /__\ \ / ___|___  _ __   ___  _ __  \ \      / /_ _| |___| |__   |___ \ / _ \/ | ___| 
        	 | |/ __| | |   / _ \| '_ \ / _ \| '__|  \ \ /\ / / _` | / __| '_ \    __) | | | | |___ \ 
        	 | | (__| | |__| (_) | | | | (_) | |      \ V  V / (_| | \__ \ | | |  / __/| |_| | |___) |
        	 | |\___| |\____\___/|_| |_|\___/|_|       \_/\_/ \__,_|_|___/_| |_| |_____|\___/|_|____/ 
        	  \_\  /_/                                                                                
        		  
 ----------------------------------------------- LICENSE END -----------------------------------------------*/

 /*---------------------------------------------- CODE INFO --------------------------------------------------

             	This code runs on an Arduino Yún and sends sensor data to a MySQL database
             	every 3 minutes.
		  
 ---------------------------------------------- CODE INFO END ----------------------------------------------*/
 

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
