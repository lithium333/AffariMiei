<!DOCTYPE html>

<html style="height:100%;">

<head>
<title>affari miei : display</title>
</head>

<body style="padding:0;margin:0;height:100%;overflow:hidden;">

<?php
$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);
if($jdata[8]) {
	header("Location: splash.php");
	die();
}

if(isset($_GET['quattroterzi']))
	$strictmode=True;
else
	$strictmode=False;
?>

<?php
if (!$jdata[7]) {
	echo "<div style='display:flex;justify-content:center;margin:0;margin-top:0%;padding:0;align-items:center;font-size:1.5vw;'>\n";
	if($strictmode)
		echo "<b>Affari Miei</b><img src=\"logotv.png\" height=\"15%\" width=\"15%\">\n";
	else
		echo "<b>Affari Miei</b><img src=\"logotv.png\" height=\"8%\" width=\"8%\">\n";
	echo "</div>\n";
}
?>


<?php
if ($jdata[7]) {
	if($strictmode)
		echo "<div style=\"display:flex;margin-left:0;margin-right:0;margin-top:6%;margin-bottom:0;\">\n";
	else
		echo "<div style=\"display:flex;margin-left:0;margin-right:0;margin-top:4.5%;margin-bottom:0;\">\n";
} else {
	if($strictmode)
		echo "<div style=\"display:flex;margin-left:0;margin-right:0;margin-top:0;margin-bottom:0;\">\n";
	else
		echo "<div style=\"display:flex;margin-left:0;margin-right:0;margin-top:0;margin-bottom:0;\">\n";
}
?>
	<?php
	// selettore regioni fortunate
	if($jdata[7])
		$loff=5;
	else
		$loff=0;
	?>
	
	<div style="width: 50%; margin-left:0">
	
	<?php
	$cnt=0;
	foreach ($jdata[0+$loff] as $jval) {
		if($jval["show"]) {
			if($jdata[7])
				echo "<div id='a".$cnt."' class='tabregL' style='font-family:fontpacchi;'><b>".$jval["desc"]."</b></div>";
			else
				echo "<div id='a".$cnt."' class='tabblu' style='font-family:fontpacchi;'><b>".$jval["desc"]."</b></div>";
			
		} else {
			if($jdata[7])
				echo "<div id='a".$cnt."' class='tabregL' style='width:5%;background-color:#cfcf00;'>&nbsp;</div>";
			else
				echo "<div id='a".$cnt."' class='tabblu' style='width:5%;'>&nbsp;</div>";
		}
		$cnt++;
	}
	?>
	</div>

	<div style="width: 50%; margin-right:0; margin-left: auto;">
	<?php
	$cnt=0;
	foreach ($jdata[1+$loff] as $jval) {
		if($jval["show"]) {
			if($jdata[7])
				echo "<div id='b".$cnt."' class='tabregR' style='font-family:fontpacchi;'><b>".$jval["desc"]."</b></div>";
			else
				echo "<div id='b".$cnt."' class='tabred' style='font-family:fontpacchi;'><b>".$jval["desc"]."</b></div>";
		} else {
			if($jdata[7])
				echo "<div id='b".$cnt."' class='tabregR' style='width:5%;'>&nbsp;</div>";
			else
				echo "<div id='b".$cnt."' class='tabred' style='width:5%;'>&nbsp;</div>";
		}
		$cnt++;
	}
	?>
	</div>

</div>



	
	<?php
	echo "<div style=\"justify-content:center;position:absolute;width:50%;bottom:5%;left:50%;align-items:center;\">\n";
	if(!$jdata[7]) {
		
		if($jdata[3]!=null) {
			if($jdata[4])
				echo "<div class='tabyel' style='font-family:fontpacchi;color:#00af00;'>".$jdata[3]."</div>";
			else
				echo "<div class='tabyel' style='font-family:fontpacchi;'>".$jdata[3]."</div>";
		}
	}
	echo "</div>\n";
	?>
	


</body>

<style>

@font-face {
	font-family: fontpacchi;
	src: url(font.ttf);
}

