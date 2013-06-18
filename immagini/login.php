<?php
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Badger - LogIn</title>
<style type="text/css">
<!--
body,td,th {
	font-family: verdana;
	font-size: 16px;
}
body {
	margin-left: 0px;
	margin-top: 25px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#loginform {
	padding: 25px;
	background-color: white;
	border: 1px solid #777777;
	margin: auto;
	width: 310px;
	margin-top: 30px;
	border-bottom: 0;
	border-left: 0;
	border-right: 0;
}
input {
	width: 200px;
	border: 1px solid black;
	font-size: 16px;
	height: 30px;
	margin-bottom: 10px;
	margin-top: 10px;
	text-align: center;
}
input.button {
	background-color: #FFE401;
	margin-top: 7px;
	height: 40px;
}
-->
</style>
</head>

<body>
<div align="center"><img src="immagini/tasso.png" alt="Tasso" width="70" height="70" style="margin-right:10px" />  <img src="immagini/badger.png" alt="Badger" width="278" height="71" /><br />
</div>
<div id="loginform">
  <form id="form1" name="form1" method="post" action="">
  <div align="center">Nome<br />
    <input type="text" name="username" id="username" />
    <br />
    Password<br />
    <input type="password" name="password" id="password" />
    <label>
    <input type="image" name="Accedi" id="Accedi" style="border:0" src="immagini/bottone.png" onClick="document.getElementById('form1').submit"/>
    </label>
  </div>
</form>
</div>
<div align="center"></div>
</body>
</html>
