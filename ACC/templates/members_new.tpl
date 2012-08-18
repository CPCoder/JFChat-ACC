<div class="grid_16">
	<div class="box">
		<h2>Mitglieder-Verwaltung (Mitglied anlegen)</h2><br>
		<div style="text-align:center;">
			Hier kannst du ein neues Mitglied anlegen:<br><br>
			<div id="namecheck" style="color:#FF0000;"></div>
			{ERRORS}
		</div>
		<form action="index.php" method="post">
			<input type="hidden" name="site" value="members">
			<input type="hidden" name="subsite" value="new">
			<input type="hidden" name="save" value="1">
			<input type="hidden" name="csr" value="{CSR}">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2" style="text-align:center;font-weight:bold;font-size:14px;"">Account-Daten</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Username:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="username" id="username" size="50" maxlength="25" value="{USERNAME}">&nbsp;
						<img id="checknameimg" src="style/gfx/transparent.png" border="0" title="Transparent" alt="Transparent">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Passwort:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="password" id="pwd" name="password" size="50" value="{PASSWORD}">&nbsp; 
						<img id="generatePWD" src="style/gfx/arrow_refresh.png" border="0" title="Passwort generieren" alt="Passwort generieren">&nbsp; 
						<img id="switcher" src="style/gfx/eye_hide.png" border="0" title="Passwort anzeigen" alt="Passwort anzeigen">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						eMail-Adresse:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="emailadresse" size="50" value="{EMAILADRESSE}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Rechte:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="rechte" size="2" value="{RECHTE}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Forenrechte:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="forenrechte" size="2" value="{FORENRECHTE}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Max. PMs:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="maxPMs" size="2" value="{MAXPMS}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Max. Freunde:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="maxfriends" size="2" value="{MAXFRIENDS}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Objekte:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<textarea name="objekte" cols="57" rows="5">{OBJEKTE}</textarea><br>
						(Mehrere Objekte durch Leerzeichen getrennt angeben. Hinter dem letzten Objekt muss auch ein Leerzeichen sein!)
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Ownroom:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="ownroom" size="50" value="{OWNROOM}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Punkte:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="punkte" size="5" value="{PUNKTE}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Farbcode:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="farbcode" size="5" value="{FARBCODE}" style="float:left;">
						<div id="colpicker" style="float:left;margin-left:10px;"></div><br>
						<div style="clear:both;"></div>
						 (farbe als HEX-Code angeben!)
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Avatar:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="avatar" size="50" value="{AVATAR}">
					</td>
				</tr>
				<tr id="nplock" style="display:none;">
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">Nickpage sperren:</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="nplock" size="2" value="{NPLOCK}"><br>(0=nein, 1=ja)
					</td>
				</tr>
				<tr id="onlyfriends" style="display:none;">
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">Nickpage nur f&uuml;r Freunde:</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="nponlyfriends" size="2" value="{NPONLYFRIENDS}"><br>(0=nein, 1=ja)
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;font-weight:bold;font-size:14px;">Profil Daten</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Wohnort:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="wohnort" size="50" value="{WOHNORT}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Postleitzahl:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="plz" size="5" value="{PLZ}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Geburtsdatum:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="geburtsdatum" size="10" value="{GEBURTSDATUM}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Geschlecht:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="geschlecht" size="1" value="{GESCHLECHT}"><br>
						(0=m&auml;nnlich, 1=weiblich, 2=unbekannt/paar)
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Homepage-Name:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="homepageName" size="50" value="{HOMEPAGENAME}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Homepage-URL:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="homepageUrl" size="50" value="{HOMEPAGEURL}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Motto:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<textarea name="motto" cols="57" rows="5">{MOTTO}</textarea>
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Hobbies:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="hobbies" size="50" value="{HOBBIES}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						ICQ:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="icq" size="10" value="{ICQ}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Gut Drauf:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="gutDrauf" size="50" value="{GUTDRAUF}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Macht Wut:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="machtWut" size="50" value="{MACHTWUT}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Lieblings-Link:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="favLink" size="50" value="{FAVLINK}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Lieblings-Musik:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="favMusik" size="50" value="{FAVMUSIK}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						3 Dinge f&uuml;r die Insel:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="wasInsel" size="50" value="{WASINSEL}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Signatur:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<textarea name="signatur" id="signatur" cols="57" rows="5">{SIGNATUR}</textarea>
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Beschreibung:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<textarea name="beschreibung" cols="57" rows="5">{BESCHREIBUNG}</textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;font-weight:bold;font-size:14px;">Zus&auml;tzliche Felder</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Optional 1:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="optional1" size="50" value="{OPTIONAL1}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Optional 2:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="optional2" size="50" value="{OPTIONAL2}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Optional 3:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="optional3" size="50" value="{OPTIONAL3}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Optional 4:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="optional4" size="50" value="{OPTIONAL4}">
					</td>
				</tr>
				<tr>
					<td width="40%" style="vertical-align:top; border:0px solid #000000;">
						Optional 5:
					</td>
					<td width="60%" style="vertical-align:top; border:0px solid #000000;">
						<input type="text" name="optional5" size="50" value="{OPTIONAL5}">
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center; border:0px solid #000000;">
						<br><input type="submit" name="submit" value="Userdaten speichern"><br><br>
					</td>
				</tr>
			</table>
		</form>
		<br><br>
	</div>
</div>
<script type="text/javascript">
	if ({NPACTIVE} == 1) {
		$('#nplock').show();
		$('#onlyfriends').show();
	}
</script>	
<div class="clear"></div>