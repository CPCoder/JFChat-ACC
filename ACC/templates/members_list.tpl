<tr>
	<td style="width:10%;text-align:center;background:{BGCOLOR};">{USER_ID}</td>
	<td style="width:25%;background:{BGCOLOR};">{USER_NAME}</td>
	<td style="width:10%;text-align:center;background:{BGCOLOR};">{USER_GENDER}</td>
	<td style="width:10%;text-align:center;background:{BGCOLOR};">{USER_RIGHTS}</td>
	<td style="width:10%;text-align:center;background:{BGCOLOR};">{USER_FRIGHTS}</td>
	<td style="width:10%;text-align:center;background:{BGCOLOR};">{USER_ACTIVE}</td>
	<td style="width:25%;text-align:center;background:{BGCOLOR};">
		<script type="text/javascript">
			if ({USER_ACTIVE} == 1) {
				document.write('<a href="index.php?site=members&amp;ac=deactivate&amp;id={USER_ID}&amp;page={PAGE}{EXT}">Account <font color="#FF0000">deaktivieren</font></a> | ');
			} else {
				document.write('<a href="index.php?site=members&amp;ac=activate&amp;id={USER_ID}&amp;page={PAGE}{EXT}">Account <font color="#228B22">aktivieren</font></a> | ');
			}
		</script>
		<a href="index.php?site=members&amp;subsite=edit&amp;id={USER_ID}&amp;page={PAGE}{EXT}">Bearbeiten</a>
	</td>
</tr>
