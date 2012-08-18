<div class="grid_16">
	<div class="box">
		<h2>ACC (Gruppen)</h2><br>
		<div style="text-align:center;">
			Hier hast du eine &Uuml;bersicht &uuml;ber die bestehenden ACC-Gruppen und deren Berechtigungen.<br><br>
			<center>
			{ERRORS}
			</center>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<h2>Neue Gruppe anlegen</h2><br>
		<div style="text-align:center;">
			Hier kannst du eine neue Gruppe anlegen.<br><br>
			<form action="index.php" method="post">
				<input type="hidden" name="site" value="acc">
				<input type="hidden" name="subsite" value="groups">
				<input type="hidden" name="ac" value="newgroup">
				<u>Name der neuen Gruppe *:</u><br>
				<input type="text" name="name" value="{GROUPNAME}" size="25"><br>
				<u>Beschreibung der neuen Gruppe *:</u><br> 
				<input type="text" name="description" value="{GROUPDESC}" size="60"><br>
				<input type="submit" name="submit" value="Anlegen"><br>
				* Feld darf nicht leer sein!<br>
			</form>
		</div><br>
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<h2>Gruppen-Liste</h2><br>
		<div style="text-align:center;">
			{SITENAVIGATION}<br><br>
			<table>
				<thead>
					<tr>
						<th style="width:10%;text-align:center;">ID</th>
						<th style="width:25%;">Name</th>
						<th style="width:25%;">Beschreibung</th>
						<th style="width:20%;">Berechtigung(en)</th>
						<th style="width:20%;text-align:center;">Aktionen</th>
					</tr>
				</thead>
				<tbody>
					{GROUPLIST}
				</tbody>
			</table>
		</div>
		<br><br>
	</div>
</div>
<div class="clear"></div>