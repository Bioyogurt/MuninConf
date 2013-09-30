<?php

$ch = curl_init("mkconfig.php");
$fp = fopen("./munin.conf", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ; 
curl_setopt($ch, CURLOPT_USERPWD, "nagiosadmin:nagiosadmin"); 
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

header ("Location:index.php");
?>
