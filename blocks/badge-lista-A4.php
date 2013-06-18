<table cellpadding="5" cellspacing="0">
  <tr><td>File</td><td>Ultima modifica</td><td>Dimensioni</td><?php
$dir="badgeA4/";
if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            echo '<tr><td><a href="'.$dir."/".$file.'">'.$file.'</a></td><td>'.date("m/j/y h:i:s",filemtime($dir."/".$file)).'</td><td>'.round((filesize($dir."/".$file))/1024,0).'KB</td></tr>'."\n";
        }
    }
    closedir($handle);
}
?></tr></table>