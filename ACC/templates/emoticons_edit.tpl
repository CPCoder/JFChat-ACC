<div class="grid_16">
	<div class="box">
		<h2>Emoticons-Verwaltung (Emoticon bearbeiten)</h2><br>
		<div style="text-align:center;">
			<center>
			{ERRORS}
			<div id="errors"></div>
				<form action="index.php" method="post">
					<input type="hidden" name="site" value="emoticons">
					<input type="hidden" name="subsite" value="edit">
					<input type="hidden" name="ac" value="save">
					<input type="hidden" name="id" id="id" value="{EMO_ID}">
					<table style="width:100%;">
						<tr>
							<td>
								<b>Emoticon-Aufruf:</b>
							</td>
							<td>
								<b>{EMO_PREFIX}</b><input type="text" name="name" id="name" size="25" value="{EMO_NAME}">
							</td>
							<td rowspan="4" id="preview_emo">
								<b>Vorschau:</b><br>
								<img id="previewemo" src="{PREVIEW_URL}"><br>
								<div id="output"></div>
							</td>
						</tr>
						<tr>
							<td>
								<b>Emoticon-URL:</b>
							</td>
							<td>
								<input type="text" name="url" id="url" size="25" value="{EMO_URL}">
							</td>
						</tr>
						<tr>
							<td>
								<b>In Hilfe:</b>
							</td>
							<td>
								<input type="radio" name="isvisible" value="1"{CHECKED_1}> JA &nbsp; &nbsp;
								<input type="radio" name="isvisible" value="0"{CHECKED_2}> Nein
							</td>
						</tr>
						<tr>
							<td>	</td>
							<td>
								<input type="submit" name="submit" value="Speichern">
								<input type="button" name="back" onclick="javascript:history.back(1);" value="Zurück zur Emoticon-Liste">
							</td>
						</tr>
					</table>
				</form>
			</center>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<h2>Emoticon-Liste</h2><br>
		<div style="text-align:center;">
		</div>
		<br><br>
	</div>
</div>
<div class="clear"></div>