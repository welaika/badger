<?php
if(!isset($_SESSION["username"]))
{
	header("Location:index.php?logout");
}
require_once("blocks/mysql.php");

$query="SELECT * FROM badger WHERE id='".$_GET['idUtente']."' LIMIT 1";
$result=mysql_query($query);
$badge["nome"]=mysql_result($result,0,"nome");
$badge["id"]=mysql_result($result,0,"id");
$badge["cognome"]=mysql_result($result,0,"cognome");
$badge["gruppo"]=strtoupper(mysql_result($result,0,"gruppo"));
$badge["presidio"]=mysql_result($result,0,"presidio");
$badge["etichetta"]=strtoupper(mysql_result($result,0,"etichetta"));
$badge["regione"]=mysql_result($result,0,"regione");


str_replace("&#8217;","’",$badge["regione"]);
str_replace("&#8217;","’",$badge["gruppo"]);

putenv('GDFONTPATH=' . realpath('.')); 

$w = (int)$_POST['width'];
$h = (int)$_POST['height'];
$img = imagecreatetruecolor($w, $h);
imagefill($img, 0, 0, 0xFFFFFF);
$rows = 0;
$cols = 0;
for($rows = 0; $rows < $h; $rows++){
	$c_row = explode(",", $_POST['px' . $rows]);
	for($cols = 0; $cols < $w; $cols++){
		$value = $c_row[$cols];
		if($value != ""){
			$hex = $value;
			while(strlen($hex) < 6){
				$hex = "0" . $hex;
			}
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
			$test = imagecolorallocate($img, $r, $g, $b);
			imagesetpixel($img, $cols, $rows, $test);
		}
	}
}
if($badge["etichetta"]=="STAFF")
{
	$badgeIMG=imagecreatefromjpeg("materiale/badgeStaff.jpg");
}
else
{
	$badgeIMG=imagecreatefromjpeg("materiale/badgeVisitatore.jpg");
}
$badgeYellow=imagecolorallocate($badgeIMG,255,228,1);
$badgeBlack=imagecolorallocate($badgeIMG,0,0,0);
$badgeDarkYellow=imagecolorallocate($badgeIMG,186,171,48);
imagecopyresampled($badgeIMG,$img,34,28,0,0,280,354,480,640);
$font="arialbd.ttf";
if($badge["etichetta"]=="STAFF")
{
	imagettftext($badgeIMG,38,0,350,200,$badgeBlack,$font,$badge["nome"]);
	imagettftext($badgeIMG,38,0,350,250,$badgeBlack,$font,$badge["cognome"]);
}
else
{
	imagettftext($badgeIMG,38,0,330,70,$badgeBlack,$font,$badge["nome"]);
	imagettftext($badgeIMG,38,0,330,120,$badgeBlack,$font,$badge["cognome"]);
	imagettftext($badgeIMG,30,0,330,180,$badgeBlack,$font,$badge["regione"]);
	imagettftext($badgeIMG,30,0,330,220,$badgeBlack,$font,"presidio: ".$badge["presidio"]);
	
	$gruppoPoints=imagettfbbox(23,0, $font, "gruppo: ".$badge["gruppo"]);
	$gruppoWidth=$gruppoPoints[2]-$gruppoPoints[0];
	$gruppoX=(985-$gruppoWidth);
	imagettftext($badgeIMG,23,0,$gruppoX,300,$badgeBlack,$font, "gruppo: ".$badge["gruppo"]);
	imageline($badgeIMG,$gruppoX,305,($gruppoX+$gruppoWidth),305,$badgeBlack);
}

imagejpeg($badgeIMG,"badges/".$_GET['idUtente'].".jpg",100);

// header("Location:index.php");
?>