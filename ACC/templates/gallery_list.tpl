<tr>
	<td style="width:50%;text-align:center;vertical-align:middle;">
	<br>
	<a href="{IMAGE_URL}" class="lytebox" data-title="{TITLE}">
		<img src="{IMAGE_URL}" title="{TITLE}" alt="{TITLE}" style="max-width:100px;max-height:100px;">
	</a>
	<br><br>
	</td>
	<td style="width:25%;vertical-align:middle;">
		{USERNAME}
	</td>
	<td style="width:25%;vertical-align:middle;">
		<form action="index.php" method="post">
			<input type="hidden" name="site" value="gallery">
			<input type="hidden" name="id" value="{ID}">
			<input type="hidden" name="ac" value="declined">
			<input type="submit" name="submit" value="Bild ablehnen">
		</form>
		<br><br>
		<form action="index.php" method="post">
			<input type="hidden" name="site" value="gallery">
			<input type="hidden" name="id" value="{ID}">
			<input type="hidden" name="ac" value="accepted">
			<input type="submit" name="submit" value="Bild freischalten">
		</form>
	</td>
</tr>