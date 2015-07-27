<?php
include("adminsession.php");
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

          		This page is used by admin users to change various system settings.
		  
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
    
    <script language="JavaScript">
		function enable_form(status){
			status=!status;
			document.e1.toemail.disabled = status;
			document.e1.tofirstname.disabled = status;
			document.e1.tolastname.disabled = status;
			document.e1.emailtime.disabled = status;
		}
		
		function enable_form1(status){
			status=!status;
			document.g1.tosms.disabled = status;
			document.g1.tosmsfirstname.disabled = status;
			document.g1.tosmslastname.disabled = status;
		}
	</script>
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
            <h1>Settings <small>View and edit system settings</small></h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-gear"></i> Settings</li>
            </ol>
            
             <?php if($_GET['emailchanged']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The email report settings have been successfully updated.</div>"; }
                  else if($_GET['emailchanged']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The email report settings have failed to update.</div>"; }
				  else if($_GET['emailchanged']=="blank"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>No text fields may be left blank or ommitted.</div>"; }
				  else if($_GET['emailchanged']=="invalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The email address that you entered was invalid.</div>"; }
				  if($_GET['smschanged']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The sms notification settings have been successfully updated.</div>"; }
                  else if($_GET['smschanged']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The sms notification settings have failed to update.</div>"; }
				  else if($_GET['smschanged']=="blank"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>No text fields may be left blank or ommitted.</div>"; }
				  else if($_GET['smschanged']=="invalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The phone number that you entered was invalid.</div>"; }
				  if($_GET['weatherchanged']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The external weather settings have been successfully updated.</div>"; }
                  else if($_GET['weatherchanged']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The email external weather settings have failed to update.</div>"; }
				  else if($_GET['weatherchanged']=="blank"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>No text fields may be left blank or ommitted.</div>"; }
				  else if($_GET['weatherchanged']=="latinvalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The latitude value that you entered was invalid.</div>"; }
				  else if($_GET['weatherchanged']=="longinvalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The longitude value that you entered was invalid.</div>"; }
				  else if($_GET['weatherchanged']=="apiinvalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The api key that you entered was invalid.</div>"; }
				  if($_GET['timeout']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Web sessions will now expire after " . $_GET['minutes'] . " minutes.</div>"; }
                  else if($_GET['timeout']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The web session timout has failed to update.</div>"; }
				  else if($_GET['timeout']=="invalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The web session timout must be between 3 and 20 minutes.</div>"; }
				  if($_GET['disable']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Standard users are now <strong>" . $_GET['able'] . "</strong> to enable/disable external unlock.</div>"; }
                  else if($_GET['disable']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The external unlock rights have failed to update.</div>"; }
				  ?>
            
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
          	
          	<?php
				
				include("db.php");
				
				$timeout = mysql_result(mysql_query("SELECT timeout FROM settings LIMIT 1;"),0);
				
				$emailenabled = mysql_result(mysql_query("SELECT emailenabled FROM settings LIMIT 1"),0);
				$toemail = mysql_result(mysql_query("SELECT toemail FROM settings LIMIT 1"),0);
				$tofirstname = mysql_result(mysql_query("SELECT tofirstname FROM settings LIMIT 1"),0);
				$tolastname = mysql_result(mysql_query("SELECT tolastname FROM settings LIMIT 1"),0);
				$fromemail = mysql_result(mysql_query("SELECT fromemail FROM settings LIMIT 1"),0);
				$emailtime = intval(mysql_result(mysql_query("SELECT emailtime FROM settings LIMIT 1"),0));
				
				$smsenabled = mysql_result(mysql_query("SELECT smsenabled FROM settings LIMIT 1"),0);
				$tosms = mysql_result(mysql_query("SELECT tosms FROM settings LIMIT 1"),0);
				$tosmsfirstname = mysql_result(mysql_query("SELECT tosmsfirstname FROM settings LIMIT 1"),0);
				$tosmslastname = mysql_result(mysql_query("SELECT tosmslastname FROM settings LIMIT 1"),0);
				
				$apitext = mysql_result(mysql_query("SELECT weatherapi FROM settings LIMIT 1"),0);
				$lat = mysql_result(mysql_query("SELECT weatherlat FROM settings LIMIT 1"),0);
				$long = mysql_result(mysql_query("SELECT weatherlong FROM settings LIMIT 1"),0);
				
				$emailstatus = "Disabled";
				
				if($emailenabled==1){
					$emailstatus = "Enabled";
				}
				
				$smsstatus = "Disabled";
				
				if($smsenabled==1){
					$smsstatus = "Enabled";
				}
          	?>
          	
          	         	
          	<form style="margin-top: 20px;" role="form" method="post" action="logintimoutchange.php">
          		<label>How many minutes before web session times out: </label>
				<input style="width:50px;" type="number" min="3" max="20" name="timeout" id="timeout" value="<?php echo $timeout;?>">
				<input style="padding: 3px 6px !important;" class="btn btn-primary" id="timout-button" type="submit" name="submit" value="Save Changes" data-toggle="modal" data-controls-modal="#buffering" data-backdrop="static" data-keyboard="false" data-target="#buffering" /> 
          	</form><br/>
          	
          	<strong>Email Notifications and Reports:</strong> <button style="font-size: 14px; padding: 3px 6px !important;"" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#emailsettings"><?php echo $emailstatus; ?></button><br/><br/>
          	
          	<strong>SMS Notifications:</strong> <button style="font-size: 14px; padding: 3px 6px !important;"" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#smssettings"><?php echo $smsstatus; ?></button><br/><br/>
          	 
          	<strong>External Weather Settings:</strong> <button style="font-size: 14px; padding: 3px 6px !important;"" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#weathersettings">Change Settings</button>
          	          	
          	<div class="modal fade" id="emailsettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Change Email Notifications and Reports Settings</h4>
			      </div>
			       <form name="e1" role="form" action="changeemail.php" method="post">
				      <div class="modal-body">
				      	  <label for="emailcheck">Enable email notifications and reports:</label>
						  <input type="checkbox" name="emailcheck" id="emailcheck" value="true" <?php if($emailenabled==1){echo 'checked="check"';}?> onclick="enable_form(this.checked)"/>
				      	  <br />
				      	  
				      	  <label for="toemail">Email Address:</label>
						  <input class="form-control" type="text" name="toemail" id="toemail" value="<?php echo $toemail; ?>" <?php if($emailenabled!=1){echo 'disabled="true"';}?> />
						  <p class="help-block">This is the email address that the emails will be sent to.</p>
						  
						  <label for="tofirstname">First Name:</label>
						  <input class="form-control" type="text" name="tofirstname" id="tofirstname" value="<?php echo $tofirstname; ?>" <?php if($emailenabled!=1){echo 'disabled="true"';}?> />
						  <p class="help-block">This is the first name of the person associcated with the email address that the emails will be sent to.</p>
						  
						  <label for="tolastname">Last Name:</label>
						  <input class="form-control" type="text" name="tolastname" id="tolastname" value="<?php echo $tolastname; ?>" <?php if($emailenabled!=1){echo 'disabled="true"';}?> />
						  <p class="help-block">This is the last name of the person associcated with the email address that the emails will be sent to.</p>
						  
						  <label for="emailtime">Time weekly email report will be sent:</label>
						  <select name="emailtime" id="emailtime" class="form-control" <?php if($emailenabled!=1){echo 'disabled="true"';}?>>
			                <option value="0" <?php if($emailtime==0){echo 'selected';}?>>Midnight</option>
			                <option value="1" <?php if($emailtime==1){echo 'selected';}?>>1am</option>
			                <option value="2" <?php if($emailtime==2){echo 'selected';}?>>2am</option>
			                <option value="3" <?php if($emailtime==3){echo 'selected';}?>>3am</option>
			                <option value="4" <?php if($emailtime==4){echo 'selected';}?>>4am</option>
			                <option value="5" <?php if($emailtime==5){echo 'selected';}?>>5am</option>
			                <option value="6" <?php if($emailtime==6){echo 'selected';}?>>6am</option>
			                <option value="7" <?php if($emailtime==7){echo 'selected';}?>>7am</option>
			                <option value="8" <?php if($emailtime==8){echo 'selected';}?>>8am</option>
			                <option value="9" <?php if($emailtime==9){echo 'selected';}?>>9am</option>
			                <option value="10" <?php if($emailtime==10){echo 'selected';}?>>10am</option>
			                <option value="11" <?php if($emailtime==11){echo 'selected';}?>>11am</option>
			                <option value="12" <?php if($emailtime==12){echo 'selected';}?>>Midday</option>
			                <option value="13" <?php if($emailtime==13){echo 'selected';}?>>1pm</option>
			                <option value="14" <?php if($emailtime==14){echo 'selected';}?>>2pm</option>
			                <option value="15" <?php if($emailtime==15){echo 'selected';}?>>3pm</option>
			                <option value="16" <?php if($emailtime==16){echo 'selected';}?>>4pm</option>
			                <option value="17" <?php if($emailtime==17){echo 'selected';}?>>5pm</option>
			                <option value="18" <?php if($emailtime==18){echo 'selected';}?>>6pm</option>
			                <option value="19" <?php if($emailtime==19){echo 'selected';}?>>7pm</option>
			                <option value="20" <?php if($emailtime==20){echo 'selected';}?>>8pm</option>
			                <option value="21" <?php if($emailtime==21){echo 'selected';}?>>9pm</option>
			                <option value="22" <?php if($emailtime==22){echo 'selected';}?>>10pm</option>
			                <option value="23" <?php if($emailtime==23){echo 'selected';}?>>11pm</option>
			              </select>
						  <p class="help-block">This is the time when the weekly email reports will be sent each Monday for the previous week.</p>
						  
						  <label for="fromemail">From Email Address:</label>
						  <input class="form-control" type="email" name="fromemail" id="fromemail" value="<?php echo $fromemail; ?>" disabled="true"/>
						  <p class="help-block">This is the email address that the emails will be sent from (Cannot be changed).</p>
						  
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <input class="btn btn-primary" id="change-button" type="submit" name="submit" value="Save Changes" data-toggle="modal" data-controls-modal="#buffering" data-backdrop="static" data-keyboard="false" data-target="#buffering" /> 
				      </div>
				  </form>
			    </div>
			  </div>
			</div>
			
			<div class="modal fade" id="smssettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Change SMS Notifications Settings</h4>
			      </div>
			       <form name="g1" role="form" action="changesms.php" method="post">
				      <div class="modal-body">
				      	  <label for="smscheck">Enable sms notifications:</label>
						  <input type="checkbox" name="smscheck" id="smscheck" value="true" <?php if($smsenabled==1){echo 'checked="check"';}?> onclick="enable_form1(this.checked)"/>
				      	  <br />
				      	  
				      	  <label for="tosms">Phone Number:</label>
						  <input class="form-control" type="text" name="tosms" id="tosms" value="<?php echo $tosms; ?>" <?php if($smsenabled!=1){echo 'disabled="true"';}?> />
						  <p class="help-block">This is the phone number that the emails will be sent to. It must be formatted as an international number.</p>
						  
						  <label for="tosmsfirstname">First Name:</label>
						  <input class="form-control" type="text" name="tosmsfirstname" id="tosmsfirstname" value="<?php echo $tosmsfirstname; ?>" <?php if($smsenabled!=1){echo 'disabled="true"';}?> />
						  <p class="help-block">This is the first name of the person associcated with the phone number that the sms's will be sent to.</p>
						  
						  <label for="tosmslastname">Last Name:</label>
						  <input class="form-control" type="text" name="tosmslastname" id="tosmslastname" value="<?php echo $tosmslastname; ?>" <?php if($smsenabled!=1){echo 'disabled="true"';}?> />
						  <p class="help-block">This is the last name of the person associcated with the phone number that the sms's will be sent to.</p>
						  
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <input class="btn btn-primary" id="change-button" type="submit" name="submit" value="Save Changes" data-toggle="modal" data-controls-modal="#buffering" data-backdrop="static" data-keyboard="false" data-target="#buffering" /> 
				      </div>
				  </form>
			    </div>
			  </div>
			</div>
			
			<div class="modal fade" id="weathersettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Change External Weather Settings</h4>
			      </div>
			       <form name="f1" role="form" action="changeweather.php" method="post">
				      <div class="modal-body">
				      	  
				      	  <label for="apitext">Weather Api:</label>
						  <input class="form-control" type="text" name="apitext" id="apitext" value="<?php echo $apitext; ?>"/>
						  <p class="help-block">The weather information is provided by <a href="https://developer.forecast.io/" target="_blank">developer.forecast.io</a> and this service requires a unique api key which can be acquired br registering here (<a href="https://developer.forecast.io/" target="_blank">developer.forecast.io</a>). The system allows a 1000 free api calls per api per day but the SEM system only uses roughly 470 api calls per day so this service should be free.</p>
						  
						  <label for="lat">Your Locations Latitude:</label>
						  <input class="form-control" type="text" name="lat" id="lat" value="<?php echo $lat; ?>" />
						  <p class="help-block">This is the Latitude of your location e.g. 37.826711 this value can be found by using <a href="https://maps.google.com" target="_blank">Google Maps</a>.</p>
						  
						  <label for="long">Your locations Longitude:</label>
						  <input class="form-control" type="text" name="long" id="long" value="<?php echo $long; ?>"/>
						  <p class="help-block">This is the Longitude of your location e.g. -122.423132 this value can be found by using <a href="https://maps.google.com" target="_blank">Google Maps</a>.</p>
						  
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <input class="btn btn-primary" id="change-button" type="submit" name="submit" value="Save Changes" data-toggle="modal" data-controls-modal="#buffering" data-backdrop="static" data-keyboard="false" data-target="#buffering" /> 
				      </div>
				  </form>
			    </div>
			  </div>
			</div>
			
			<div class="modal fade" id="buffering" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div style="width: 93px!important; margin-left: 250px; margin-top: 130px;" class="modal-content">
			      <img width="90px" src="img/buffer.gif" />
			    </div>
			  </div>
			</div>
          	
          	
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="js/clock.js"></script>
		
    </script>
    
  </body>
</html>
