SEM: Smart Environment Monitoring
=============

Description
-----------

**SEM:** **S**mart **E**nvironment **M**onitoring system is an Arduino and web based (PHP) system that monitors, records and analyses environmental metrics both inside and outside (using external service) of the room that the Arduino device is located in.

Installation
-----------

1. Download or clone this repository.
2. Setup a MySQL database using the sem.sql file in the SQL folder.
3. Change the settings in the db.php file in the web folder to connect to your MySQl server.
4. Upload all the files in the Web folder to your server.
5. Setup a cronjob to run the offinecheck.php file every 15 minutes it checks if the device is online and if not it sends an email.
6. The weather information is provided by developer.forecast.io and this service requires a unique api key which can be acquired br registering here (developer.forecast.io). The system allows a 1000 free api calls per api per day but the SEM system only uses roughly 470 api calls per day so this service should be free.
7. Login to your system using the default username (admin) and password (admin).
8. Go to the settings page (click your username in the top right hand corner and click settings) on this page you need to setup the email reports and external weather settings.
9. Build the circuit that is shown in the Schematics folder with an Arduino Yún. This project uses an Arduino Yún because of its onboard wifi which makes it very portable but the code can be modified to use and Arduino Uno or Mega with an Ethernet or wifi shield.
10. Change the url on line 80 of the Arduino code in the Arduino folder to the location of your arduino.php file.
11. Upload the Arduino code to the Arduino.
That should be it but if you run into any problems just send me an email.

Credits
------

The web system interface is based on this template sb admin from <a href="http://startbootstrap.com/template-overviews/sb-admin/" target="_blank">Startbootstrap.com/template-overviews/sb-admin</a>.<br/>
The web system uses font awesome from <a href="http://fontawesome.io/" target="_blank">Fontawesome.io</a>.<br/>
The original weather icons are from <a href="http://customicondesign.deviantart.com/art/Beautiful-Weather-Icon-Set-208760113" target="_blank">Customicondesign.deviantart.com/art/Beautiful-Weather-Icon-Set-208760113</a>.<br/>
Forecast.io weather php libray from <a href="https://github.com/tobias-redmann/forecast.io-php-api" target="_blank">Github.com/tobias-redmann/forecast.io-php-api</a>.<br/>
Arduino Lux mesurement using an LDR and an Arduino from <a href="https://arduinodiy.wordpress.com/2013/11/03/measuring-light-with-an-arduino/" target="_blank">Arduinodiy.wordpress.com/2013/11/03/measuring-light-with-an-arduino</a>.<br/>
Basic PHP mail script from <a href="http://online-code-generator.com/html-email-starter-script.php" target="_blank">Online-code-generator.com/html-email-starter-script.php</a>.

License (MIT)
------
Copyright (c) 2015 Conor Walsh 

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

Thanks
------

Thank you for taking the time to look at this project I hope that it is of use to you,<br/>
<img src="http://conorwalsh.net/sig.png" /><br/>
Conor Walsh.
