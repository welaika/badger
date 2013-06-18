<?php
session_start();
if($_GET['password']=="bd2011")
{
	$_SESSION['auth']=true;
	header("Location:index.php");
}
?>