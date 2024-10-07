<html>
<head>
<title>affari miei : propose</title>
</head>
<body>
<?php
$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);
$jdata[2]=time();
$jdata[3]=$_GET["val"];
$jdata[4]=false;
$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");

?>
</body>
</html>
