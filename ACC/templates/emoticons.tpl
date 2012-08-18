<div class="grid_16">
	<div class="box">
		<h2>Emoticons-Verwaltung (&Uuml;bersicht)</h2><br>
		<div style="text-align:center;">
			<b>Suchoption:</b><br>
			<center>
			{ERRORS}
				<form action="index.php" method="post">
					<input type="hidden" name="site" value="emoticons">
					<input type="hidden" name="flag" value="1">
					<table style="width:500px;">
						<tr>
							<td>
								<b>Emoticon-Name enth&auml;lt:</b>
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
	</div>
</div>
<div class="clear"></div>
<div class="grid_16">
	<div class="box">
		<h2>Emoticon-Liste</h2><br>
		<div style="text-align:center;">
			{SITENAVIGATION}<br><br>
			<table>
				<thead>
					<tr>
						<th style="width:10%;text-align:center;">ID</th>
						<th style="width:25%;">Name (Aufruf)</th>
						<th style="width:30%;text-align:center;">Bild</th>
						<th style="width:15%;text-align:center;">In Hilfe</th>
						<th style="width:20%;text-align:center;">Aktionen</th>
					</tr>
				</thead>
				<tbody>
					{EMOLIST}
				</tbody>
			</table><br>
			{SITENAVIGATION}<br><br>
		</div>
		<br><br>
	</div>
</div>
<div class="clear"></div>