<html>
<head>
<title>AffariMiei : enable-splash</title>
</head>
<body>
<?php

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);

$jdata[2]=(new DateTime())->format('Uv');
$jdata[8]=True; // enable splash

$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");
?>
</body>
</html>
