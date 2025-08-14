<!DOCTYPE html>

<html style="height:100%;">

<head>
<title>AffariMiei : display</title>
</head>

<body>

<?php
// READ DATA & SETTINGS
$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);
// SPLASH REDIRECT
if($jdata[8]) {
	header("Location: splash.php");
	die();
}
// SPLASH SOLUTION
if(($jdata[9][0]!=-1) and ($jdata[9][1]!=-1)) {
	$solution=True;
	$soltxt=$jdata[$jdata[9][0]][$jdata[9][1]]["desc"];
} else {
	$solution=False;
}
?>

<div style='display:flex;justify-content:center;margin:0;margin-top:2%;padding:0;align-items:center;font-size:1.5vw;'>
	<b>Affari Tuoi</b> <img src="\data\logo_inline.png" height="8%" width="8%"> <i>2<sup>a</sup> edizione</i>
</div>

<div style="display:flex;margin-left:0;margin-right:0;margin-top:0;margin-bottom:0;height:89%">

<?php
// SELETTORE COLONNE PACCHI/REGIONI
if($jdata[7]) {
	$loff=5;
	$pacpercol=$jdata[11];
} else {
	$loff=0;
	$pacpercol=$jdata[10];
}
// PADDING, MARGIN and FONTSIZE
if($pacpercol<10) { // minimal size requirement
	$str_pad=2;
	$str_mar=1;
} else {
	$str_pad=2-($pacpercol-10)/5; // from 10 to 15 -> from 0 to -1 -> from 2 to 1
	$str_mar=1-($pacpercol-10)/10; // from 10 to 15 -> from 0 to -0.5 -> from 1 to 0.5
}
$topbot_pad=$str_pad."%;";
$topbot_mar=$str_mar."%";
#$topbot_pad="2%;"; // 2% for 10pc 1% for 30pc
#$topbot_mar="1%"; // 1% for 10pc 0.5% for 30pc
$fontsize="1.5vw";
?>
	
<div style="display:flex;flex-direction: column;justify-content: flex-end;width: 50%; margin-left:0;">
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
			echo "<div id='a".$cnt."' class='tabregL' style='font-family:fontpacchi;width:5%;background-color:#cfcf00;'>&nbsp;</div>";
		else
			echo "<div id='a".$cnt."' class='tabblu' style='font-family:fontpacchi;width:5%;'>&nbsp;</div>";
	}
	$cnt++;
}
?>
</div>

<div style="display:flex;flex-direction: column;justify-content: flex-end;width: 50%; margin-right:0; margin-left: auto;">
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
			echo "<div id='b".$cnt."' class='tabregR' style='font-family:fontpacchi;width:5%;'>&nbsp;</div>";
		else
			echo "<div id='b".$cnt."' class='tabred' style='font-family:fontpacchi;width:5%;'>&nbsp;</div>";
	}
	$cnt++;
}
?>
</div>

</div>

<?php
// BANNER OFFERTA o SOLUZIONE
echo "<div style=\"justify-content:center;position:absolute;width:50%;bottom:5%;left:50%;align-items:center;\">\n";
if(!$jdata[7]) {
	if($jdata[3]!=null) {
		if($jdata[4])
			echo "<div class='tabyel' style='font-family:fontpacchi;color:#00af00;'>".$jdata[3]."</div>";
		else
			echo "<div class='tabyel' style='font-family:fontpacchi;'>".$jdata[3]."</div>";
	} else {
		if($solution) {
			if($jdata[9][0]==1) // rosso
				echo "<div class='tabyel' style='font-family:fontpacchi;background-color: #cf0000;color:white;'>".$soltxt."</div>";
			else // blu
				echo "<div class='tabyel' style='font-family:fontpacchi;background-color: #0000cf;color:white;'>".$soltxt."</div>";
		}
	}
}
echo "</div>\n";
?>

</body>

<style>

@font-face {
	font-family: fontpacchi;
	src: url(/data/font.ttf);
}

body {
	padding:0;
	margin: 0;
	height: 100%;
	overflow:hidden;
	<?php
		if($jdata[7])
			echo "background-image: url(\"data/wp_regioni.png\");";
		else
			echo "background-image: url(\"data/wp_pacchi.png\");";
	?>
  	background-position: center;
  	background-repeat: no-repeat;
  	background-size: cover;
}

.tabblu {
	display: flex;
	justify-content: flex-end;
	width: 50%;
	height: 3.5%;
	background-color: #0000cf;
	padding-left: 0%;
	padding-right: 3%;
	padding-top: <?php echo $topbot_pad; ?>;
	padding-bottom: <?php echo $topbot_pad; ?>;
	color: white;
	margin-top: <?php echo $topbot_mar; ?>;
	margin-bottom: <?php echo $topbot_mar; ?>;
	font-size: <?php echo $fontsize; ?>;
	align-items: center;
	border-radius: 0 10px 10px 0;
}

.tabregL {
	display: flex;
	justify-content: flex-end;
	width: 50%;
	height: 3.5%;
	background-color: #afaf00;
	padding-left: 0%;
	padding-right: 3%;
	padding-top: <?php echo $topbot_pad; ?>;
	padding-bottom: <?php echo $topbot_pad; ?>;
	color: black;
	margin-top: <?php echo $topbot_mar; ?>;
	margin-bottom: <?php echo $topbot_mar; ?>;
	font-size: <?php echo $fontsize; ?>;
	align-items: center;
	border-radius: 0 10px 10px 0;
}

.tabred {
	display: flex;
	width: 50%;
	height: 3.5%;
	background-color: #cf0000;
	padding-left: 3%;
	padding-right: 0%;
	padding-top: <?php echo $topbot_pad; ?>;
	padding-bottom: <?php echo $topbot_pad; ?>;
	color: white;
	margin-right:0;
	margin-left:auto;
	margin-top: <?php echo $topbot_mar; ?>;
	margin-bottom: <?php echo $topbot_mar; ?>;
	font-size: <?php echo $fontsize; ?>;
	align-items: center;
	border-radius: 10px 0 0 10px;
}

.tabregR {
	display: flex;
	width: 50%;
	height: 3.5%;
	background-color: #afaf00;
	padding-left: 3%;
	padding-right: 0%;
	padding-top: <?php echo $topbot_pad; ?>;
	padding-bottom: <?php echo $topbot_pad; ?>;
	color: black;
	margin-right:0;
	margin-left:auto;
	margin-top: <?php echo $topbot_mar; ?>;
	margin-bottom: <?php echo $topbot_mar; ?>;
	font-size: <?php echo $fontsize; ?>;
	align-items: center;
	border-radius: 10px 0 0 10px;
}

.tabyel {
	display: flex; 
	width:45%;
	justify-content: center;
	text-align:center;
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

function controlla() {
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

setInterval(controlla, 500);

</script>

</html>
