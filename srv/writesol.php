<html>
<head>
<title>AffariMiei : write-solution</title>
</head>
<body>
<?php
if(!isset($_GET["col"],$_GET["row"]))
	die("debug: no query data, abort<br>");

$valc = intval($_GET["col"]);
$valr = intval($_GET["row"]);

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);

if($valc>=0 && $valr>=0 && $valc<2 && $valr<$jdata[10]) {
	$jdata[$valc][$valr]["show"]=false;
	$jdata[9]=[$valc,$valr];
	$jdata[2]=(new DateTime())->format('Uv');
	$jfile = json_encode($jdata);
	file_put_contents("./data/pacchi.json",$jfile);
	print("debug: json updated<br>");
} else {
	print("debug: id not valid<br>");
}
?>
</body>
</html>
