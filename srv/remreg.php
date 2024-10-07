<html>
<head>
<title>affari miei : write-regioni-rqst</title>
</head>
<body>
<?php
if(!isset($_GET["col"],$_GET["row"]))
	die("debug: no query data, abort<br>");

$valc = intval($_GET["col"]);
$valr = intval($_GET["row"]);

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);

if($valc>=0 && $valr>=0 && $valc<2 && $valr<15) {
	$jdata[5+$valc][$valr]["show"]=false;
	$jdata[2]=time();
	$jfile = json_encode($jdata);
	file_put_contents("./data/pacchi.json",$jfile);
	print("debug: json updated<br>");
} else {
	print("debug: id not valid<br>");
}
?>
</body>
</html>
