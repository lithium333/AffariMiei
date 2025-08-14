<html>
<head>
<title>AffariMiei : propose</title>
</head>
<body>
<?php
$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);
$jdata[2]=(new DateTime())->format('Uv');
$jdata[3]=$_GET["val"]; // impostare txt offerta
$jdata[4]=false; // reset eventuale stato precedente anomalo
$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");

?>
</body>
</html>
