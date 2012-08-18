<div class="grid_16">
	<div class="box">
		<h2>Emoticons-Verwaltung (Emoticon(s) anlegen)</h2><br>
		Hier kannst du auf 3 verschiedene Arten ein, oder gleich mehrere neue Emoticons anlegen.<br><br>
		<b>Was willst du tun?</b><br>
		> <a href="index.php?site=emoticons&subsite=new">Zurück zur &Uuml;bersicht</a><br>
		> <a href="index.php?site=emoticons&subsite=newemo">Ein neues Emo festlegen, dass sich schon im Emoticon-Verzeichnis auf dem Server befindet.</a><br>
		> <a href="index.php?site=emoticons&subsite=singleupload">Ein neues Emoticon hochladen und speichern.</a><br><br>
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<h2>Emoticons in einem ZIP-Archiv hochladen</h2><br>
		Hier kannst du mehrere Emoticons in einem ZIP-Archiv heraufladen. Das Archiv wird auf dem Server in das Emoticon-Verzeichnis entpackt.<br>
		Beim entpacken werden die Dateien umbenannt indem das sog. "Gruppen-Prefix" vorne angehängt wird. Aus der Datei "hase.gif" wird dann 
		z.B. "ostern_hase.gif". Ebenfalls wird das Emoticon mit dem gleichen Bezeichner als Aufruf-Name in der Datenbank gespeichert, 
		natürlich ohne Dateinamen-Erweiterung (in diesem Beispiel ".gif").<br><br>
		{ERRORS}
		<form action="index.php" method="post" enctype="multipart/form-data" id="uploadform" onsubmit="beginUpload();">
			<input type="hidden" name="site" value="emoticons">
			<input type="hidden" name="subsite" value="multiupload">
			<input type="hidden" name="ac" value="save">
			<input type="hidden" name="csr" value="{CSR}">
			<table style="width:100%;">
				<tr>
					<td>
						<b>Datei auswählen:</b>
					</td>
					<td>
						<input type="file" name="{FILEID}" id="{FILEID}"> <font color="#ff0000">(Nur *.zip Dateien zul&auml;ssig!)</font>
					</td>
				</tr>
				<tr>
					<td>
						<b>Gruppen-Prefix:</b>
					</td>
					<td>
						<input type="text" name="emopref" id="emopref" size="25" value="{EMO_PREF}"> (Beispiele: ostern_, xmas_)
					</td>
				</tr>
				<tr>
					<td>
						<b>In Hilfe:</b>
					</td>
					<td>
						<input type="radio" name="isvisible" value="1" checked> JA &nbsp; &nbsp;
						<input type="radio" name="isvisible" value="0"> Nein
					</td>
				</tr>
				<tr>
					<td>
						<span class="progressbar" id="uploadprogressbar">0%</span>
					</td>
					<td>
						<input type="submit" value="Hochladen und speichern">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<div class="clear"></div>
<iframe style="display: none;" name="progressFrame"></iframe>