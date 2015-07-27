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

          		This script is used by the settings page to update the sms settings in a MySQL
                database.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------*/

include("adminsession.php");
{
	$tosms=mysql_real_escape_string($_POST['tosms']);
	
	$tosmsfirstname=mysql_real_escape_string($_POST['tosmsfirstname']);
	
	$tosmslastname=mysql_real_escape_string($_POST['tosmslastname']);
	
	$smscheck=mysql_real_escape_string($_POST['smscheck']);
	
	$smsenabled = 0;
	
	if($smscheck=="true"){
		$smsenabled=1;
	}
	
	$blank = 0;
	
	if(strlen($tosms)<1||strlen($tosmsfirstname)<1||strlen($tosmslastname)<1){
		$blank = 1;
	}
	
	if($smsenabled==1&&$blank==1){
		header("Location:settings.php?smschanged=blank");
	}
	else{		
		if(!ctype_alnum($tosms)||$emailenabled!=1){
			$result;
			
			if($smsenabled!=1){
				$sql="UPDATE settings SET smsenabled='0' WHERE id='1'";
				$result=mysql_query($sql);
			}
			else {
				$sql="UPDATE settings SET smsenabled='1', tosms='$tosms', tosmsfirstname='$tosmsfirstname', tosmslastname='$tosmslastname'  WHERE id='1'";
				$result=mysql_query($sql);
			}
			
			if($result){
				header("Location:settings.php?smschanged=true");
			}
			else {
				header("Location:settings.php?smschanged=false");
			}
		}
		else {
			header("Location:settings.php?smschanged=invalid");
		}
	}
}
?>
