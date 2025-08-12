<html>
<head>
<title>AffariMiei : load-mgr</title>
</head>
<body>
<?php
if(!isset($_GET["data"]))
	die("debug: no query data, abort<br>");

$jset = json_decode($_GET["data"],true);

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);



for ($cnt=0;$cnt<10;$cnt++) {
	$jdata[5][$cnt]["desc"]=$jset["B"][$cnt];
	$jdata[5][$cnt]["show"]=True;
	$jdata[6][$cnt]["desc"]=$jset["R"][$cnt];
	$jdata[6][$cnt]["show"]=True;
}
$jdata[2]=(new DateTime())->format('Uv');

$jfile = json_encode($jdata);

file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");

?>
</body>
</html>
