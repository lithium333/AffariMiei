<html>
<head>
<title>affari miei : mode pacchi</title>
</head>
<body>
<?php

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);

$jdata[2]=time();
$jdata[3]=null;
$jdata[4]=False;
$jdata[7]=False;

$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");
?>
</body>
</html>
