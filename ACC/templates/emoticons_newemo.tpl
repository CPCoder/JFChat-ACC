<div class="grid_16">
	<div class="box">
		<h2>Emoticons-Verwaltung (Emoticon(s) anlegen)</h2><br>
		Hier kannst du auf 3 verschiedene Arten ein, oder gleich mehrere neue Emoticons anlegen.<br><br>
		<b>Was willst du tun?</b><br>
		> <a href="index.php?site=emoticons&subsite=new">Zurück zur &Uuml;bersicht</a><br>
		> <a href="index.php?site=emoticons&subsite=singleupload">Ein neues Emoticon hochladen und speichern.</a><br>
		> <a href="index.php?site=emoticons&subsite=multiupload">Mehrere neue Emoticons in einem ZIP-Archiv hochladen und speichern.</a><br><br>
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<h2>Neues Emoticon festlegen</h2><br>
			Hier kannst du die Daten für ein Emoticon festlegen, welches schon im entsprechenden Emoticon-Verzeichnis auf dem Server befindet.<br>
			Du musst hier somit nur noch einen Namen vergeben und den Pfad zu dem Emoticon angeben.
		<div style="text-align:center;">
			<center>
			{ERRORS}
			<div id="errors"></div>
				<form action="index.php" id="shs_emoticons" method="post">
					<input type="hidden" name="site" value="emoticons">
					<input type="hidden" name="subsite" value="edit">
					<input type="hidden" name="ac" value="save">
					<input type="hidden" name="id" id="id" value="-1">
					<table style="width:100%;">
						<tr>
							<td style="text-align:right;">
								<b>Name:</b>
							</td>
							<td>
								<input type="text" name="name" id="name" size="25" value="{EMO_NAME}">
							</td>
							<td rowspan="4" id="preview_emo">
								<b>Vorschau:</b><br>
								<img id="previewemo" src="{PREVIEW_URL}"><br>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">
								<b>HTTP-Pfad zur Grafik:</b>
							</td>
							<td>
								<input type="text" name="url" id="url" size="25" value="{EMO_URL}">
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">
								<b>In Hilfe:</b>
							</td>
							<td>
								<input type="radio" name="isvisible" value="1"{CHECKED_1}> JA &nbsp; &nbsp;
								<input type="radio" name="isvisible" value="0"{CHECKED_2}> Nein
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" name="submit" value="Speichern">
								<input type="button" name="back" onclick="javascript:history.back(1);" value="Zurück zur Emoticon-Liste">
							</td>
						</tr>
					</table>
				</div>
			</form>
		</center>
	</div>
</div>
<div class="clear"></div>