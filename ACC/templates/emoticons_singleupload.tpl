<div class="grid_16">
	<div class="box">
		<h2>Emoticons-Verwaltung (Emoticon(s) anlegen)</h2><br>
		Hier kannst du auf 3 verschiedene Arten ein, oder gleich mehrere neue Emoticons anlegen.<br><br>
		<b>Was willst du tun?</b><br>
		> <a href="index.php?site=emoticons&subsite=new">Zurück zur &Uuml;bersicht</a><br>
		> <a href="index.php?site=emoticons&subsite=newemo">Ein neues Emo festlegen, dass sich schon im Emoticon-Verzeichnis auf dem Server befindet.</a><br>
		> <a href="index.php?site=emoticons&subsite=multiupload">Mehrere neue Emoticons in einem ZIP-Archiv hochladen und speichern.</a><br><br>
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<h2>Neues Emoticon hochladen und speichern</h2><br>
		Hier kannst du ein neues Emoticon hochladen und speichern<br><br>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="site" value="emoticons">
			<input type="hidden" name="subsite" value="singleupload">
			<input type="hidden" name="ac" value="save">
			<table style="width:100%;">
				<tr>
					<td>
						<b>Datei auswählen:</b>
					</td>
					<td>
						<input type="file" name="file">
					</td>
				</tr>
				<tr>
					<td>
						<b>Emoticon-Aufruf:</b>
					</td>
					<td>
						<input type="text" name="name" id="name" size="25" value="{EMO_NAME}"> (Beispiel: meinemo)
					</td>
				</tr>
				<tr>
					<td>
						<b>Emoticon-URL:</b>
					</td>
					<td>
						<input type="text" name="url" id="url" size="25" value="{EMO_URL}"> (Beispiel: ../EMOS/meinemo.gif)
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
					<td>	</td>
					<td>
						<input type="submit" name="submit" value="Hochladen und speichern">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<div class="clear"></div>