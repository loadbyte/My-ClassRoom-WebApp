<?php
require_once('includes/configure.php');

if($_SESSION['login'])
	header("location:pages/dashboard.php");
else
	header("location:pages/login.php");