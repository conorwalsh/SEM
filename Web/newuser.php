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

 	     This script is used by the web users page to register new users in the system.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------*/

include("adminsession.php");
{
		
	$username=mysql_real_escape_string($_POST['user']);
	$newpin=mysql_real_escape_string($_POST['pin']);
	$admin=mysql_real_escape_string($_POST['admin']);
	
	if(strlen($newpin)>=5){
		if(strlen($username)>=4){
				
			$hash=sha1($newpin);
			
			$sql="INSERT INTO login (username, password, admin) VALUES ('$username', '$hash', '$admin');";
			$result=mysql_query($sql);
			
			if($result){
				header("Location:webusers.php?newuser=true&user=$username");
			}
			else {
				header("Location:webusers.php?newuser=false&user=$username");
			}
		}
		else {
			header("Location:webusers.php?newuser=userinvalid&user=$username");
		}
	}
	else {
		header("Location:webusers.php?newuser=passinvalid&user=$username");
	}
}
?>
