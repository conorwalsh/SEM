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

  		This script is used by the settings page to update the weather settings in a MySQL
                database.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------*/
	
	include("adminsession.php");
	{
		$apitext=mysql_real_escape_string($_POST['apitext']);
		
		$lat=mysql_real_escape_string($_POST['lat']);
		
		$long=mysql_real_escape_string($_POST['long']);
		
		if(strlen($apitext)<1||strlen($lat)<1||strlen($long)<1){
			header("Location:settings.php?weatherchanged=blank");
		}
		else{
			$lat = number_format(floatval($lat),6);
			
			$long = number_format(floatval($long),6);
			
			if(substr(strval($lat), -3)=="000"){
				header("Location:settings.php?weatherchanged=latinvalid");
			}
			else{
				if(substr(strval($long), -3)=="000"){
					header("Location:settings.php?weatherchanged=longinvalid");
				}
				else{
					if(strlen($apitext)!=32||!ctype_alnum($apitext)){
						header("Location:settings.php?weatherchanged=apiinvalid");
					}
					else{
						$sql="UPDATE settings SET weatherapi='$apitext', weatherlong='$long', weatherlat='$lat' WHERE id='1'";
						$result=mysql_query($sql);
					
						if($result){
							header("Location:settings.php?weatherchanged=true");
						}
						else {
							header("Location:settings.php?weatherchanged=false");
						}
					}
				}
			}
		}
	}
?>
