<?php
session_start();
/*
if(isset($_SESSION['session_login']['id']) && isset($_SESSION['session_login']['key']))
{
	
} else {
	
	header("location:../../admin.php");
}
*/
date_default_timezone_set ("Asia/Kolkata");
require_once('constants.php');
require_once('function.php');
require_once('CSRF_Protect.php');
require_once('MysqliDb.php');

//$db = new db_class;

$host = "localhost";
$user ="vino";
 $pass ="indian";
 $database ="classroom"; 
 /*
if (!$db->connect($host, $user, $pass, $database, true)) 
   $db->print_last_error(false);
  */
 $db = new MysqliDb ($host, $user, $pass, $database);

   //developer


 //env
 // $_SESSION['uid'] = 106;
