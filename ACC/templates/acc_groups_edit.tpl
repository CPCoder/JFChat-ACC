<div class="grid_16">
	<div class="box">
		<h2>ACC (Gruppen)</h2><br>
		<div style="text-align:center;">
			Hier kannst du die Gruppe "{GROUPNAME}" bearbeiten.<br><br>
			<center>
			{ERRORS}
			</center>
			<a href="index.php?site=acc&amp;subsite=groups">Zur&uuml;ck zur Gruppen-&Uuml;bersicht</a><br><br> 
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<div style="text-align:center;">
			<h2>Konfiguration der Gruppe</h2><br>
			<form name="editgroup" action="index.php" method="post">
				<input type="hidden" name="site" value="acc">
				<input type="hidden" name="subsite" value="editgroup">
				<input type="hidden" name="ac" value="changename">
				<input type="hidden" name="id" value="{ID}">
				<u>Name der Gruppe *:</u><br>
				<input type="text" name="name" value="{GROUPNAME}" size="25"><br>
				<u>Beschreibung der Gruppe *:</u><br> 
				<input type="text" name="description" value="{GROUPDESC}" size="60"><br>
				<input type="submit" name="submit" value="Ändern"><br>
				<b>* Feld darf nicht leer sein!</b><br>
			</form>
			<br>
			<table>
				<thead>
					<tr>
						<th style="width:50%;text-align:center;">Gruppenmember:</th>
						<th style="width:50%;text-align:center;">Bereiche:</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width:50%">{GROUPMEMBERS}</td>
						<td style="width:50%" rowspan="2">
							<table>
								<tr>
									<td width="50%" style="vertical-align:top;">
										{SECTORS}
									</td>
									<td width="50%">
										<form name="editgroup" action="index.php" method="post">
											<input type="hidden" name="site" value="acc">
											<input type="hidden" name="subsite" value="editgroup">
											<input type="hidden" name="ac" value="addsection">
											<input type="hidden" name="id" value="{ID}">
											<select name="sectors" size="10">
												{SECTIONS}
											</select>
											<input type="submit" name="submit" value="Bereich hinzufügen"><br>
										</form>
									</td>
							</table>
						</td>
					</tr>
					<tr>
						<td style="width:50%">
							<form name="editgroup" action="index.php" method="post">
								<input type="hidden" name="site" value="acc">
								<input type="hidden" name="subsite" value="editgroup">
								<input type="hidden" name="ac" value="addmember">
								<input type="hidden" name="id" value="{ID}">
								Name des Administrators: <input type="text" name="name"> 
								<input type="submit" name="submit" value="Hinzufügen"><br>
							</form>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<br><br>
	</div>
</div>
<div class="clear"></div>