<?php
session_start();

unset($_SESSION['u_id']);
unset($_SESSION['c_id']);
unset($_SESSION['u_role']);
unset($_SESSION['c_title']);
unset($_SESSION['u_email']);
unset($_SESSION['u_pass']);

session_destroy();
if(isset($_COOKIE['myclasscookue']) && isset($_COOKIE['myclasscookp'])){
	setcookie("myclasscookue", "", time()-60*60*24*100, "/");
	setcookie("myclasscookp", "", time()-60*60*24*100, "/");
}
header("location:login.php");

