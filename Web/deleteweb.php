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

         		This script is used by the web users page to delete users.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------*/
	
	include("adminsession.php");
	{
		$user=mysql_real_escape_string($_POST['user']);
		
		$nouserraw=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS resultcount FROM login;"));
		$nouser = $nouserraw['resultcount'];
		
		if($nouser>1){
			$noadminuserraw=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS resultcount FROM login WHERE username!='$user' AND admin=1;"));
			$noadminuser = $noadminuserraw['resultcount'];
			if($noadminuser>=1){
				
				$username = mysql_result(mysql_query("SELECT username FROM login WHERE id = $user;"),0);
				
				$result=mysql_query("DELETE FROM login WHERE id='$user';");
				
				if($result){
					header("Location:webusers.php?deleted=true&user=$username");
				}
				else {
					header("Location:webusers.php?deleted=false&user=$username");
				}
			}
			else {
				header("Location:webusers.php?deleted=invalidadmin");
			}
		}
		else {
			header("Location:webusers.php?deleted=invalid");
		}
	}
?>
