<html>
<head>
<title>affari miei : write-regioni-rqst</title>
</head>
<body>
<?php
if(!isset($_GET["data"]))
	die("debug: no query data, abort<br>");

$jrem = json_decode($_GET["data"],true);

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);

foreach($jrem as $jelm) {
	$valc=$jelm[0];
	$valr=$jelm[1];
	if(($valc<0) or ($valr<0) or ($valc>1) or ($valr>14)) {
		die("debug: not valid ids in query<br>");
	} else {
		$jdata[5+$valc][$valr]["show"]=false;
	}
}
$jdata[2]=time();
$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");
?>
</body>
</html>
