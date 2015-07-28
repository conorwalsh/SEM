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

                  This script ensures that only authenticated users can access the system.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------*/

	include('db.php');
	
	session_start();
	
	$check=$_SESSION['login_username'];
	
	$login_session = mysql_result(mysql_query("SELECT username FROM `login` WHERE username='$check';"),0);
	
	$timeout = mysql_result(mysql_query("SELECT timeout FROM settings LIMIT 1;"),0);
	
	mysql_close($conn);
	
	if(!isset($login_session)){
		header("Location:index.php");
	}
	else if(time() - $_SESSION['login_time'] > ($timeout*60)){
			if(session_destroy()){
				header("Location: index.php?reason=expired");
			}
	}
	
	$pagetitle=$_SESSION['page_title'];
	$favicon=$_SESSION['fav_icon'];
	$brandname=$_SESSION['brand_name'];
	$brandheaderimage=$_SESSION['brand_header_image'];
	
	$_SESSION['login_time'] = time();
?>
