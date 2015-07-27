<?php
include('db.php');
session_start();
$check=$_SESSION['login_username'];
$session=mysql_query("select username from login where username='$check' ");
$row=mysql_fetch_array($session);
$login_session=$row['username'];
if(isset($login_session))
{
header("Location:home.php");
}
?>
<!DOCTYPE html>

<!-------------------------------------------- LICENSE (MIT) -------------------------------------------------

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
		  
----------------------------------------------- LICENSE END ------------------------------------------------>

<!---------------------------------------------- PAGE INFO --------------------------------------------------

          		This is the login page for the system.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------->

<html>

<head>

  <meta charset="UTF-8">

  <title>S.E.M.</title>

  <link rel="stylesheet" href="css/login-reset.css">
  
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  
    <link rel="stylesheet" href="css/login-style.css" media="screen" type="text/css" />
    
    <link rel="SHORTCUT ICON" href="semfavicon.ico">

</head>

<body>

  <div class="wrap">
  	<?php if($_GET["auth"]=="false"){echo "<div class='alert alert-danger' role='alert'>
								              <i class='fa fa-times'></i> Your username and/or password were incorrect
								            </div>";} ?>
  	<?php if($_GET["code"]=="invalid"){echo "<div class='alert alert-danger' role='alert'>
								              <i class='fa fa-exclamation'></i> You have been registered with an invalid system code
								            </div>";} ?>
	<?php if($_GET["reason"]=="expired"){echo "<div class='alert alert-danger' role='alert'>
								              <i class='fa fa-exclamation'></i> Your session has expired please login again
								            </div>";} ?>
    <?php if($_GET["reason"]=="serverexpired"){echo "<div class='alert alert-danger' role='alert'>
								              <i class='fa fa-exclamation'></i> Your session has expired please login again, if this does not work our external server has failed.
								            </div>";} ?>					            
  	<p style="font-size: 35px; color: #fff; text-align: center; font-weight: bold; margin-top: 10px;"><strong style="color: #FEB908;">S</strong>mart <strong style="color: #FEB908;">E</strong>nvironment <strong style="color: #FEB908;">M</strong>onitoring</p>
  	<div class="avatar">
      <img src="img/login_logo_w_bg3.png">
		</div>
		<form style="margin-bottom: 12px;" method="post" name="login" action="login.php">
			<input type="text" placeholder="username" name="username" id="userid" required>
			<div class="bar">
				<i></i>
			</div>
			<input type="password" placeholder="password" name="password" id="passid" required>
			<input id="login-button" type="submit" name="submit" value="Login" /> 
		</form>
	</div>
	
	<!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    	
</body>

</html>