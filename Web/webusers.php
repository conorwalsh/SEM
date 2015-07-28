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

               This page is used by admin users to change user details and add new users.
		  
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
            <li><a style="background-color: #3673A5; color: #fff" class="side-drop" href="webusers.php"><i class="fa fa-users"></i> Website users</a></li>
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
            <h1>Website Users <small>View and edit user settings</small></h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-users"></i> Website Users</li>
            </ol>
            
            <?php if($_GET['passchanged']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The password for " . $_GET['user'] . " has been successfully updated.</div>"; }
                  else if($_GET['passchanged']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The password for " . $_GET['user'] . " has failed to update.</div>"; }
				  else if($_GET['passchanged']=="invalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The password for " . $_GET['user'] . " must contain at least 5 characters.</div>"; }
				  if($_GET['deleted']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The user " . $_GET['user'] . " has been successfully deleted.</div>"; }
                  else if($_GET['deleted']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The user " . $_GET['user'] . " has failed to delete.</div>"; }
                  else if($_GET['deleted']=="invalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>There must be at least one user registered in the system.</div>"; }
                  else if($_GET['deleted']=="invalidadmin"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>There must be at least one admin user registered in the system.</div>"; }
                  if($_GET['newuser']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The new user " . $_GET['user'] . " has been successfully created.</div>"; }
                  else if($_GET['newuser']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The new user " . $_GET['user'] . " has not been successfully created (Maybe try a different username).</div>"; }
				  else if($_GET['newuser']=="passinvalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The password for the new user " . $_GET['user'] . " must contain at least five characters.</div>"; }
				  else if($_GET['newuser']=="userinvalid"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The username for the new user " . $_GET['user'] . " must contain at least four characters.</div>"; }
				  if($_GET['admin']=="true"){ echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The user status for " . $_GET['user'] . " has been successfully changed.</div>"; }
                  else if($_GET['admin']=="false"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>The user status for " . $_GET['user'] . " has not been successfully changed.</div>"; }
                  else if($_GET['admin']=="less"){ echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>There must be at least one Administrator.</div>"; }?>
            
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
          	
          	<script type="text/javascript">
				function getuser(a, b) {
				    document.getElementById('userhidden').value = a;
				    document.getElementById('deletehidden').value = a;
				    document.getElementById('deleteusername').innerHTML = b;
				}
				function changeadmin(a, b, c, d) {
				    document.getElementById('statushidden').value = a;
				    if(b==1){
				    	document.getElementById('adminhidden').value = 0;
				    }
				    else if(b==0){
				    	document.getElementById('adminhidden').value = 1;
				    }
				    document.getElementById('statususername').innerHTML = d;
				    document.getElementById('admintype').innerHTML = c;
				}
			</script>  
          	
          	<?php
            					
				// Retrieve data from database
				$sql="SELECT * FROM login;";
				$result=mysql_query($sql, $conn);
			?>
			
			<div class="table-responsive">
              <table style="vertical-align: middle !important;" id="logtable" class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                  	<th>Username <i class="fa fa-sort"></i></th>
                    <th>Password</th>
                    <th>User Status</th>
                    <th>Delete User</th>
                  </tr>
                </thead>
                <tbody>

				<?php
					while($rows=mysql_fetch_array($result)){
						$userid = $rows['id'];
				?>
	
				<tr style="vertical-align: middle !important;">
					<td style="vertical-align: middle !important;"><?php echo $rows['username']; ?></td>
					<td style="vertical-align: middle !important;"><button style="font-size: 14px;" onclick="getuser(<?php echo $rows['id']; ?>);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#changepincode">Change Password</button></td>
					<td style="vertical-align: middle !important;"><button style="font-size: 14px;" onclick="changeadmin(<?php $adminopp=""; if($rows['admin']==1){$adminopp="a Standard User";} else if($rows['admin']==0){$adminopp="an Admin";} echo $rows['id'] . ", " . $rows['admin'] . ", '" . $adminopp . "', '" . $rows['username'] . "'"; ?>);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#userstatus"><?php if($rows['admin']=="1"){echo "Admin";} elseif ($rows['admin']=="0") {echo "Standard User";} ?></button></td>
					<td style="vertical-align: middle !important;"><button style="font-size: 14px;" onclick="getuser(<?php echo $rows['id'] . ", '" . $rows['username'] . "'"?>);" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteuser">Delete User</button></td>
				</tr>
	
				<?php
					}
				?>
			    </tbody>
              </table>
              <button style="font-size: 14px;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#adduser">Add new user</button>
            </div>
            
          </div>

			<div class="modal fade" id="changepincode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
			      </div>
				   <form role="form" method="post" name="login" action="changepass.php">
				      <div class="modal-body">
				          <label for="pin">New password:</label>
						  <input class="form-control" type="password" name="pin" id="pin"/>
						  <p class="help-block">This is the users password for the web system.</p>
						  <p class="help-block">The password must contain at least 5 characters.</p>
						  <input type="hidden" id="userhidden" name="user" value=""/>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <input class="btn btn-primary" id="change-button" type="submit" name="submit" value="Save Changes" data-toggle="modal" data-controls-modal="#buffering" data-backdrop="static" data-keyboard="false" data-target="#buffering" /> 
				      </div>
				  </form>
			    </div>
			  </div>
			</div>
			
			<div role="form" class="modal fade" id="deleteuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
			      </div>
				   <form method="post" name="login" action="deleteweb.php">
				      <div class="modal-body">
				          <label>Are you sure that you want to delete <span id="deleteusername"></span>?</label>
				          <input type="hidden" id="deletehidden" name="user" value=""/>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
				        <input class="btn btn-success" id="change-button" type="submit" name="submit" value="Yes" data-toggle="modal" data-controls-modal="#buffering" data-backdrop="static" data-keyboard="false" data-target="#buffering" /> 
				      </div>
				  </form>
			    </div>
			  </div>
			</div>
			
			<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Add new user</h4>
			      </div>
				   <form role="form" action="newuser.php" method="post">
				      <div class="modal-body">
				      		<div class="form-group">
					      	  <label for="user">Username:</label>
							  <input class="form-control" type="text" name="user" id="user"/>
							  <p class="help-block">This is the users username which is used for login e.g. jdoe.</p>
							  <p class="help-block">The username must contain at least 4 characters.</p>
							</div>
							<div class="form-group">
					      	  <label for="pin">Password:</label>
							  <input class="form-control" type="password" name="pin" id="pin"/>
							  <p class="help-block">This is the users password for the web system.</p>
							  <p class="help-block">The password must contain at least 5 characters.</p>
							</div>
							<label>User Status:</label>
							<label class="radio-inline">
							  <input type="radio" name="admin" id="inlineRadio1" value="0" checked> Standard User
							</label>
							<label class="radio-inline">
							  <input type="radio" name="admin" id="inlineRadio2" value="1"> Admin
							</label>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <input class="btn btn-primary" id="change-button" type="submit" name="submit" value="Save Changes" data-toggle="modal" data-controls-modal="#buffering" data-backdrop="static" data-keyboard="false" data-target="#buffering" /> 
				      </div>
				  </form>
			    </div>
			  </div>
			</div>
			
			<div role="form" class="modal fade" id="userstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="myModalLabel">Change User Status</h4>
			      </div>
				   <form method="post" name="login" action="adminchange.php">
				      <div class="modal-body">
				          <label>Are you sure that you want to change <span id="statususername"></span> to <span id="admintype"></span>?</label>
				          <input type="hidden" id="statushidden" name="user" value=""/>
				          <input type="hidden" id="adminhidden" name="admin" value=""/>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
				        <input class="btn btn-success" id="change-button" type="submit" name="submit" value="Yes" data-toggle="modal" data-controls-modal="#buffering" data-backdrop="static" data-keyboard="false" data-target="#buffering" /> 
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

			<?php
				mysql_close();
			?>
            
		
		
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    

    <!-- Page Specific Plugins -->
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
