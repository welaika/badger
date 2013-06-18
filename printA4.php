<?php

ini_set("memory_limit","500M");

$query="SELECT id FROM badger WHERE stampa='1'";
$result=mysql_query($query);
$num=mysql_num_rows($result);
if($num!=10) die( "I record in coda stampa sono pi&ugrave; di 10, fatti furbo/a!");
define ("MAXMEM", 32*1024*1024);
$immagineA4=imagecreatetruecolor(2480,3508);
$font="arialbd.ttf";
$white=imagecolorallocate($immagineA4,255,255,255);
$black=imagecolorallocate($immagineA4,0,0,0);
imagefill($immagineA4,1,1,$white);

$id1=mysql_result($result, 0, "id");
$id2=mysql_result($result, 1, "id");
$id3=mysql_result($result, 2, "id");
$id4=mysql_result($result, 3, "id");
$id5=mysql_result($result, 4, "id");
$id6=mysql_result($result, 5, "id");
$id7=mysql_result($result, 6, "id");
$id8=mysql_result($result, 7, "id");
$id9=mysql_result($result, 8, "id");
$id10=mysql_result($result, 9, "id");

$immagine1=imagecreatefromjpeg("badges/$id1.jpg");
$immagine2=imagecreatefromjpeg("badges/$id2.jpg");
$immagine3=imagecreatefromjpeg("badges/$id3.jpg");
$immagine4=imagecreatefromjpeg("badges/$id4.jpg");
$immagine5=imagecreatefromjpeg("badges/$id5.jpg");
$immagine6=imagecreatefromjpeg("badges/$id6.jpg");
$immagine7=imagecreatefromjpeg("badges/$id7.jpg");
$immagine8=imagecreatefromjpeg("badges/$id8.jpg");
$immagine9=imagecreatefromjpeg("badges/$id9.jpg");
$immagine10=imagecreatefromjpeg("badges/$id10.jpg");

imagecopy($immagineA4,$immagine1,0,0,0,0,1009,658);
imagecopy($immagineA4,$immagine2,0,658,0,0,1009,658);
imagecopy($immagineA4,$immagine3,0,1316,0,0,1009,658);
imagecopy($immagineA4,$immagine4,0,1974,0,0,1009,658);
imagecopy($immagineA4,$immagine5,0,2632,0,0,1009,658);

imagecopy($immagineA4,$immagine6,1009,0,0,0,1009,658);
imagecopy($immagineA4,$immagine7,1009,658,0,0,1009,658);
imagecopy($immagineA4,$immagine8,1009,1316,0,0,1009,658);
imagecopy($immagineA4,$immagine9,1009,1974,0,0,1009,658);
imagecopy($immagineA4,$immagine10,1009,2632,0,0,1009,658);

$dataNOME=date("Y-m-d_H-i-s");
imagettftext($immagineA4,30,90,2100,500,$black,$font,$dataNOME);


$rand=date("Y-m-d_H-i-s");
while(is_file("badgeA4/A4$rand.jpg"))
{
	$rand=date("Y-m-d_H-i-s");
}
if(imagejpeg($immagineA4,"badgeA4/A4$rand.jpg", 100))
{
	for($i=0;$i<$num;$i++)
	{
		$query="UPDATE badger SET stampa='2' WHERE id='".mysql_result($result,$i,"id")."'";
		mysql_query($query);
	}
}

$imageA4URL="badgeA4/A4$rand.jpg";
?>