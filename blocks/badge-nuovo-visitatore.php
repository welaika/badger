<h2>Nuovo badge</h2>
<form id="nuovo-badge" name="nuovo-badge" method="post" action="index.php?action=salvadati">
  <table border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td>Nome</td>
      <td><input type="text" name="nome" id="nome" /></td>
    </tr>
    <tr>
      <td>Cognome</td>
      <td><input type="text" name="cognome" id="cognome" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type="text" name="email" id="email" /></td>
    </tr>
    <tr>
      <td>Presidio</td>
      <td><input type="text" name="presidio" id="presidio" /></td>
    </tr>
    <tr>
      <td>Gruppo</td>
      <td><select name="gruppo" id="gruppo">
        <option value=" "> </option>
        <option value="group 1">group 1</option>
        <option value="group 2">group 2</option>
      </select></td>
    </tr>
    <tr>
      <td>Etichetta</td>
      <td><select name="etichetta" id="etichetta">
        <option value="staff">Staff</option>
        <option value=" " selected="selected">Visitatore</option>
      </select></td>
    </tr>
    <tr>
      <td>Regione</td>
      <td><select name="regione" id="regione">
        <option value="Valle d&#8217;Aosta">Valle d'Aosta</option>
        <option value="Piemonte">Piemonte</option>
        <option value="Liguria">Liguria</option>
        <option value="Lombardia">Lombardia</option>
        <option value="Trentino-Alto Adige">Trentino-Alto Adige</option>
        <option value="Veneto">Veneto</option>
        <option value="Friuli-Venezia Giulia">Friuli-Venezia Giulia</option>
        <option value="Emilia-Romagna">Emilia-Romagna</option>
        <option value="Toscana">Toscana</option>
        <option value="Umbria">Umbria</option>
        <option value="Marche">Marche</option>
        <option value="Lazio">Lazio</option>
        <option value="Abruzzo">Abruzzo</option>
        <option value="Molise">Molise</option>
        <option value="Campania">Campania</option>
        <option value="Basilicata">Basilicata</option>
        <option value="Puglia">Puglia</option>
        <option value="Calabria">Calabria</option>
        <option value="Sicilia">Sicilia</option>
        <option value="Sardegna">Sardegna</option>
            </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right"><input type="submit" name="button" id="button" value="Salva" style="background-color:#333;color:white;"/></td>
    </tr>
  </table>
</form>
