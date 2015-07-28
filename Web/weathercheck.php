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

            			This script used by the homepage to display realtime data.
		  
        ---------------------------------------------- PAGE INFO END ----------------------------------------------*/
		
	$type=$_GET['v'];
	$pass=$_GET['p'];
	
	include('db.php');
 
	 $dbpass = mysql_result(mysql_query("SELECT phppass FROM settings LIMIT 1;"),0);
	 
	 if($pass==$dbpass){
		
		$weatherraw=mysql_query("SELECT * FROM environment1 ORDER BY id DESC LIMIT 1");
		$weatherrow=mysql_fetch_array($weatherraw);
		$time=strtotime($weatherrow['time']);
		$inttemp = $weatherrow['inttemp'];
		$exttemp = strval(round(floatval($weatherrow['exttemp']),1));
		$inthum = $weatherrow['inthum'];
		$exthum = $weatherrow['exthum'];
		$light = $weatherrow['light'];
		$conditions = $weatherrow['conditions'];
		
		$inttempmax = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")))),1));
		$inttempmaxdiff = round((floatval($inttempmax) - floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))))),1);
		$inttempmin = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")))),1));
		$inttempmindiff = round((floatval($inttempmin) - floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(inttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))))),1);
		
		$exttempmax = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")))),1));
		$exttempmaxdiff = round((floatval($exttempmax) - floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))))),1);
		$exttempmin = strval(round(floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")))),1));
		$exttempmindiff = round((floatval($exttempmin) - floatval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(exttemp) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))))),1);
		
		$inthummax = implode(mysql_fetch_assoc(mysql_query("SELECT MAX(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")));
		$inthummaxdiff = intval($inthummax) - intval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))));
		$inthummin = implode(mysql_fetch_assoc(mysql_query("SELECT MIN(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")));
		$inthummindiff = intval($inthummin) - intval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(inthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))));
		
		$exthummax = implode(mysql_fetch_assoc(mysql_query("SELECT MAX(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")));
		$exthummaxdiff = intval($exthummax) - intval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))));
		$exthummin = implode(mysql_fetch_assoc(mysql_query("SELECT MIN(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")));
		$exthummindiff = intval($exthummin) - intval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(exthum) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))));
		
		$intlightmax = implode(mysql_fetch_assoc(mysql_query("SELECT MAX(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")));
		$intlightmaxdiff = intval($intlightmax) - intval(implode(mysql_fetch_assoc(mysql_query("SELECT MAX(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))));
		$intlightmin = implode(mysql_fetch_assoc(mysql_query("SELECT MIN(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "') AND TIMESTAMP('" . date("Y\-m\-d H:m:s") . "');")));
		$intlightmindiff = intval($intlightmin) - intval(implode(mysql_fetch_assoc(mysql_query("SELECT MIN(light) FROM environment1 WHERE TIMESTAMP(time) BETWEEN TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-48 hours')) . "') AND TIMESTAMP('" . date('Y\-m\-d H:m:s',strtotime('-24 hours')) . "');"))));
				
		$weatheroldraw=mysql_query("SELECT * FROM environment1 ORDER BY id DESC LIMIT 1,1");
		$weatheroldrow=mysql_fetch_array($weatheroldraw);
		$inttempold = $weatheroldrow['inttemp'];
		$exttempold = strval(round(floatval($weatheroldrow['exttemp']),1));
		$inthumold = $weatheroldrow['inthum'];
		$exthumold = $weatheroldrow['exthum'];
		$lightold = $weatheroldrow['light'];
		
		$lastoffline = strtotime(mysql_result(mysql_query("SELECT time FROM emaillogs WHERE emailstatus LIKE '%offline%' ORDER BY id DESC LIMIT 1;"),0));
		$lastbackonline = strtotime(mysql_result(mysql_query("SELECT time FROM emaillogs WHERE emailstatus LIKE '%online%' ORDER BY id DESC LIMIT 1;"),0));
		
		if ($type=="d") {
			echo 'Current internal temperature: ' . $inttemp . "&#176;C<br/>";
			echo 'Current external temperature: ' . $exttemp . "&#176;C<br/>";
			echo 'Current internal humidity: '. $inthum . "%<br/>";
			echo 'Current external humidity: '. $exthum . "%<br/>";
			echo 'Current light: '. $light . " lux<br/>";
			echo 'Weather: '. ucwords(str_replace("-"," ",$conditions)) . "<br/>";
			echo '<img src="img/weather-icon/' . $conditions . '.png"/><br/>';
			echo "Last Updated: " . date('h:i:s A l jS \of F Y', $time);
		}
		elseif ($type=="it") {
			echo $inttemp . "&#176;C";
		}
		elseif ($type=="et") {
			echo $exttemp . "&#176;C";
		}
		elseif ($type=="t") {
			$inttempdiff = round((floatval($inttemp) - floatval($inttempold)),1);
			$inttempdiffstr = "";
			if($inttempdiff>0){
				$inttempdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($inttempdiff) . "&#176;C</strong>)";
			}
			elseif ($inttempdiff<0) {
				$inttempdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($inttempdiff*-1)) . "&#176;C</strong>)";
			}
			elseif ($inttempdiff==0) {
				$inttempdiffstr = "(<strong style='color: #337AB7;'>&#177;0&#176;C</strong>)";
			}
			else {
				$inttempdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$inttempmaxdiffstr = "";
			if($inttempmaxdiff>0){
				$inttempmaxdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($inttempmaxdiff) . "&#176;C</strong>)";
			}
			elseif ($inttempmaxdiff<0) {
				$inttempmaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($inttempmaxdiff*-1)) . "&#176;C</strong>)";
			}
			elseif ($inttempmaxdiff==0) {
				$inttempmaxdiffstr = "(<strong style='color: #337AB7;'>&#177;0&#176;C</strong>)";
			}
			else {
				$inttempmaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$inttempmindiffstr = "";
			if($inttempmindiff>0){
				$inttempmindiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($inttempmindiff) . "&#176;C</strong>)";
			}
			elseif ($inttempmindiff<0) {
				$inttempmindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($inttempmindiff*-1)) . "&#176;C</strong>)";
			}
			elseif ($inttempmindiff==0) {
				$inttempmindiffstr = "(<strong style='color: #337AB7;'>&#177;0&#176;C</strong>)";
			}
			else {
				$inttempmindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$exttempdiff = round((floatval($exttemp) - floatval($exttempold)),1);
			$exttempdiffstr = "";
			if($exttempdiff>0){
				$exttempdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($exttempdiff) . "&#176;C</strong>)";
			}
			elseif ($exttempdiff<0) {
				$exttempdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($exttempdiff*-1)) . "&#176;C</strong>)";
			}
			elseif ($exttempdiff==0) {
				$exttempdiffstr = "(<strong style='color: #337AB7;'>&#177;0&#176;C</strong>)";
			}
			else {
				$exttempdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$exttempmaxdiffstr = "";
			if($exttempmaxdiff>0){
				$exttempmaxdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($exttempmaxdiff) . "&#176;C</strong>)";
			}
			elseif ($exttempmaxdiff<0) {
				$exttempmaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($exttempmaxdiff*-1)) . "&#176;C</strong>)";
			}
			elseif ($exttempmaxdiff==0) {
				$exttempmaxdiffstr = "(<strong style='color: #337AB7;'>&#177;0&#176;C</strong>)";
			}
			else {
				$exttempmaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$exttempmindiffstr = "";
			if($exttempmindiff>0){
				$exttempmindiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($exttempmindiff) . "&#176;C</strong>)";
			}
			elseif ($exttempmindiff<0) {
				$exttempmindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($exttempmindiff*-1)) . "&#176;C</strong>)";
			}
			elseif ($exttempmindiff==0) {
				$exttempmindiffstr = "(<strong style='color: #337AB7;'>&#177;0&#176;C</strong>)";
			}
			else {
				$exttempmindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			echo "<u>Current Internal Temperature:</u><br/><strong>" . $inttemp . "&#176;C " . $inttempdiffstr . "</strong><br style='margin-bottom: 5px;' />Last 24 hour's minimum:<br/><strong>" . $inttempmin . "&#176;C</strong> " . $inttempmindiffstr . "<br style='margin-bottom: 5px;' />Last 24 hour's maximum:<br/><strong>" . $inttempmax . "&#176;C</strong> " . $inttempmaxdiffstr . "<br/><br/><u>Current External Temperature:</u><br/><strong>" . $exttemp . "&#176;C " . $exttempdiffstr . "</strong><br style='margin-bottom: 5px;' />Last 24 hour's minimum:<br/><strong>" . $exttempmin . "&#176;C</strong> " . $exttempmindiffstr . "<br style='margin-bottom: 5px;' />Last 24 hour's maximum:<br/><strong>" . $exttempmax . "&#176;C</strong> " . $exttempmaxdiffstr;
		}
		elseif ($type=="ih") {
			echo $inthum . "%";
		}
		elseif ($type=="eh") {
			echo $exthum . "%";
		}
		elseif ($type=="h") {
			$inthumdiff = intval($inthum) - intval($inthumold);
			$inthumdiffstr = "";
			if($inthumdiff>0){
				$inthumdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($inthumdiff) . "%</strong>)";
			}
			elseif ($inthumdiff<0) {
				$inthumdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($inthumdiff*-1)) . "%</strong>)";
			}
			elseif ($inthumdiff==0) {
				$inthumdiffstr = "(<strong style='color: #337AB7;'>&#177;0%</strong>)";
			}
			else {
				$inthumdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$inthummaxdiffstr = "";
			if($inthummaxdiff>0){
				$inthummaxdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($inthummaxdiff) . "%</strong>)";
			}
			elseif ($inthummaxdiff<0) {
				$inthummaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($inthummaxdiff*-1)) . "%</strong>)";
			}
			elseif ($inthummaxdiff==0) {
				$inthummaxdiffstr = "(<strong style='color: #337AB7;'>&#177;0%</strong>)";
			}
			else {
				$inthummaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$inthummindiffstr = "";
			if($inthummindiff>0){
				$inthummindiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($inthummindiff) . "%</strong>)";
			}
			elseif ($inthummindiff<0) {
				$inthummindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($inthummindiff*-1)) . "%</strong>)";
			}
			elseif ($inthummindiff==0) {
				$inthummindiffstr = "(<strong style='color: #337AB7;'>&#177;0%</strong>)";
			}
			else {
				$inthummindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$exthumdiff = intval($exthum) - intval($exthumold);
			$exthumdiffstr = "";
			if($exthumdiff>0){
				$exthumdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($exthumdiff) . "%</strong>)";
			}
			elseif ($exthumdiff<0) {
				$exthumdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($exthumdiff*-1)) . "%</strong>)";
			}
			elseif ($exthumdiff==0) {
				$exthumdiffstr = "(<strong style='color: #337AB7;'>&#177;0%</strong>)";
			}
			else {
				$exthumdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$exthummaxdiffstr = "";
			if($exthummaxdiff>0){
				$exthummaxdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($exthummaxdiff) . "%</strong>)";
			}
			elseif ($exthummaxdiff<0) {
				$exthummaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($exthummaxdiff*-1)) . "%</strong>)";
			}
			elseif ($exthummaxdiff==0) {
				$exthummaxdiffstr = "(<strong style='color: #337AB7;'>&#177;0%</strong>)";
			}
			else {
				$exthummaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$exthummindiffstr = "";
			if($exthummindiff>0){
				$exthummindiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($exthummindiff) . "%</strong>)";
			}
			elseif ($exthummindiff<0) {
				$exthummindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($exthummindiff*-1)) . "%</strong>)";
			}
			elseif ($exthummindiff==0) {
				$exthummindiffstr = "(<strong style='color: #337AB7;'>&#177;0%</strong>)";
			}
			else {
				$exthummindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			echo "<u>Current Internal Humidity:</u><br/><strong>" . $inthum . "% " . $inthumdiffstr . "</strong><br style='margin-bottom: 5px;' />Last 24 hour's minimum:<br/><strong>" . $inthummin . "%</strong> " . $inthummindiffstr . "<br style='margin-bottom: 5px;' />Last 24 hour's maximum:<br/><strong>" . $inthummax . "%</strong> " . $inthummaxdiffstr . "<br/><br/><u>Current External Humidity:</u><br/><strong>" . $exthum . "% " . $exthumdiffstr . "</strong><br style='margin-bottom: 5px;' />Last 24 hour's minimum:<br/><strong>" . $exthummin . "%</strong> " . $exthummindiffstr . "<br style='margin-bottom: 5px;' />Last 24 hour's maximum:<br/><strong>" . $exthummax . "%</strong> " . $exthummaxdiffstr;
		}
		elseif ($type=="hi") {
			$Kconst = 273.15;
			
			$intdewpoint = pow(($inthum/100),(1/8))*(112+(0.9*$inttemp))+(0.1*$inttemp)-112;
			$intdewpointK = $intdewpoint + $Kconst;
			$inthumidex = $inttemp + 0.5555*(6.11*pow(exp(1),(5417.7530*((1/273.16)-(1/$intdewpointK))))-10);
			
			$intcomfort = "";
			$inthumidexcolor = "";
			
			if(round($inthumidex)<20){
				$intcomfort = "Below Scale Start Point";
				$inthumidexcolor = "#000000";
			}
			else if(round($inthumidex)>=20 && round($inthumidex)<30){
				$intcomfort = "Comfortable";
				$inthumidexcolor = "#5CB85C";
			}
			else if(round($inthumidex)>=30 && round($inthumidex)<40){
				$intcomfort = "Some Discomfort";
				$inthumidexcolor = "#FFD800";
			}
			else if(round($inthumidex)>=40 && round($inthumidex)<=45){
				$intcomfort = "Great Discomfort";
				$inthumidexcolor = "#FF6A00";
			}
			else if(round($inthumidex)>45){
				$intcomfort = "Dangerous";
				$inthumidexcolor = "#FF0000";
			}
			
			$extdewpoint = pow(($exthum/100),(1/8))*(112+(0.9*$exttemp))+(0.1*$exttemp)-112;
			$extdewpointK = $extdewpoint + $Kconst;
			$exthumidex = $exttemp + 0.5555*(6.11*pow(exp(1),(5417.7530*((1/273.16)-(1/$extdewpointK))))-10);
			
			$extcomfort = "";
			$exthumidexcolor = "";
			
			if(round($exthumidex)<20){
				$extcomfort = "Below Scale Start Point";
				$exthumidexcolor = "#000000";
			}
			else if(round($exthumidex)>=20 && round($exthumidex)<30){
				$extcomfort = "Comfortable";
				$exthumidexcolor = "#5CB85C";
			}
			else if(round($exthumidex)>=30 && round($exthumidex)<40){
				$extcomfort = "Some Discomfort";
				$exthumidexcolor = "#FFD800";
			}
			else if(round($exthumidex)>=40 && round($exthumidex)<=45){
				$extcomfort = "Great Discomfort";
				$exthumidexcolor = "#FF6A00";
			}
			else if(round($exthumidex)>45){
				$extcomfort = "Dangerous";
				$exthumidexcolor = "#FF0000";
			}
			
			echo "<u>Current Internal Humidex:</u><br/><strong>" . strval(round($inthumidex,1)) . "&#176;C</strong><br/>Degree of Comfort:<br/><strong style='color:" . $inthumidexcolor . ";'>" . $intcomfort . "</strong><br/><br/><u>Current External Humidex:</u><br/><strong>" . strval(round($exthumidex,1)) . "&#176;C</strong><br/>Degree of Comfort:<br/><strong style='color:" . $exthumidexcolor . ";'>" . $extcomfort . "</strong>";
		}
		elseif ($type=="c") {
			echo ucwords(str_replace("-"," ",$conditions));
		}
		elseif ($type=="x") {
			echo date('h:i:s A l jS \of F Y', $time);
		}
		elseif ($type=="w") {
			echo '<u>Current Weather:</u><br/><img height="120px" src="img/weather-icon/' . $conditions . '.png"/><br/>' . ucwords(str_replace("-"," ",$conditions));
		}
		elseif ($type=="il") {
			echo $light . " lux";
		}
		elseif ($type=="l") {
			$intlightdiff = intval($light) - intval($lightold);
			$intlightdiffstr = "";
			if($intlightdiff>0){
				$intlightdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($intlightdiff) . " lux</strong>)";
			}
			elseif ($intlightdiff<0) {
				$intlightdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($intlightdiff*-1)) . " lux</strong>)";
			}
			elseif ($intlightdiff==0) {
				$intlightdiffstr = "(<strong style='color: #337AB7;'>&#177;0 lux</strong>)";
			}
			else {
				$intlightdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$intlightmaxdiffstr = "";
			if($intlightmaxdiff>0){
				$intlightmaxdiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($intlightmaxdiff) . " lux</strong>)";
			}
			elseif ($intlightmaxdiff<0) {
				$intlightmaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($intlightmaxdiff*-1)) . " lux</strong>)";
			}
			elseif ($intlightmaxdiff==0) {
				$intlightmaxdiffstr = "(<strong style='color: #337AB7;'>&#177;0 lux</strong>)";
			}
			else {
				$intlightmaxdiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			$intlightmindiffstr = "";
			if($intlightmindiff>0){
				$intlightmindiffstr = "(<strong style='color: #5CB85C;'><i class='fa fa-arrow-up'></i> +" . strval($intlightmindiff) . " lux</strong>)";
			}
			elseif ($intlightmindiff<0) {
				$intlightmindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-arrow-down'></i> -" . strval(($intlightmindiff*-1)) . " lux</strong>)";
			}
			elseif ($intlightmindiff==0) {
				$intlightmindiffstr = "(<strong style='color: #337AB7;'>&#177;0 lux</strong>)";
			}
			else {
				$intlightmindiffstr = "(<strong style='color: #D9534F;'><i class='fa fa-times'></i> ERROR</strong>)";
			}
			
			echo "<u>Current Internal Light Level:</u><br/><strong>" . $light . " lux " . $intlightdiffstr . "</strong><br style='margin-bottom: 5px;' />Last 24 hour's minimum:<br/><strong>" . $intlightmin . " lux </strong>" . $intlightmindiffstr . "<br style='margin-bottom: 5px;' />Last 24 hour's maximum: <strong><br/>" . $intlightmax . " lux</strong> " . $intlightmaxdiffstr;
		}
		elseif ($type=="ds") {
			if ((time()-$time)<210) {
				echo "<div class='panel panel-success'>
	              <div class='panel-heading'>
	                <h3 class='panel-title'>Device Status <i title='Help' style='float: right; cursor: pointer;' class='fa fa-question' data-toggle='modal' data-target='#dsmodal'></i></h3>
	              </div>
	              <div style='text-align: center;' class='panel-body'>
	                <div><i class='fa fa-check'></i> Online and logging data</div><br/>
	                <div><u>Last data received:</u> " . date('g:i:s A l jS \of F Y', $time) . "</div><br/>
	                <div><u>Last offline:</u> " . date('g:i:s A l jS \of F Y', $lastoffline) . " for " . strval(round(($lastbackonline-$lastoffline)/60)) . " minutes</div>
	              </div>
	            </div>";
			}
			else {
				echo "<div class='panel panel-danger'>
	              <div class='panel-heading'>
	                <h3 class='panel-title'>Device Status <i title='Help' style='float: right; cursor: pointer;' class='fa fa-question' data-toggle='modal' data-target='#dsmodal'></i></h3>
	              </div>
	              <div style='text-align: center;' class='panel-body'>
	                <div><i class='fa fa-times'></i> Offline and not logging data</div><br/>
	                <div><u>Last data received:</u> " . date('g:i:s A l jS \of F Y', $time) . "</div>
	              </div>
	            </div>";
			}
		}
		else {
			echo "invalid request";
		}
	
		mysql_close();
	}
	else{
		echo "invalid passcode";
	}
?>
