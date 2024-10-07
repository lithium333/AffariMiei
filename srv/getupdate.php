<?php
$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);
echo $jdata[2];
?>
