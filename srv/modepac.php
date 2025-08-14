<html>
<head>
<title>AffariMiei : mode pacchi</title>
</head>
<body>
<?php

$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);

$jdata[2]=(new DateTime())->format('Uv');
$jdata[3]=null; // rimuovi qualsiasi offerta vecchia
$jdata[4]=False; // reset stato offerta
$jdata[7]=False; // mod. pacchi

$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");
?>
</body>
</html>
