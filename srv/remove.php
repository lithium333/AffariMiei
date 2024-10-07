<html>
<head>
<title>affari mie : remove prop</title>
</head>
<body>
<?php
$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);
$jdata[2]=time();
$jdata[3]=null;
$jfile = json_encode($jdata);
file_put_contents("./data/pacchi.json",$jfile);
print("debug: json updated<br>");

?>
</body>
</html>
