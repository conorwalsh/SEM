<?php
include("session.php");

$hours = $_POST['hour'];
$interval = 2;
$inttempgraph = $_POST['inttemp'];
$exttempgraph = $_POST['exttemp'];
$inthumgraph = $_POST['inthum'];
$exthumgraph = $_POST['exthum'];
$intlightgraph = $_POST['intlight'];

$mininttempgraph = $_POST['mininttemp'];
$minexttempgraph = $_POST['minexttemp'];
$mininthumgraph = $_POST['mininthum'];
$minexthumgraph = $_POST['minexthum'];
$minintlightgraph = $_POST['minintlight'];

$maxinttempgraph = $_POST['maxinttemp'];
$maxexttempgraph = $_POST['maxexttemp'];
$maxinthumgraph = $_POST['maxinthum'];
$maxexthumgraph = $_POST['maxexthum'];
$maxintlightgraph = $_POST['maxintlight'];

if($hours==""){
	$hours = 24;
	$interval = 1;
	$inttempgraph = TRUE;
	$exttempgraph = TRUE;
	$inthumgraph = TRUE;
	$exthumgraph = TRUE;
}
else {
	$hours = intval($_POST['hour']);
	$interval = intval($_POST['interval']);
}

if($inttempgraph!=TRUE&&$exttempgraph!=TRUE&&$inthumgraph!=TRUE&&$exthumgraph!=TRUE&&$intlightgraph!=TRUE&&$mininttempgraph!=TRUE&&$minexttempgraph!=TRUE&&$mininthumgraph!=TRUE&&$minexthumgraph!=TRUE&&$minintlightgraph!=TRUE&&$maxinttempgraph!=TRUE&&$maxexttempgraph!=TRUE&&$maxinthumgraph!=TRUE&&$maxexthumgraph!=TRUE&&$maxintlightgraph!=TRUE){
	$inttempgraph = TRUE;
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

  		This page generates graphs over different time periods using the data collected
  		by the arduino device.
		  
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
            <li><a style="background-color: #3673A5; color: #fff" href="graphs.php"><i class="fa fa-area-chart"></i> Graphs</a></li>
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
            <h1>Graphs <small>View the data graphs</small></h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-list"></i> Graphs</li>
            </ol>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
          	<table>
          	<tr>
          	<td>
          	<table>
          		<tr>
          			<td>
			          	<form method="post" name="24hour" action="graphs.php">
					        <input type='hidden' name="interval" value='1'/>
						    <input type='hidden' name="hour" value='24'/>
						    
						    <input type='hidden' name="inttemp" value='<?php echo $inttempgraph; ?>'/>
						    <input type='hidden' name="exttemp" value='<?php echo $exttempgraph; ?>'/>
						    <input type='hidden' name="inthum" value='<?php echo $inthumgraph; ?>'/>
						    <input type='hidden' name="exthum" value='<?php echo $exthumgraph; ?>'/>
						    <input type='hidden' name="intlight" value='<?php echo $intlightgraph; ?>'/>
						    
						    <input type='hidden' name="mininttemp" value='<?php echo $mininttempgraph; ?>'/>
						    <input type='hidden' name="minexttemp" value='<?php echo $minexttempgraph; ?>'/>
						    <input type='hidden' name="mininthum" value='<?php echo $mininthumgraph; ?>'/>
						    <input type='hidden' name="minexthum" value='<?php echo $minexthumgraph; ?>'/>
						    <input type='hidden' name="minintlight" value='<?php echo $minintlightgraph; ?>'/>
						    
						    <input type='hidden' name="maxinttemp" value='<?php echo $maxinttempgraph; ?>'/>
						    <input type='hidden' name="maxexttemp" value='<?php echo $maxexttempgraph; ?>'/>
						    <input type='hidden' name="maxinthum" value='<?php echo $maxinthumgraph; ?>'/>
						    <input type='hidden' name="maxexthum" value='<?php echo $maxexthumgraph; ?>'/>
						    <input type='hidden' name="maxintlight" value='<?php echo $maxintlightgraph; ?>'/>
					        
					        <button style="float: left; margin-bottom: 5px; margin-right: 10px;" class="btn btn-default" type='submit' <?php if($hours==24){echo "disabled='disabled'";} ?>>Last 24 hours <i class="fa fa-arrow-right"></i></button>
					    </form>
				    </td>
				    <td>
					    <form method="post" name="48hour" action="graphs.php">
					        <input type='hidden' name="interval" value='2'/>
						    <input type='hidden' name="hour" value='48'/>
						    
						    <input type='hidden' name="inttemp" value='<?php echo $inttempgraph; ?>'/>
						    <input type='hidden' name="exttemp" value='<?php echo $exttempgraph; ?>'/>
						    <input type='hidden' name="inthum" value='<?php echo $inthumgraph; ?>'/>
						    <input type='hidden' name="exthum" value='<?php echo $exthumgraph; ?>'/>
						    <input type='hidden' name="intlight" value='<?php echo $intlightgraph; ?>'/>
						    
						    <input type='hidden' name="mininttemp" value='<?php echo $mininttempgraph; ?>'/>
						    <input type='hidden' name="minexttemp" value='<?php echo $minexttempgraph; ?>'/>
						    <input type='hidden' name="mininthum" value='<?php echo $mininthumgraph; ?>'/>
						    <input type='hidden' name="minexthum" value='<?php echo $minexthumgraph; ?>'/>
						    <input type='hidden' name="minintlight" value='<?php echo $minintlightgraph; ?>'/>
						    
						    <input type='hidden' name="maxinttemp" value='<?php echo $maxinttempgraph; ?>'/>
						    <input type='hidden' name="maxexttemp" value='<?php echo $maxexttempgraph; ?>'/>
						    <input type='hidden' name="maxinthum" value='<?php echo $maxinthumgraph; ?>'/>
						    <input type='hidden' name="maxexthum" value='<?php echo $maxexthumgraph; ?>'/>
						    <input type='hidden' name="maxintlight" value='<?php echo $maxintlightgraph; ?>'/>
					        
					        <button style="float: left; margin-bottom: 5px; margin-right: 10px;" class="btn btn-default" type='submit' <?php if($hours==48){echo "disabled='disabled'";} ?>>Last 48 hours <i class="fa fa-arrow-right"></i></button>
					    </form>
				    </td>
				    <td>
					    <form method="post" name="72hour" action="graphs.php">
					        <input type='hidden' name="interval" value='3'/>
						    <input type='hidden' name="hour" value='72'/>
						    
						    <input type='hidden' name="inttemp" value='<?php echo $inttempgraph; ?>'/>
						    <input type='hidden' name="exttemp" value='<?php echo $exttempgraph; ?>'/>
						    <input type='hidden' name="inthum" value='<?php echo $inthumgraph; ?>'/>
						    <input type='hidden' name="exthum" value='<?php echo $exthumgraph; ?>'/>
						    <input type='hidden' name="intlight" value='<?php echo $intlightgraph; ?>'/>
						    
						    <input type='hidden' name="mininttemp" value='<?php echo $mininttempgraph; ?>'/>
						    <input type='hidden' name="minexttemp" value='<?php echo $minexttempgraph; ?>'/>
						    <input type='hidden' name="mininthum" value='<?php echo $mininthumgraph; ?>'/>
						    <input type='hidden' name="minexthum" value='<?php echo $minexthumgraph; ?>'/>
						    <input type='hidden' name="minintlight" value='<?php echo $minintlightgraph; ?>'/>
						    
						    <input type='hidden' name="maxinttemp" value='<?php echo $maxinttempgraph; ?>'/>
						    <input type='hidden' name="maxexttemp" value='<?php echo $maxexttempgraph; ?>'/>
						    <input type='hidden' name="maxinthum" value='<?php echo $maxinthumgraph; ?>'/>
						    <input type='hidden' name="maxexthum" value='<?php echo $maxexthumgraph; ?>'/>
						    <input type='hidden' name="maxintlight" value='<?php echo $maxintlightgraph; ?>'/>
					        
					        <button style="float: left; margin-bottom: 5px; margin-right: 10px;" class="btn btn-default" type='submit' <?php if($hours==72){echo "disabled='disabled'";} ?>>Last 72 hours <i class="fa fa-arrow-right"></i></button>
					    </form>
				    </td>
			    </tr>
			    <tr>
			    	<td>
					    <form method="post" name="168hour" action="graphs.php">
					        <input type='hidden' name="interval" value='6'/>
						    <input type='hidden' name="hour" value='168'/>
						    
						    <input type='hidden' name="inttemp" value='<?php echo $inttempgraph; ?>'/>
						    <input type='hidden' name="exttemp" value='<?php echo $exttempgraph; ?>'/>
						    <input type='hidden' name="inthum" value='<?php echo $inthumgraph; ?>'/>
						    <input type='hidden' name="exthum" value='<?php echo $exthumgraph; ?>'/>
						    <input type='hidden' name="intlight" value='<?php echo $intlightgraph; ?>'/>
						    
						    <input type='hidden' name="mininttemp" value='<?php echo $mininttempgraph; ?>'/>
						    <input type='hidden' name="minexttemp" value='<?php echo $minexttempgraph; ?>'/>
						    <input type='hidden' name="mininthum" value='<?php echo $mininthumgraph; ?>'/>
						    <input type='hidden' name="minexthum" value='<?php echo $minexthumgraph; ?>'/>
						    <input type='hidden' name="minintlight" value='<?php echo $minintlightgraph; ?>'/>
						    
						    <input type='hidden' name="maxinttemp" value='<?php echo $maxinttempgraph; ?>'/>
						    <input type='hidden' name="maxexttemp" value='<?php echo $maxexttempgraph; ?>'/>
						    <input type='hidden' name="maxinthum" value='<?php echo $maxinthumgraph; ?>'/>
						    <input type='hidden' name="maxexthum" value='<?php echo $maxexthumgraph; ?>'/>
						    <input type='hidden' name="maxintlight" value='<?php echo $maxintlightgraph; ?>'/>
					        
					        <button style="float: left; margin-bottom: 20px; margin-right: 10px;" class="btn btn-default" type='submit' <?php if($hours==168){echo "disabled='disabled'";} ?>>Last 7 days <i class="fa fa-arrow-right"></i></button>
					    </form>
				    </td>
				    <td>
					    <form method="post" name="336hour" action="graphs.php">
					        <input type='hidden' name="interval" value='12'/>
						    <input type='hidden' name="hour" value='336'/>
						    
						    <input type='hidden' name="inttemp" value='<?php echo $inttempgraph; ?>'/>
						    <input type='hidden' name="exttemp" value='<?php echo $exttempgraph; ?>'/>
						    <input type='hidden' name="inthum" value='<?php echo $inthumgraph; ?>'/>
						    <input type='hidden' name="exthum" value='<?php echo $exthumgraph; ?>'/>
						    <input type='hidden' name="intlight" value='<?php echo $intlightgraph; ?>'/>
						    
						    <input type='hidden' name="mininttemp" value='<?php echo $mininttempgraph; ?>'/>
						    <input type='hidden' name="minexttemp" value='<?php echo $minexttempgraph; ?>'/>
						    <input type='hidden' name="mininthum" value='<?php echo $mininthumgraph; ?>'/>
						    <input type='hidden' name="minexthum" value='<?php echo $minexthumgraph; ?>'/>
						    <input type='hidden' name="minintlight" value='<?php echo $minintlightgraph; ?>'/>
						    
						    <input type='hidden' name="maxinttemp" value='<?php echo $maxinttempgraph; ?>'/>
						    <input type='hidden' name="maxexttemp" value='<?php echo $maxexttempgraph; ?>'/>
						    <input type='hidden' name="maxinthum" value='<?php echo $maxinthumgraph; ?>'/>
						    <input type='hidden' name="maxexthum" value='<?php echo $maxexthumgraph; ?>'/>
						    <input type='hidden' name="maxintlight" value='<?php echo $maxintlightgraph; ?>'/>
					        
					        <button style="float: left; margin-bottom: 20px; margin-right: 10px;" class="btn btn-default" type='submit' <?php if($hours==336){echo "disabled='disabled'";} ?>>Last 14 days <i class="fa fa-arrow-right"></i></button>
					    </form>
				    </td>
				    <td>
					    <form method="post" name="720hour" action="graphs.php">
					        <input type='hidden' name="interval" value='24'/>
						    <input type='hidden' name="hour" value='720'/>
						    
						    <input type='hidden' name="inttemp" value='<?php echo $inttempgraph; ?>'/>
						    <input type='hidden' name="exttemp" value='<?php echo $exttempgraph; ?>'/>
						    <input type='hidden' name="inthum" value='<?php echo $inthumgraph; ?>'/>
						    <input type='hidden' name="exthum" value='<?php echo $exthumgraph; ?>'/>
						    <input type='hidden' name="intlight" value='<?php echo $intlightgraph; ?>'/>
						    
						    <input type='hidden' name="mininttemp" value='<?php echo $mininttempgraph; ?>'/>
						    <input type='hidden' name="minexttemp" value='<?php echo $minexttempgraph; ?>'/>
						    <input type='hidden' name="mininthum" value='<?php echo $mininthumgraph; ?>'/>
						    <input type='hidden' name="minexthum" value='<?php echo $minexthumgraph; ?>'/>
						    <input type='hidden' name="minintlight" value='<?php echo $minintlightgraph; ?>'/>
						    
						    <input type='hidden' name="maxinttemp" value='<?php echo $maxinttempgraph; ?>'/>
						    <input type='hidden' name="maxexttemp" value='<?php echo $maxexttempgraph; ?>'/>
						    <input type='hidden' name="maxinthum" value='<?php echo $maxinthumgraph; ?>'/>
						    <input type='hidden' name="maxexthum" value='<?php echo $maxexthumgraph; ?>'/>
						    <input type='hidden' name="maxintlight" value='<?php echo $maxintlightgraph; ?>'/>
					        
					        <button style="float: left; margin-bottom: 20px; margin-right: 10px;" class="btn btn-default" type='submit' <?php if($hours==720){echo "disabled='disabled'";} ?>>Last 30 days <i class="fa fa-arrow-right"></i></button>
					    </form>
				    </td>
			    </tr>
		    </table>
		    </td>
		    <td>
		    <table style="margin-top: -5px;">
			    <form method="post" name="options" action="graphs.php">
			    	<input type='hidden' name="interval" value='<?php echo $interval; ?>'/>
				    <input type='hidden' name="hour" value='<?php echo $hours; ?>'/>
		        	<tr>
		        		<td>
					        <label style="float: left; margin-right: 2px;" for="inttemp">Internal Temperature</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="inttemp" <?php if($inttempgraph){echo "checked";}?>/>
						</td>
						<td>    
						    <label style="float: left; margin-right: 2px;" for="exttemp">External Temperature</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="exttemp" <?php if($exttempgraph){echo "checked";}?>/>
					    </td>
					    <td>    
					        <label style="float: left; margin-right: 2px;" for="inthum">Internal Humidity</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="inthum" <?php if($inthumgraph){echo "checked";}?>/>
					    </td>
					    <td>    
					        <label style="float: left; margin-right: 2px;" for="exthum">External Humidity</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="exthum" <?php if($exthumgraph){echo "checked";}?>/>
		        		</td>
		        		<td>    
					        <label style="float: left; margin-right: 2px;" for="intlight">Internal Light</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="intlight" <?php if($intlightgraph){echo "checked";}?>/>
		        		</td>
		        		<td rowspan="3"><button style="float: left; margin-bottom: 5px;" class="btn btn-default" type='submit' >Update <i class="fa fa-arrow-right"></i></button></td>
		        	</tr>
		        	<tr>
		        		<td>
					        <label style="float: left; margin-right: 2px;" for="mininttemp">Minimum Internal Temperature</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="mininttemp" <?php if($mininttempgraph){echo "checked";}?>/>
						</td>
						<td>    
						    <label style="float: left; margin-right: 2px;" for="minexttemp">Minimum External Temperature</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="minexttemp" <?php if($minexttempgraph){echo "checked";}?>/>
					    </td>
					    <td>    
					        <label style="float: left; margin-right: 2px;" for="mininthum">Minimum Internal Humidity</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="mininthum" <?php if($mininthumgraph){echo "checked";}?>/>
					    </td>
					    <td>    
					        <label style="float: left; margin-right: 2px;" for="minexthum">Minimum External Humidity</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="minexthum" <?php if($minexthumgraph){echo "checked";}?>/>
		        		</td>
		        		<td>    
					        <label style="float: left; margin-right: 2px;" for="minintlight">Minimum Internal Light</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="minintlight" <?php if($minintlightgraph){echo "checked";}?>/>
		        		</td>
		        	</tr>
		        	<tr>
		        		<td>
					        <label style="float: left; margin-right: 2px;" for="maxinttemp">Maximum Internal Temperature</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="maxinttemp" <?php if($maxinttempgraph){echo "checked";}?>/>
						</td>
						<td>    
						    <label style="float: left; margin-right: 2px;" for="maxexttemp">Maximum External Temperature</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="maxexttemp" <?php if($maxexttempgraph){echo "checked";}?>/>
					    </td>
					    <td>    
					        <label style="float: left; margin-right: 2px;" for="maxinthum">Maximum Internal Humidity</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="maxinthum" <?php if($maxinthumgraph){echo "checked";}?>/>
					    </td>
					    <td>    
					        <label style="float: left; margin-right: 2px;" for="maxexthum">Maximum External Humidity</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="maxexthum" <?php if($maxexthumgraph){echo "checked";}?>/>
		        		</td>
		        		<td>    
					        <label style="float: left; margin-right: 2px;" for="minintlight">Maximum Internal Light</label>
					        <input style="float: left; margin-right: 10px;" type='checkbox' name="maxintlight" <?php if($maxintlightgraph){echo "checked";}?>/>
		        		</td>
		        	</tr>
			    </form>
			</table>
			</td>
			</tr>
			</table>
		    </div>
		    </div>
		    
		    <h2><?php if($hours<168){echo "Last " . strval($hours) . " hour's";} else{echo "Last " . strval($hours/24) . " day's";} ?></h2>
		    			
			<div style="height: 300px" id="line-chart">.</div>
			
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    

    <!-- Page Specific Plugins -->
    <script src="js/bootstrap-datetimepicker.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="js/clock.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    
	<!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
	<script src="js/flot/jquery.flot.js"></script>
	<script src="js/flot/jquery.flot.tooltip.min.js"></script>
	<script src="js/flot/jquery.flot.resize.js"></script>
	<script src="js/flot/jquery.flot.pie.js"></script>
	<script src="js/flot/chart-data-flot.js"></script>
	
	<?php
		include("db.php");
		
		echo "<script type='text/javascript'>Morris.Line({element: 'line-chart',data: [";
	    
		for ($x = ($hours*-1) - $interval; $x <= ($interval*-1); $x = $x + $interval) {
			$inttemp = "";
			$exttemp = "";
			$inthum = "";
			$exthum = "";
			$intlight = "";
			
			$mininttemp = "";
			$minexttemp = "";
			$mininthum = "";
			$minexthum = "";
			$minintlight = "";
			
			$maxinttemp = "";
			$maxexttemp = "";
			$maxinthum = "";
			$maxexthum = "";
			$maxlight = "";
			
			if($inttempgraph){$inttemp = ", a: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($exttempgraph){$exttemp = ", b: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($inthumgraph){$inthum = ", c: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($exthumgraph){$exthum = ", d: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($intlightgraph){$intlight = ", m: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT AVG(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			
			if($mininttempgraph){$mininttemp = ", e: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($minexttempgraph){$minexttemp = ", f: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($mininthumgraph){$mininthum = ", g: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($minexthumgraph){$minexthum = ", h: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($minintlightgraph){$minintlight = ", n: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			
			if($maxinttempgraph){$maxinttemp = ", i: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($maxexttempgraph){$maxexttemp = ", j: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($maxinthumgraph){$maxinthum = ", k: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($maxexthumgraph){$maxexthum = ", l: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			if($maxintlightgraph){$maxintlight = ", o: '" . strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x) . ' hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime(strval($x + $interval) . ' hours')) . "');")))),1)) . "'";}
			
			if($x>-2){
				echo "{ y: '" . date('H:\0\0 d\/m\/Y',strtotime(strval($x + 2) . ' hours')) . "'" . $inttemp . $exttemp . $inthum . $exthum . $mininttemp . $minexttemp . $mininthum . $minexthum . $maxinttemp . $maxexttemp . $maxinthum . $maxexthum . $intlight . $minintlight . $maxintlight . "}";
			}
			else{
				echo "{ y: '" . date('H:\0\0 d\/m\/Y',strtotime(strval($x + 2) . ' hours')) . "'" . $inttemp . $exttemp . $inthum . $exthum . $mininttemp . $minexttemp . $mininthum . $minexthum . $maxinttemp . $maxexttemp . $maxinthum . $maxexthum . $intlight . $minintlight . $maxintlight . "},";
			}
			
		}
		$ykeys = "";
		if($inttempgraph){$ykeys = "'a',";}
		if($exttempgraph){$ykeys = $ykeys . " 'b',";}
		if($inthumgraph){$ykeys = $ykeys . " 'c',";}
		if($exthumgraph){$ykeys = $ykeys . " 'd',";}
		if($mininttempgraph){$ykeys = $ykeys . "'e',";}
		if($minexttempgraph){$ykeys = $ykeys . " 'f',";}
		if($mininthumgraph){$ykeys = $ykeys . " 'g',";}
		if($minexthumgraph){$ykeys = $ykeys . " 'h',";}
		if($maxinttempgraph){$ykeys = $ykeys . "'i',";}
		if($maxexttempgraph){$ykeys = $ykeys . " 'j',";}
		if($maxinthumgraph){$ykeys = $ykeys . " 'k',";}
		if($maxexthumgraph){$ykeys = $ykeys . " 'l',";}
		if($intlightgraph){$ykeys = $ykeys . "'m',";}
		if($minintlightgraph){$ykeys = $ykeys . "'n',";}
		if($maxintlightgraph){$ykeys = $ykeys . "'o',";}

		$legendlabels = "";
		if($inttempgraph){$legendlabels = "'Internal Temperature',";}
		if($exttempgraph){$legendlabels = $legendlabels . " 'External Temperature',";}
		if($inthumgraph){$legendlabels = $legendlabels. " 'Internal Humidity',";}
		if($exthumgraph){$legendlabels = $legendlabels . " 'External Humidity',";}
		if($mininttempgraph){$legendlabels = $legendlabels . "'Minimum Internal Temperature',";}
		if($minexttempgraph){$legendlabels = $legendlabels . " 'Minimum External Temperature',";}
		if($mininthumgraph){$legendlabels = $legendlabels. " 'Minimum Internal Humidity',";}
		if($minexthumgraph){$legendlabels = $legendlabels . " 'Minimum External Humidity',";}
		if($maxinttempgraph){$legendlabels = $legendlabels . "'Maximum Internal Temperature',";}
		if($maxexttempgraph){$legendlabels = $legendlabels . " 'Maximum External Temperature',";}
		if($maxinthumgraph){$legendlabels = $legendlabels. " 'Maximum Internal Humidity',";}
		if($maxexthumgraph){$legendlabels = $legendlabels . " 'Maximum External Humidity',";}
		if($intlightgraph){$legendlabels = $legendlabels . " 'Internal Light',";}
		if($minintlightgraph){$legendlabels = $legendlabels . " 'Minimum Internal Light',";}
		if($maxintlightgraph){$legendlabels = $legendlabels . " 'Maximum Internal Light',";}
			
		echo "],xkey: 'y',ykeys: [" . $ykeys . "],labels: [" . $legendlabels . "],hoverCallback: function(index, options, content) {return(content);},parseTime: false,stacked: true,resize: true,lineColors:  ['#337AB7', '#5CB85C', '#5BC0DE', '#F0AD4E', '#D9534F', '#7A92A3']});</script>";
	
	?>
	
	<style>
		.morris-hover{position:absolute;z-index:1000;}
		.morris-hover.morris-default-style{border-radius:10px;padding:6px;color:#666;background:rgba(255, 255, 255, 0.8);border:solid 2px rgba(230, 230, 230, 0.8);font-family:sans-serif;font-size:12px;text-align:center;}
		.morris-hover.morris-default-style .morris-hover-row-label{font-weight:bold;margin:0.25em 0;}
		.morris-hover.morris-default-style .morris-hover-point{white-space:nowrap;margin:0.1em 0;}
	</style>
    
  </body>
</html>
