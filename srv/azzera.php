<html>
<head>
<title>AffariMiei : reset-mgr</title>
</head>
<body>
<?php

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);

// AZZERA PACCHI
for ($cnt=0;$cnt<$jdata[10];$cnt++) {
	$jdata[0][$cnt]["show"]=True;
	$jdata[1][$cnt]["show"]=True;
}
// AZZERA REGIONI
for ($cnt=0;$cnt<$jdata[11];$cnt++) {
	$jdata[5][$cnt]["show"]=True;
	$jdata[6][$cnt]["show"]=True;
}
$jdata[2]=(new DateTime())->format('Uv');
$jdata[3]=null; // nessuna offerta
$jdata[4]=False; // reset stato offerta
$jdata[7]=False; // mod. pacchi
$jdata[8]=False; // disattivare splash txt regione
$jdata[9]=[-1,-1]; // reset pacco vinto

$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");
?>
</body>
</html>
