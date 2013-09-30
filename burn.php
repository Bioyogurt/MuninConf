<?php

$ch = curl_init("http://10.0.10.1/munin/mconf/mkconfig.php");
$fp = fopen("/var/www/html/munin/mconf/munin.conf", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ; 
curl_setopt($ch, CURLOPT_USERPWD, "nagiosadmin:admin"); 
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

header ("Location:index.php");
?>
