<div class="grid_16">
	<div class="box">
		<h2>Mitglieder-Verwaltung (&Uuml;bersicht)</h2><br>
		<div style="text-align:center;">
			<b>Suchoption:</b><br>
			<center>
			{ERRORS}
				<form action="index.php" method="post">
					<input type="hidden" name="site" value="members">
					<input type="hidden" name="flag" value="1">
					<table style="width:500px;">
						<tr>
							<td>
								<b>Username enth&auml;lt:</b>
							</td>
							<td>
								<input type="text" name="search" size="25">&nbsp;
								<input type="submit" name="submit" value="Suchen">
							</td>
						</tr>
					</table>
				</form>
			</center>
		</div>
		<div style="text-align:center;">
			<b>Sortierung:</b><br>
			<center>
				<table style="width:500px;">
					<tr>
						<td>
							<a href="index.php?site=members&amp;sort=female">Nur weibl. Mitglieder auflisten</a><br>
							<a href="index.php?site=members&amp;sort=male">Nur m&auml;nnl. Mitglieder auflisten</a><br>
							<a href="index.php?site=members&amp;sort=unknown">Geschlecht unbekannt auflisten</a><br>
						</td>
						<td>
							<a href="index.php?site=members&amp;sort=status">Nur Statustr&auml;ger (Rechte >= 5) auflisten</a><br>
							<a href="index.php?site=members&amp;sort=rdown">Nach Rechten abw&auml;rts soriert</a><br>
							<a href="index.php?site=members&amp;sort=rup">Nach Rechten auf&auml;rts soriert</a><br>
						</td>
					</tr>
				</table>
			</center>
			<br>
			<a href="index.php?site=members&amp;sort=all">Alle Mitglieder auflisten</a><br><br>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<h2>Mitglieder-Liste</h2><br>
		<div style="text-align:center;">
			{SITENAVIGATION}<br><br>
			<table>
				<thead>
					<tr>
						<th style="width:10%;text-align:center;">ID</th>
						<th style="width:25%;">Username</th>
						<th style="width:10%;text-align:center;">Geschlecht</th>
						<th style="width:10%;text-align:center;">Rechte</th>
						<th style="width:10%;text-align:center;">Forenrechte</th>
						<th style="width:10%;text-align:center;">Aktiv</th>
						<th style="width:25%;text-align:center;">Aktionen</th>
					</tr>
				</thead>
				<tbody>
					{MEMBERLIST}
				</tbody>
			</table>
		</div>
		<br><br>
	</div>
</div>
<div class="clear"></div>