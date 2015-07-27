<?php
include("session.php");
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

          		This is the homepage of the system it displays basic realtime data from the system.
		  
---------------------------------------------- PAGE INFO END ----------------------------------------------->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pagetitle;?></title>
    <link rel="SHORTCUT ICON" href="<?php echo $favicon;?>">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
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
            <li class="active"><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
            <h1>Dashboard <small></small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
            <?php echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Welcome to <i class='fa fa-globe'></i> " . $brandname . "</div>";?>
          </div>
        </div><!-- /.row -->

        <div class="row">
        
        	<script type="text/javascript">
			    function refreshData(){
			      $('#temp1').load('weathercheck.php?p=semcw2015&v=t');
				  $('#hum1').load('weathercheck.php?p=semcw2015&v=h');
				  $('#humidex1').load('weathercheck.php?p=semcw2015&v=hi');
				  $('#light1').load('weathercheck.php?p=semcw2015&v=l');
				  $('#weather1').load('weathercheck.php?p=semcw2015&v=w');
				  $('#devicecontainer').load('weathercheck.php?p=semcw2015&v=ds');
				}
				window.setInterval(refreshData, 1000);
			</script>
        	
          <div class="col-lg-2">
            <div id="temp1container">
            	<div class="panel panel-success">
	              <div class="panel-heading">
	                <h3 class="panel-title">Temperature</h3>
	              </div>
	              <div style="text-align: center;" class="panel-body">
	                <div id="temp1"><i class="fa fa-refresh fa-spin"></i> Loading</div>
	              </div>
	            </div>
            </div>
           </div>
           <div class="col-lg-2">
           <div id="hum1container">
            	<div class="panel panel-success">
	              <div class="panel-heading">
	                <h3 class="panel-title">Humidity</h3>
	              </div>
	              <div style="text-align: center;" class="panel-body">
	                <div id="hum1"><i class="fa fa-refresh fa-spin"></i> Loading</div>
	              </div>
	            </div>
            </div>
           </div>
           <div class="col-lg-2">
           <div id="humidex1container">
            	<div class="panel panel-success">
	              <div class="panel-heading">
	                <h3 class="panel-title">Humidex <i title="Help and Scale" style="float: right; cursor: pointer;" class="fa fa-question" data-toggle="modal" data-target="#humidexmodal"></i></h3>
	              </div>
	              <div style="text-align: center;" class="panel-body">
	                <div id="humidex1"><i class="fa fa-refresh fa-spin"></i> Loading</div>
	              </div>
	            </div>
            </div>
           </div>
           <div class="col-lg-2">
           <div id="light1container">
            	<div class="panel panel-success">
	              <div class="panel-heading">
	                <h3 class="panel-title">Light <i title="Help and Scale" style="float: right; cursor: pointer;" class="fa fa-question" data-toggle="modal" data-target="#luxmodal"></i></h3>
	              </div>
	              <div style="text-align: center;" class="panel-body">
	                <div id="light1"><i class="fa fa-refresh fa-spin"></i> Loading</div>
	              </div>
	            </div>
            </div>
           </div>
           <div class="col-lg-2">
           	<div id="weathercontainer">
	            <div class="panel panel-success">
	              <div class="panel-heading">
	                <h3 class="panel-title">Weather</h3>
	              </div>
	              <div style="text-align: center;" class="panel-body">
	                <div id="weather1"><i class="fa fa-refresh fa-spin"></i> Loading</div>
	              </div>
	            </div>
	        </div>
           </div>
           <div class="col-lg-2">
           	<div id="devicecontainer">
	            <div class="panel panel-info">
	              <div class="panel-heading">
	                <h3 class="panel-title">Device Status <i title="Help" style="float: right; cursor: pointer;" class="fa fa-question" data-toggle="modal" data-target="#dsmodal"></i></h3>
	              </div>
	              <div style="text-align: center;" class="panel-body">
	                <div><i class="fa fa-refresh fa-spin"></i> Loading</div>
	              </div>
	            </div>
	        </div>
           </div>
           
        </div><!-- /.row -->

		   <div class="modal fade" id="luxmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Lux Scale</h4>
			      </div>
				      <div style="text-align: center;" class="modal-body">
				          <img src="img/lux-scale.png" />
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
			    </div>
			  </div>
			</div>
			
			<div class="modal fade" id="humidexmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Humidex Scale</h4>
			      </div>
				      <div style="text-align: center;" class="modal-body">
				      	The humidex (short for "humidity index") is a scale used to describe how hot the weather feels to the average person, by combining the effect of heat and humidity. (This is the Canadian Humidex not the American Heat Index).
				        <br /><br />
				        <table class="table table-bordered table-hover table-striped">
							<tr><td><strong>Humidex Range</strong></td><td><strong>Degree of Comfort</strong></td></tr>
							<tr><td>20-29</td><td style="color: #4CD900;">Comfortable</td></tr>
							<tr><td>30-39</td><td style="color: #FFD800;">Some Discomfort</td></tr>
							<tr><td>40-45</td><td style="color: #FF6A00;">Great Discomfort</td></tr>
							<tr><td>>45</td><td style="color: #FF0000;">Dangerous</td></tr>
						</table>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
			    </div>
			  </div>
			</div>
			
			<div class="modal fade" id="dsmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Device Status</h4>
			      </div>
				      <div style="text-align: center;" class="modal-body">
				          The assumption that the device is "Online and logging data" or "Offline and not logging data" is based on weather or not the system has received data from the device in the last 3 and a half minutes as the device submits data every 3 minutes. 
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
			    </div>
			  </div>
			</div>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
    <script src="js/clock.js"></script>
    

  </body>
</html>
