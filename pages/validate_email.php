<?php
require_once('../includes/configure.php');
if(isset($_GET['email1']))
	$email = $_GET['email1'];
else if(isset($_GET['email2']))
	$email = $_GET['email2'];
else if(isset($_GET['email3']))
	$email = $_GET['email3'];
else if(isset($_GET['email4']))
	$email = $_GET['email4'];
echo $email;
if(isEmailExists($db, $email))
	header("HTTP/1.1 200 OK");
else
	header("HTTP/1.1 404");