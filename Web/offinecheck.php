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

           	This script is run every 15 minutes by a cronjob to check if the SEM device
                is still online and if not it informs the user.
		  
 ---------------------------------------------- PAGE INFO END ----------------------------------------------*/
 
 $pass=$_GET['p'];
 
 include('db.php');
 
 $dbpass = mysql_result(mysql_query("SELECT phppass FROM settings LIMIT 1;"),0);
 
 if($pass==$dbpass){
    
    $time = strtotime(mysql_result(mysql_query("SELECT time FROM environment1 ORDER BY id DESC LIMIT 1"),0));

    $timesince = round((time()-$time)/60);
    
    $laststatusraw = explode(" ",mysql_result(mysql_query("SELECT emailstatus FROM emaillogs ORDER BY id DESC LIMIT 1;"),0));
    
    $laststatus = strtolower(strval($laststatusraw[0]));
    
 	if((time()-$time)>240&&$laststatus!="offline"){
 		
	    include('mail.php');
		
		$emailenabled = mysql_result(mysql_query("SELECT emailenabled FROM settings LIMIT 1"),0);
		$to = mysql_result(mysql_query("SELECT toemail FROM settings LIMIT 1"),0);
		$tofirstname = mysql_result(mysql_query("SELECT tofirstname FROM settings LIMIT 1"),0);
		$tolastname = mysql_result(mysql_query("SELECT tolastname FROM settings LIMIT 1"),0);
		$from = mysql_result(mysql_query("SELECT fromemail FROM settings LIMIT 1"),0);
		
		$subject = "SEM Offline Warning (" . date('l jS \of F Y g:i:s A') . ")";
		
		$message = 'Hi ' . $tofirstname . ',<br/>This is a warning from the SEM system.<br/><br/><strong style="font-weight: bold; color: #BD362F; font-size: 18px;">The SEM device stopped transmitting data ' . $timesince . ' minutes ago. We recommend restarting the device.</strong><br/><p style="text-align: center; font-size: 18px; font-weight: bold;"><a href="http://sem.conorwalsh.net">Login to view more</a></p>Regards,<br/>SEM.</p>';
				
		if($emailenabled==1){
				
			$status = sendmail($to, $subject, $message, $from);
			
			if($status==TRUE){
				//$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('offline email success');";
				$insertsql="INSERT INTO emaillogs (emailstatus, time) VALUES ('offline email success', '" . date("Y\-m\-d H\:i\:s" ,strtotime("-" . $timesince . " minutes")) . "');";
				mysql_query($insertsql, $conn);
			}
			else if($status==FALSE){
				$status1 = sendmail($to, $subject, $message, $from);
				if($status1==TRUE){
					//$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('offline email success2');";
					$insertsql="INSERT INTO emaillogs (emailstatus, time) VALUES ('offline email success2', '" . date("Y\-m\-d H\:i\:s" ,strtotime("-" . $timesince . " minutes")) . "');";
	 				mysql_query($insertsql, $conn);
				}
				else if($status1==FALSE){
					//$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('offline email fail');";
					$insertsql="INSERT INTO emaillogs (emailstatus, time) VALUES ('offline email fail', '" . date("Y\-m\-d H\:i\:s" ,strtotime("-" . $timesince . " minutes")) . "');";
	 				mysql_query($insertsql, $conn);
				}
			}
		}
		else{
			//$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('offline');";
			$insertsql="INSERT INTO emaillogs (emailstatus, time) VALUES ('offline', '" . date("Y\-m\-d H\:i\:s" ,strtotime("-" . $timesince . " minutes")) . "');";
			mysql_query($insertsql, $conn);
		}

		$smsenabled = mysql_result(mysql_query("SELECT smsenabled FROM settings LIMIT 1"),0);
		$tosms = mysql_result(mysql_query("SELECT tosms FROM settings LIMIT 1"),0);
		$tosmsfirstname = mysql_result(mysql_query("SELECT tosmsfirstname FROM settings LIMIT 1"),0);
		$tosmslastname = mysql_result(mysql_query("SELECT tosmslastname FROM settings LIMIT 1"),0);
		$from = mysql_result(mysql_query("SELECT fromemail FROM settings LIMIT 1"),0);
		$message = 'Hi ' . $tosmsfirstname . '. The SEM device stopped transmitting data ' . $timesince . ' minutes ago. We recommend restarting the device. Sent: ' . date('G:i d\/m\/Y') . '.';
		
		if($smsenabled==1){
			
			$smsemailsubject = " ";
			$smsemailtxt = "api_id:\nuser:\npassword:\nto:" . $tosms . "\nfrom:\ntext:" . $message . "\n";
			$to = "sms@messaging.clickatell.com";
			$headers = "From: $from";
							
			if(mail($to,$smsemailsubject,$smsemailtxt,$headers)){
				//$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('offline sms success');";
				$insertsql="INSERT INTO emaillogs (emailstatus, time) VALUES ('offline sms success', '" . date("Y\-m\-d H\:i\:s" ,strtotime("-" . $timesince . " minutes")) . "');";
				mysql_query($insertsql, $conn);
			}
			else{
				if(mail($to,$smsemailsubject,$smsemailtxt,$headers)){
					//$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('offline sms success2');";
					$insertsql="INSERT INTO emaillogs (emailstatus, time) VALUES ('offline sms success2', '" . date("Y\-m\-d H\:i\:s" ,strtotime("-" . $timesince . " minutes")) . "');";
	 				mysql_query($insertsql, $conn);
				}
				else{
					//$insertsql="INSERT INTO emaillogs (emailstatus) VALUES ('offline sms fail');";
					$insertsql="INSERT INTO emaillogs (emailstatus, time) VALUES ('offline sms fail', '" . date("Y\-m\-d H\:i\:s" ,strtotime("-" . $timesince . " minutes")) . "');";
	 				mysql_query($insertsql, $conn);
				}
			}
		}
	}
    mysql_close();
 }
 else{
	 echo "Invalid Code";
 }
?>
