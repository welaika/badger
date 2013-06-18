<?php
$badgetable="badger";
// MD5 password: admin
$password="21232f297a57a5a743894a0e4a801fc3";

ini_set("display_errors", "on");
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_GET['logout']))
{
	session_destroy();
	session_start();
}
if((isset($_POST['username']))&&(isset($_POST['password'])))
{
	if(md5($_POST['password'])==$password)
	{
		$_SESSION['username']=$_POST['username'];
	}
}
if(!isset($_SESSION['username']))
{
	include("blocks/login.php");
	die("<!-- Go badgify yourself! -->");
	}


require_once("blocks/mysql.php");

if($_GET['action']=="salvadati")
{
	$nome=str_replace("'","’",$_POST['nome']);
	$cognome=str_replace("'","’",$_POST['cognome']);
	$email=str_replace("'","’",$_POST['email']);
	$etichetta=str_replace("'","’",$_POST['etichetta']);
	$gruppo=str_replace("'","’",$_POST['gruppo']);
	$presidio=str_replace("'","’",$_POST['presidio']);
	$regione=str_replace("'","’",$_POST['regione']);
	$query="INSERT INTO $badgetable VALUES ('','".$nome."','".$cognome."','".$email."','".$etichetta."','0','".$presidio."','".$gruppo."','".$_POST['regione']."')";
	if(mysql_query($query))
	{
		header("Location:index.php");
	}
}elseif($_GET['action']=="createbadge")
{
	session_start();
	$_SESSION['badgeID']=$_GET['id'];
	header("Location:croflash.php?idUtente=".$_GET['id']);
}elseif($badging)
{
	$query="SELECT * FROM $badgetable WHERE id='$id' LIMIT 1";
	$result=mysql_query($query);
	$badge["nome"]=mysql_result($result,0,"nome");
	$badge["id"]=mysql_result($result,0,"id");
	$badge["cognome"]=mysql_result($result,0,"cognome");
	$badge["etichetta"]=strtoupper(mysql_result($result,0,"etichetta"));
	include("disegna-badge.php");
	
}elseif($_GET['action']=="deletebadge")
{
	$id=$_GET['id'];
	$query="DELETE FROM $badgetable WHERE id='$id' LIMIT 1";
	if(mysql_query($query))
	{
		header("Location:index.php");
	}
	else
	{
		echo "Errore, non sono riuscito ad eseguire la query";
		sleep(2);
		header("Location:index.php");
	}
}
elseif($_GET['action']=="addToPrintList")
{
	$query="UPDATE $badgetable SET stampa='1' WHERE id='".$_GET['id']."'"; 
	mysql_query($query);
}
elseif($_GET['action']=="removeFromPrintList")
{
	$query="UPDATE $badgetable SET stampa='0' WHERE id='".$_GET['id']."'"; 
	mysql_query($query);
}
elseif($_GET['action']=="printA4")
{
	include("printA4.php");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Badger</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript">
<!--
        function esempio()
        {
            var tasto = window.event.keyCode;
            if (tasto == 220)
            {
                window.location = "index.php?action=nuovobadge"
            }
            if (tasto == 27)
            {
                window.location = "index.php"
            }
        }




function badgePreview(id)
{
	document.getElementById('badgepreview').style.display='block';
	document.getElementById('badgepreviewimage').src='badges/'+id+'.jpg';
}
//-->
</script>
</head>
<body onkeyup="esempio()">
    <div id="badgepreview">
        <a id="closebadgepreview" href="#" onClick="document.getElementById('badgepreview').style.display='none'">X</a>
        <img src="badges/badgeIMG.jpg" width="948" height="1418" id="badgepreviewimage" />
    </div>
    <div id="bd-header">
      <div align="right"><div style="margin-bottom:7px;"><img src="immagini/tasso.png" alt="Tasso" width="61" height="61" /><img src="immagini/badger.png" alt="Badger" width="197" height="60" style="margin-left:15px" /></div>
      Hello <?php echo $_SESSION['username']; ?>, what a nice badging day! <a href="index.php?logout">Esci</a></div>
</div>
<div id="menu">
        <a href="index.php">Home [Esc]</a> <a href="index.php?action=nuovobadge">Nuovo badge [\]</a>
        <a href="index.php?select=toPrint">Pronti</a><a href="index.php?select=printList">Coda di stampa</a>
        <a href="index.php?action=search">Cerca</a>
        <a href="index.php?action=listA4">Lista A4</a>
    </div>
    <p>
		<?php
        if($_GET['action']=="nuovobadge")
        {
            include("blocks/badge-nuovo-visitatore.php");
        }
        elseif($_GET['action']=="search")
        {
            include("blocks/badge-cerca-visitatore.php");
        }
		elseif($_GET['action']=="listA4")
    {
      include("blocks/badge-lista-A4.php");
    }
    else
    {
        include("blocks/badge-lista-visitatori.php");
    }
    ?>
    </p>
    <hr />
    <div align="center">Badger by welaika</div>
</body>
</html>
<?php
mysql_close();
?>