<?php
include("session.php");
$startdate=$_POST['datestart'];
$enddate=$_POST['dateend'];
$debug=$_GET['d'];

if ($startdate==""){$startdate=date("d\/m\/Y");}
if ($enddate==""){$enddate=date("d\/m\/Y");}
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

          		This page displays the data collected by the arduino device from different time periods.
		  
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
    <!--[if lte IE 8]><script src="js/flot/excanvas.js"></script><![endif]-->
	<script src="js/flot/jquery.flot.js"></script>
	<script src="js/flot/jquery.flot.tooltip.min.js"></script>
	<script src="js/flot/jquery.flot.pie.js"></script>
			
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
            <li><a style="background-color: #3673A5; color: #fff" href="logs.php"><i class="fa fa-list"></i> Logs</a></li>
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
            <h1>Logs <small>View the data logs</small></h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-list"></i> Logs</li>
            </ol>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
          	
          	<div class="container">
			        <form method="post" name="logdates" action="logs.php">
				        <label style="float: left; margin-top: 5px; margin-right: 10px; margin-bottom: 20px; margin-left: -20px;">Start Date: </label>
			            <input style="width: 200px; float: left; margin-right: 10px; margin-bottom: 20px;" type='text' class="form-control" id='datestart' name="datestart" value="<?php echo str_replace("-","/", $startdate); ?>" data-date-format="DD/MM/YYYY"/>
			            <label style="float: left; margin-top: 5px; margin-right: 15.5px; margin-bottom: 20px;">End Date: </label>
			            <input style="float: left; width: 200px;  margin-bottom: 20px; margin-right: 10px;" type='text' class="form-control" id='dateend' name="dateend" value="<?php echo str_replace("-","/", $enddate); ?>" data-date-format="DD/MM/YYYY"/>
				        <button style="float: left; margin-bottom: 20px; margin-right: 10px;" class="btn btn-default" type='submit' >Go <i class="fa fa-arrow-right"></i></button>
				    </form>
				    <form method="post" name="logdatetoday" action="logs.php">
				    	<input type='hidden' id='datestarttoday' name="datestart" value="<?php echo date("d\/m\/Y"); ?>"/>
			            <input type='hidden' id='dateendtoday' name="dateend" value="<?php echo date("d\/m\/Y"); ?>"/>
				    	<button style="float: left; margin-bottom: 20px;" class="btn btn-default" type="submit">Today <i class="fa fa-arrow-right"></i></button>
				    </form>
			        <script type="text/javascript">
			            $(function () {
			                $('#datestart').datetimepicker({
			                    pickTime: false,
			                    useCurrent: true,
			                    maxDate: <?php echo date("'m\/d\/Y'");?>,
			                    icons: {
				                    time: "fa fa-clock-o",
				                    date: "fa fa-calendar",
				                    up: "fa fa-arrow-up",
				                    down: "fa fa-arrow-down"
				                }
			                });
			                $('#dateend').datetimepicker({
			                    pickTime: false,
			                    useCurrent: true,
			                    maxDate: <?php echo date("'m\/d\/Y'");?>,
			                    icons: {
				                    time: "fa fa-clock-o",
				                    date: "fa fa-calendar",
				                    up: "fa fa-arrow-up",
				                    down: "fa fa-arrow-down"
				                }
			                });
			                $("#datestart").on("dp.change",function (e) {
				               $('#dateend').data("DateTimePicker").setMinDate(e.date);
				            });
				            $("#dateend").on("dp.change",function (e) {
				               $('#datestart').data("DateTimePicker").setMaxDate(e.date);
				            });
			            });
			        </script>
			</div>
			
			          	
            <?php
            					
				mysql_close();

				include("db.php");
				
				$newstartdate = date("Y\-m\-d", strtotime(str_replace("/","-",$startdate)));
				$newenddate = date("Y\-m\-d", strtotime(str_replace("/","-",$enddate)));
				
				$resultnosql="SELECT COUNT(*) AS resultcount FROM environment1 WHERE DATE(time) BETWEEN DATE('$newstartdate') AND DATE('$newenddate');";
				$resultnoraw=mysql_query($resultnosql);
				$resultno = mysql_fetch_assoc($resultnoraw);
				
				$sql="SELECT * FROM environment1 WHERE DATE(time) BETWEEN '$newstartdate' AND '$newenddate' ORDER BY id DESC;";
				$result=mysql_query($sql);
				
				if($debug==1){echo "<strong>Dates:</strong> Start: " . $startdate . " End: " . $enddate . " <strong>Query:</strong> " . $sql;}
			?>
			
			<div <?php if ($resultno['resultcount']>0){ echo "class='alert alert-info alert-dismissable'";} else{ echo "class='alert alert-warning alert-dismissable'";} ?>>
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="fa fa-search"></i> Your search returned <?php echo $resultno['resultcount'] ?> results. <?php if ($resultno['resultcount']==0){ echo "Maybe you should try selecting alternative dates.";} ?>
            </div>  

			<div class="modal fade" id="buffering" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div style="width: 93px!important; margin-left: 40%; margin-top: 40%;" class="modal-content">
			      <img width="90px" src="img/buffer.gif" />
			    </div>
			  </div>
			</div>
			
			<script type="text/javascript">$('#buffering').modal({backdrop: 'static'});</script>

			<div class="table-responsive">
              <table id="logtable" class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                  	<th>ID <i class="fa fa-sort"></i></th>
                    <th>Internal Temperature <i class="fa fa-sort"></i></th>
                    <th>External Temperature <i class="fa fa-sort"></i></th>
                    <th>Internal Humidity <i class="fa fa-sort"></i></th>
                    <th>External Humidity <i class="fa fa-sort"></i></th>
                    <th>Internal Light <i class="fa fa-sort"></i></th>
                    <th>External Weather <i class="fa fa-sort"></i></th>
                    <th>Time <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>

				<?php
					while($rows=mysql_fetch_array($result)){
				?>
	
				<tr>
					<td ><? echo $rows['id']; ?></td>
					<td ><? echo $rows['inttemp']."&#176;C"; ?></td>
					<td ><? echo strval(round(floatval($rows['exttemp']),1))."&#176;C"; ?></td>
					<td ><? echo $rows['inthum']."%"; ?></td>
					<td ><? echo $rows['exthum']."%"; ?></td>
					<td ><? echo $rows['light']." lux"; ?></td>
					<td ><? echo ucwords(str_replace("-"," ",$rows['conditions'])) . " <img style='float: right;' height='32px' src='img/weather-icon/" . $rows['conditions'] . ".png'/>"; ?></td>
					<td ><? echo date('l jS \of F Y h:i:s A',strtotime($rows['time'])); ?></td>
				</tr>
	
				<?php
					}
				?>
			    </tbody>
              </table>
            </div>
            
            			
          </div>

			<?php
				mysql_close();
			?>
            
            <script type="text/javascript">$('#buffering').modal('hide');</script>
		
		
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    

    <!-- Page Specific Plugins -->
    <script src="js/bootstrap-datetimepicker.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/clock.js"></script>
    
	
    <script type="text/javascript">
    	$(document).ready(function(){ 
	        $("#logtable").tablesorter(); 
	    } 
		);
		
		
    </script>
    
  </body>
</html>
