<h2>Lista badges</h2>
<table border="0" cellpadding="5" cellspacing="0" bgcolor="#ffeb11" id="elenco-badges" style="margin-left:10px; width:100%">
<tr><th width="50" align="left">ID</th>
<th width="200" align="left">Nome</th>
<th width="200" align="left">Cognome</th>
<th width="150" align="left">Etichetta</th>
  <th width="100" align="left">Stato</th>
  <th align="left">Azioni</th>
</tr>
<?php
	$color1="#FFFFFF";
	$color2="#EEEEEE";
	$color=$color1;
	if($_POST['accuracyID']!="")
	{
		$accuracy=" WHERE id='".$_POST['accuracyID']."' ";
	}elseif($_POST['accuracyCOGNOME']!="")
	{
		$accuracy=" WHERE cognome='".$_POST['accuracyCOGNOME']."' ";
	}
	elseif($_GET['select']=="printList")
	{
		$accuracy=" WHERE stampa='1' ";
		$plus="/10";
	}
	elseif($_GET['select']=="toPrint")
	{
		$accuracy=" WHERE stampa='0' ";
	}

	else
	{
		$accuracy="";
	}
	$query="SELECT * FROM $badgetable $accuracy ORDER BY id DESC";
	$result=mysql_query($query);
	$num=mysql_num_rows($result);
	echo '<div style="padding:8px;display:block">Contatore: '.$num.$plus.'</div>';
	if($_GET['select']=="printList")
	{
		if($num==10)
		{
			echo "<a id=\"fallo-ora\" href=\"index.php?action=printA4\">Possiamo stampare! Fallo ora </a>";
		}

	}
		
	if($imageA4URL!="")
	{
		echo "<a id=\"fallo-ora\" href=\"$imageA4URL\" target=\"_blank\">Link</a>";
		}	for($i=0;$i<$num;$i++)
	{
		if($color==$color1) $color=$color2;
		else $color=$color1;
		$id=mysql_result($result,$i,"id");
		$nome=mysql_result($result,$i,"nome");
		$cognome=mysql_result($result,$i,"cognome");
		$etichetta=mysql_result($result,$i,"etichetta");
		$stampa=mysql_result($result,$i,"stampa");
		if(is_file("badges/$id.jpg"))
			$thumb_img="immagini/export-thumb-refresh.png";
		else
			$thumb_img="immagini/export-thumb.png";
		echo "<tr style=\"background-color:$color\"><td><strong>$id</strong></td><td>$nome</td><td>$cognome</td><td>$etichetta</td><td align=\"center\">";
		if(is_file("badges/$id.jpg"))
		{
			echo "<img src=\"immagini/export-thumb-print-$stampa.png\" alt=\"stato $stampa\">";
		}
		else
		{
			echo "<img src=\"immagini/export-thumb-print-1b.png\" alt=\"stato $stampa\">";
		}	
		echo "</td><td align=\"left\">".
		"<a href=\"index.php?action=createbadge&id=$id\"> <img src=\"$thumb_img\" alt=\"crea il badge!\"></a>".
		"<a href=\"index.php?action=deletebadge&id=$id\"> <img src=\"immagini/export-thumb-delete.png\" alt=\"elimina dal database\"></a>";
		if(is_file("badges/$id.jpg"))
		{
			echo "<a href=\"#\" onClick=\"badgePreview($id)\">   <img src=\"immagini/export-thumb-view.png\" alt=\"preview badge\"></a>";
			
			if(($stampa==0)||($stampa==2)) echo "<a href=\"index.php?action=addToPrintList&id=$id&select=".$_GET['select']."\">   <img src=\"immagini/export-thumb-print-add.png\" alt=\"aggiungi a coda di stampa\"></a>";
			
			if($stampa==1) echo "<a href=\"index.php?action=removeFromPrintList&id=$id&select=".$_GET['select']."\">   <img src=\"immagini/export-thumb-print-remove.png\" alt=\"rimuovi da coda di stampa\"></a>";
		}
		echo "</td></tr>";
	}
?>
</table>
<table border="0" cellpadding="4" cellspacing="0" id="legenda">
  <tr>
    <td valign="middle"><img src="immagini/export-thumb.png" alt="Scatta foto" width="30" height="30" /><span class="legenda"> Crea badge</span></td>
    <td valign="middle"><img src="immagini/export-thumb-refresh.png" alt="Aggiorna foto" width="30" height="30" /> <span class="legenda">Ri-scatta foto e crea badge</span></td>
    <td valign="middle"><img src="immagini/export-thumb-edit.png" alt="Modifica" width="30" height="30" /> <span class="legenda"> Modifica dati badge</span></td>
    <td valign="middle"><img src="immagini/export-thumb-delete.png" alt="Elimina" width="30" height="30" /><span class="legenda"> Elimina record</span></td>
    <td valign="middle"><img src="immagini/export-thumb-view.png" alt="Elimina" width="30" height="30" /> <span class="legenda">Visualizza badge</span></td>
    <td valign="middle"><img src="immagini/1302102812_agt_print.png" alt="stampa" width="32" height="32" /> <span class="legenda">Aggiungi a coda stampa</span></td>
  </tr>
</table>
