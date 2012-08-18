<div class="grid_16">
	<div class="box">
		<h2>&Uuml;bersicht</h2><br>
		<div style="text-align:center;">
			<b>Hallo {ADMINNAME} und Willkommen im ACC!</b><br>
			Hier hast du eine kurze &Uuml;bersicht dar&uuml;ber, ob neue Profil- bzw. Galerie-Bilder auf eine Freischaltung warten und 
			ob es neue Nickchange-Anfragen gibt. Desweiteren siehst du hier eine kurze Info dar&uuml;ber, wieviele Profil- und Galerie-
			Bilder derzeit auf dem Server gespeichert sind. Auch hast du hier die M&ouml;glichkeit Profilbilder von inaktiven Accounts 
			zu l&ouml;schen.
		</div><br>
		<div class="grid_8">
			<b>Galeriebilder (Nickpage-Addon)</b><br>
			<script type="text/javascript">
				if ({NPACTIVE} == 1) {
					var gallocked = '';
					if ({GALLOCKED} > 0 ) {
						gallocked = '<b>{GALLOCKED}</b>';
					} else {
						gallocked = '{GALLOCKED}';
					}
					document.write(
							'<table cellpadding="0" cellspacing="0">'+
							'<tr><td style="width:80%;">Freigeschaltete Galerie-Bilder:</td>'+
							'<td style="width:20%;">{GALFREE}</td></tr>'+
							'<tr><td style="width:80%;">Soviele Galerie-Bilder warten auf Freigabe:</td>'+
							'<td style="width:20%;">'+gallocked+'</td></tr>'+
							'</table>'
							);
				} else {
					document.write('<font color="#FF0000">Nickpage-Addon wird nicht genutzt!</font>');
				}
			</script>
		</div>
		<div class="grid_8">
			<b>Profilbilder</b><br>
			<script type="text/javascript">
				if ({CHECKPICTURES} == 1) {
					var piclocked = '';
					if ({PICLOCKED} > 0) {
						piclocked = '<b>{PICLOCKED}</b>';
					} else {
						piclocked = {PICLOCKED};
					}
					document.write(
							'<table cellpadding="0" cellspacing="0">'+
							'<tr><td style="width:80%;">Freigeschaltete Profil-Bilder:</td>'+
							'<td style="width:20%;">{PICFREE}</td></tr>'+
							'<tr><td style="width:80%;">Soviele Profil-Bilder warten auf Freigabe:</td>'+
							'<td style="width:20%;">'+piclocked+'</td></tr>'+
							'</table>'
							);
				} else {
					document.write('<font color="#FF0000">Die Freischalt-Erweiterung f&uuml;r Profilbilder wird nicht genutzt!</font>');
				}
			</script>
		</div>
		<div class="clear"></div><br>
		<div class="grid_8">
			<b>Mitgliederdatenbank</b><br>
			<table>
				<tr>
					<td style="width:80%;">Aktive Accounts:</td>
					<td style="width:20%;">{MEMBERS_ACTIVE}</td>
				</tr>
				<tr>
					<td style="width:80%;">Inaktive Accounts:</td>
					<td style="width:20%;">{MEMBERS_INACTIVE}</td>
				</tr>
				<tr>
					<td style="width:80%;">Weibliche Mitglieder:</td>
					<td style="width:20%;">{MEMBERS_FEMALE}</td>
				</tr>
				<tr>
					<td style="width:80%;">M&auml;nnliche Mitglieder:</td>
					<td style="width:20%;">{MEMBERS_MALE}</td>
				</tr>
				<tr>
					<td style="width:80%;">Keine Geschlechtsangabe:</td>
					<td style="width:20%;">{MEMBERS_UNKNOWN}</td>
				</tr>
			</table>
		</div>
		<div class="grid_8">
			<!-- -->				
		</div>
		<div class="clear"></div>
		<br><br>
	</div>
</div>
<div class="clear"></div>