body {
	<?php
		if($jdata[7])
			echo "background-image: url(\"contrade.png\");";
		else
			echo "background-image: url(\"sfondopacchi.png\");";
	?>
  	background-position: center;
  	background-repeat: no-repeat;
  	background-size: cover;
}

.tabblu {
	display: flex;
	justify-content: flex-end;
	<?php
		if($strictmode)
			echo "width: 60%;\n";
		else
			echo "width: 50%;\n";
	
	?>
	height: 3.5%;
	background-color: #0000cf;
	padding-left: 0%;
	padding-right: 3%;
	<?php
		if($strictmode)
			echo "padding-top: 1.5%;\npadding-bottom: 1.5%;\n";
		else
			echo "padding-top: 1%;\npadding-bottom: 1%;\n";
	?>
	color: white;
	margin-top:1%;
	margin-bottom:1%;
	<?php
		if($strictmode)
			echo "font-size: 1.6vw;\n";
		else
			echo "font-size: 1.3vw;\n";
	?>
	align-items: center;
	border-radius: 0 10px 10px 0;
}

.tabregL {
	display: flex;
	justify-content: flex-end;
	width: 40%;
	height: 3.5%;
	background-color: #afaf00;
	padding-left: 0%;
	padding-right: 3%;
	<?php
		if($strictmode)
			echo "padding-top: 1.5%;\npadding-bottom: 1.5%;\n";
		else
			echo "padding-top: 1%;\npadding-bottom: 1%;\n";
	?>
	color: black;
	margin-top:1%;
	margin-bottom:1%;
	<?php
		if($strictmode)
			echo "font-size: 1.6vw;\n";
		else
			echo "font-size: 1.3vw;\n";
	?>
	align-items: center;
	border-radius: 0 10px 10px 0;
}

.tabred {
	display: flex;
	<?php
		if($strictmode)
			echo "width: 60%;\n";
		else
			echo "width: 50%;\n";
	
	?>
	height: 3.5%;
	background-color: #cf0000;
	padding-left: 3%;
	padding-right: 0%;
	<?php
		if($strictmode)
			echo "padding-top: 1.5%;\npadding-bottom: 1.5%;\n";
		else
			echo "padding-top: 1%;\npadding-bottom: 1%;\n";
	?>
	color: white;
	margin-right:0;
	margin-left:auto;
	margin-top:1%;
	margin-bottom:1%;
	<?php
		if($strictmode)
			echo "font-size: 1.6vw;\n";
		else
			echo "font-size: 1.3vw;\n";
	?>
	align-items: center;
	border-radius: 10px 0 0 10px;
}

.tabregR {
	display: flex;
	width: 40%;
	height: 3.5%;
	background-color: #afaf00;
	padding-left: 3%;
	padding-right: 0%;
	<?php
		if($strictmode)
			echo "padding-top: 1.5%;\npadding-bottom: 1.5%;\n";
		else
			echo "padding-top: 1%;\npadding-bottom: 1%;\n";
	?>
	color: black;
	margin-right:0;
	margin-left:auto;
	margin-top:1%;
	margin-bottom:1%;
	<?php
		if($strictmode)
			echo "font-size: 1.6vw;\n";
		else
			echo "font-size: 1.3vw;\n";
	?>
	align-items: center;
	border-radius: 10px 0 0 10px;
}

.tabyel {
	display: flex;
	<?php
		if($strictmode)
			echo "width:60%;\n";
		else
			echo "width:30%;\n";
	?>
	justify-content: center;
	background-color: #cfcf00;
	padding: 1%;
	color: black;
	font-size: 2.3vw;
	align-items: center;
	justify-content: center;
	border-radius: 15px 15px 15px 15px;
	transform:translate(-50%,0);
}

</style>

<script>
var ts = <?php echo $jdata[2];?>;

function myFunction() {
   var xmlHttp = new XMLHttpRequest();
   xmlHttp.open("GET", "./getupdate.php", true);
   xmlHttp.onload = function () {
       var tsnew = xmlHttp.responseText;
       if(tsnew!=ts) {
           console.log(tsnew);
           window.location.reload();
       }
   };
   xmlHttp.send();
}

setInterval(myFunction, 1000);
    
</script>

</html>
