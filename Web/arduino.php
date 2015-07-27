<?php

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
  
 /*---------------------------------------------- PAGE INFO --------------------------------------------------

           		 This script is used by the arduino to save data from its sensors and from the
                 weather service to a MySQL database. It also sends email reports and email 
                 notifications.
		  
 ---------------------------------------------- PAGE INFO END ----------------------------------------------*/

 $pass=$_GET['p'];
 $inttemp=$_GET['t'];
 $inthum=$_GET['h'];
 $intlux=$_GET['l'];
 
 include('db.php');
 
 $dbpass = mysql_result(mysql_query("SELECT phppass FROM settings LIMIT 1;"),0);
 
 if($pass==$dbpass){
	 
	 $lasttime = strtotime(mysql_result(mysql_query("SELECT time FROM environment1 ORDER BY id DESC LIMIT 1"),0));
	 
	 include('libraries/forecast.io.php');
	 $api_key = mysql_result(mysql_query("SELECT weatherapi FROM settings LIMIT 1;"),0);
	 $latitude = floatval(mysql_result(mysql_query("SELECT weatherlat FROM settings LIMIT 1;"),0));
	 $longitude = floatval(mysql_result(mysql_query("SELECT weatherlong FROM settings LIMIT 1;"),0));
	 $units = 'si';
	 $lang = 'en';
	 $forecast = new ForecastIO($api_key, $units, $lang);
	 $condition = $forecast->getCurrentConditions($latitude, $longitude);
	
	 $exttemp = $condition->getTemperature();
	 $exthum = strval(floatval($condition->getHumidity())*100);
	 $conditions = $condition->getIcon();
	 
	 $insertsql="INSERT INTO environment1 (inttemp, exttemp, inthum, exthum, light, conditions) VALUES ('$inttemp', '$exttemp', '$inthum', '$exthum', '$intlux', '$conditions');";
	 mysql_query($insertsql, $conn);
	 
	 $emailtime = intval(implode(mysql_fetch_assoc(mysql_query("SELECT emailtime FROM settings ORDER BY id DESC LIMIT 1;"))));
	 
	 if(strtolower(date('D'))=="mon"&&intval(date('G'))==$emailtime&&intval(date('i'))>=1&&intval(date('i'))<=6){
	 	 $emaildate = implode(mysql_fetch_assoc(mysql_query("SELECT time FROM emaillogs ORDER BY id DESC LIMIT 1;")));
		 
		 if(intval(date('j',strtotime($emaildate)))!=intval(date('j'))){
		 	include('mail.php');
			
			$emailenabled = mysql_result(mysql_query("SELECT emailenabled FROM settings LIMIT 1"),0);
			$to = mysql_result(mysql_query("SELECT toemail FROM settings LIMIT 1"),0);
			$tofirstname = mysql_result(mysql_query("SELECT tofirstname FROM settings LIMIT 1"),0);
			$tolastname = mysql_result(mysql_query("SELECT tolastname FROM settings LIMIT 1"),0);
			$from = mysql_result(mysql_query("SELECT fromemail FROM settings LIMIT 1"),0);
			
			$rangestart = -168 - $emailtime;
			$rangestop = ($emailtime* -1);
			
			$inttemp = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "&#176;C";
			$inttempmin = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "&#176;C";
			$inttempmax = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "&#176;C";
			
			$exttemp = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "&#176;C";
			$exttempmin = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "&#176;C";
			$exttempmax = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "&#176;C";
			
			$inthum = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "%";
			$inthummin = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "%";
			$inthummax = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "%";
			
			$exthum = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "%";
			$exthummin = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "%";
			$exthummax = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . "%";
			
			$intlight = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . " lux";
			$intlightmin = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . " lux";
			$intlightmax = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "');")))),1)) . " lux";
			
			$weather = preg_replace('/[0-9]+/', '',ucwords(str_replace("-"," ",implode(mysql_fetch_assoc(mysql_query("SELECT conditions,COUNT(conditions) AS 'value_occurrence' FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestart) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($rangestop) . ' hours')) . "') GROUP BY conditions ORDER BY 'value_occurrence' DESC LIMIT 1;"))))));
				
			$subject = "SEM Weekly Report (" . date('d\/m\/Y',strtotime(strval(-8) . ' days')) . " - " . date('d\/m\/Y',strtotime(strval(-1) . ' days')) . " Week:" . date('W',strtotime(strval(-3) . ' days')) . ")";
			$message = 'Hi ' . $tofirstname . ',<br/>This is the SEM Report for last week.<br/><br/><strong>Average Internal Temperature: </strong>' . $inttemp . '<br/><strong>Minimum Internal Temperature: </strong>' . $inttempmin . '<br/><strong>Maximum Internal Temperature: </strong>' . $inttempmax . '<br/><br/><strong>Average External Temperature: </strong>' . $exttemp . '<br/><strong>Minimum External Temperature: </strong>' . $exttempmin . '<br/><strong>Maximum External Temperature: </strong>' . $exttempmax . '<br/><br/><strong>Average Internal Humidity: </strong>' . $inthum . '<br/><strong>Minimum Internal Humidity: </strong>' . $inthummin . '<br/><strong>Maximum Internal Humidity: </strong>' . $inthummax . '<br/><br/><strong>Average External Humidity: </strong>' . $exthum . '<br/><strong>Minimum External Humidity: </strong>' . $exthummin . '<br/><strong>Maximum External Humidity: </strong>' . $exthummax . '<br/><br/><strong>Average Internal Light: </strong>' . $intlight . '<br/><strong>Minimum Internal Light: </strong>' . $intlightmin . '<br/><strong>Maximum Internal Light: </strong>' . $intlightmax . '<br/><br/><strong>Most Common Weather: </strong>' . $weather . '<br/><p style="text-align: center; font-size: 18px; font-weight: bold;"><a href="http://sem.conorwalsh.net">Login to view more</a></p>Regards,<br/>SEM.</p>';
			
			if($emailenabled==1){
					
				$status = sendmail($to, $subject, $message, $from);
				
				if($status==TRUE){
					$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('report success');";
	 				mysql_query($insertsql, $conn);
				}
				else if($status==FALSE){
					$status1 = sendmail($to, $subject, $message, $from);
					if($status1==TRUE){
						$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('report success2');";
		 				mysql_query($insertsql, $conn);
					}
					else if($status1==FALSE){
						$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('report fail');";
		 				mysql_query($insertsql, $conn);
					}
				}
			}
		 }
		 
	 }

	$laststatusraw = explode(" ",mysql_result(mysql_query("SELECT emailstatus FROM emaillogs ORDER BY id DESC LIMIT 1;"),0));
    
    $laststatus = strtolower(strval($laststatusraw[0]));
    
 	if((time()-$lasttime)>240&&$laststatus=="offline"){
 		
		include('mail.php');
		
		$emailenabled1 = mysql_result(mysql_query("SELECT emailenabled FROM settings LIMIT 1"),0);
		$to1 = mysql_result(mysql_query("SELECT toemail FROM settings LIMIT 1"),0);
		$tofirstname1 = mysql_result(mysql_query("SELECT tofirstname FROM settings LIMIT 1"),0);
		$tolastname1 = mysql_result(mysql_query("SELECT tolastname FROM settings LIMIT 1"),0);
		$from1 = mysql_result(mysql_query("SELECT fromemail FROM settings LIMIT 1"),0);
		
		$subject1 = "SEM Online (" . date('l jS \of F Y g:i:s A') . ")";
		
		$message1 = 'Hi ' . $tofirstname1 . ',<br/>This is a notification from the SEM system.<br/><br/><strong style="font-weight: bold; color: #51A351; font-size: 18px;">The SEM device has started transmitting data again.</strong><br/><p style="text-align: center; font-size: 18px; font-weight: bold;"><a href="http://sem.conorwalsh.net">Login to view more</a></p>Regards,<br/>SEM.</p>';
				
		if($emailenabled1==1){
				
			$status2 = sendmail($to1, $subject1, $message1, $from1);
			
			if($status2==TRUE){
				$insertsql1="INSERT INTO emaillogs (emailstatus) VALUES ('online success');";
				mysql_query($insertsql1, $conn);
			}
			else if($status2==FALSE){
				$status3 = sendmail($to, $subject, $message, $from);
				if($status3==TRUE){
					$insertsql1="INSERT INTO emaillogs (emailstatus) VALUES ('online success2');";
	 				mysql_query($insertsql1, $conn);
				}
				else if($status3==FALSE){
					$insertsql1="INSERT INTO emaillogs (emailstatus) VALUES ('online fail');";
	 				mysql_query($insertsql1, $conn);
				}
			}
		}
		else {
			$insertsql1="INSERT INTO emaillogs (emailstatus) VALUES ('online');";
			mysql_query($insertsql1, $conn);
		}
	}

	mysql_close();
 }
 else{
	 echo "Invalid Code";
 }
?>