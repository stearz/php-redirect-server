<?php
//
// Permanent Redirect (301) Module
//    written 2011 by Stephan Schwarz
//
header("HTTP/1.1 301 Moved Permanently");
header("Location: $curt_target");
header("Connection: close");
exit;
?>
