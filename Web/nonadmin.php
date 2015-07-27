<?php
include("session.php");
$debug=$_GET['d'];
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

          		This page is where a standard user is redirected when they try to access a
          		restricted admin only page.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title><?php echo $pagetitle;?></title>
    <link rel="SHORTCUT ICON" href="<?php echo $favicon;?>">
    
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/moment.js"></script>
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php"><img src="<?php echo $brandheaderimage;?>" border="0" style="margin-top: -3px;" /> <?php echo $brandname;?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="graphs.php"><i class="fa fa-area-chart"></i> Graphs</a></li>
            <li><a href="logs.php"><i class="fa fa-list"></i> Logs</a></li>
            <li><a href="webusers.php"><i class="fa fa-users"></i> Website users</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li style="padding: 15px 15px 14.5px;" class="userbtn" class="alerts-dropdown">
              <div id="clockbox"></div>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class= "userbtn" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $login_session; ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Non Admin</h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-ban"></i> Non Admin</li>
            </ol>
            
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div style="text-align: center; font-size: 18px;" class="col-lg-12">
          	
          <img src="img/ban.png" /><div> The page that you tried to access is only availible to administrators, if you require access we would suggest contacting your administrator.</div>
		
		
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    

    <!-- Page Specific Plugins -->
    <script src="js/clock.js"></script>
    
  </body>
</html>
