<?php
//
// Proxy Module BETA
//    written 2011 by Stephan Schwarz
//
$proxy_args = $_SERVER['REQUEST_URI'];
$proxy_ch = curl_init();
curl_setopt($proxy_ch, CURLOPT_URL, $curt_target.$proxy_args);
curl_setopt($proxy_ch, CURLOPT_RETURNTRANSFER, true);
$proxy_output = curl_exec($proxy_ch);
header('Content-type: '.curl_getinfo($proxy_ch, CURLINFO_CONTENT_TYPE));
echo $proxy_output;
curl_close($proxy_ch);
exit;
?>
