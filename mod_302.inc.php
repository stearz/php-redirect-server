<?php
//
// Permanent Redirect (302) Module
//    written 2011 by Stephan Schwarz
//
header("Location: $curt_target");
header("Connection: close");
exit;
?>
