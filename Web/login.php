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

          		This is the script used by the system to process login requests.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------*/

include('db.php');
session_start();
{
    $user=mysql_real_escape_string($_POST['username']);
    $pass=mysql_real_escape_string($_POST['password']);
	$hash=sha1($pass);
    $fetch=mysql_query("SELECT id FROM `login` WHERE username='$user' and password='$hash'");
    $count=mysql_num_rows($fetch);
    if($count!=""){
	    session_register("sessionusername");
	    $_SESSION['login_username']=$user;
		$_SESSION['login_time'] = time();
		$admincheck = $_SESSION['login_username'];
		$adminsql="SELECT admin FROM login WHERE username ='$admincheck'";
		$adminresult = mysql_query($adminsql);
		$adminvalue = mysql_fetch_array($adminresult);
		$adminfinal = $adminvalue[0];
		if($adminfinal=="1"){
			$_SESSION['admin']=1;
		}
		else{
			$_SESSION['admin']=0;
		}
		
		$pagetitle = mysql_result(mysql_query("SELECT brandpagetitle FROM `settings` WHERE id=1"),0);
		$_SESSION['page_title']=$pagetitle;
		
		$favicon = mysql_result(mysql_query("SELECT brandfavicon FROM `settings` WHERE id=1"),0);
		$_SESSION['fav_icon']=$favicon;
		
		$brandname = mysql_result(mysql_query("SELECT brandname FROM `settings` WHERE id=1"),0);
		$_SESSION['brand_name']=$brandname;
		
		$brandheaderimage = mysql_result(mysql_query("SELECT brandheaderimage FROM `settings` WHERE id=1"),0);
		$_SESSION['brand_header_image']=$brandheaderimage;
		
		header("Location:home.php");
    }
    else{
       header('Location:index.php?auth=false');
    }

}
?>

