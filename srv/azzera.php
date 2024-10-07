<html>
<head>
<title>affari miei: reset-mgr</title>
</head>
<body>
<?php

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);


for ($cnt=0;$cnt<15;$cnt++) {
	$jdata[0][$cnt]["show"]=True;
	$jdata[1][$cnt]["show"]=True;
	$jdata[5][$cnt]["show"]=True;
	$jdata[6][$cnt]["show"]=True;
}
$jdata[2]=time();
$jdata[3]=null;
$jdata[4]=False;
$jdata[7]=False;
$jdata[8]=False;

$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");
?>
</body>
</html>
