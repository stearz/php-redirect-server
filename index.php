<?php
/*
 * This is a php-redirect-server
 * written in PHP 2011 by Stephan Schwarz
 *
 */

require('config.inc.php');

// --------------------------------------------------
//  Init Section
// --------------------------------------------------

// Get actual date and time
 $now = date('Y-m-d H:i:s');

// Validate HTTP-Host Header
 $REQUESTED_HTTPHOST = strtolower($_SERVER['HTTP_HOST']);
 if (preg_match('/^(([a-zA-Z]|[a-zA-Z][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z]|[A-Za-z][A-Za-z0-9\-]*[A-Za-z0-9])$/',$REQUESTED_HTTPHOST) == 0)
 {
   die('HTTP_HOST is strange...');
 }

// Initialize connection to database
 $db_handle = mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
 if (!$db_handle) {
   die('No DB connection: ' . mysql_error());
 }

// Build SQL request
 $db_request = "SELECT `type`,`name`,`target` FROM `$DB_NAME`.`$DB_TABL` WHERE `name`='$REQUESTED_HTTPHOST' AND ((`active_from`<'$now' OR `active_from` IS NULL) AND (`active_until`>'$now' OR `active_until` IS NULL)) LIMIT 0,1";

// --------------------------------------------------
//  Program Section
// --------------------------------------------------

$db_ressource = mysql_query($db_request,$db_handle);
if (!$db_ressource)
{
  die('DB request went wrong: ' . mysql_error());
}
$db_row = mysql_fetch_array($db_ressource, MYSQL_NUM);

if (is_array($db_row))
{
  $curt_type   = $db_row[0];
  $curt_source = $db_row[1];
  $curt_target = $db_row[2];
  if (!preg_match('@^(http|https)://@',$curt_target))
  {
    $curt_target = 'http://'.$curt_target;
  }

  $curt_needed_module = 'mod_'.strtolower($curt_type).'.inc.php';
  if (is_file($curt_needed_module))
  {
    include $curt_needed_module;
  }
}

// --------------------------------------------------
//  Exit Section
// --------------------------------------------------

mysql_close($db_handle);

header("HTTP/1.0 404 Not Found");
header("Connection: close");

?>
