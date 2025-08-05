<?php
$jfile = file_get_contents("./data/pacchi.json");
$jdata = json_decode($jfile,true);
if($jdata[8]) echo "yes"; else echo "no";
?>
