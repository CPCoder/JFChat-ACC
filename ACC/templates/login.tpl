<div class="grid_16">
	<div class="box">
		<h2>Login</h2><br>
		<div style="text-align:center;">
			<center>
				{ERRORS}
				<form action="index.php" method="post">
					<input type="hidden" name="site" value="login">
					<input type="hidden" name="csr" value="{CSR}">
					<table style="width:360px;">
						<tr>
							<td style="width:25%;border:0px #FFFFFF;background:#e9e9e9;font-weight:bold;">
								Benutzername:
							</td>
							<td style="width:75%;border:0px #FFFFFF;background:#e9e9e9;">
								<input type="text" name="name" size="25">
							</td>
						</tr>
						<tr>
							<td style="width:25%;border:0px #FFFFFF;background:#e9e9e9;font-weight:bold;">
								Passwort:
							</td>
							<td style="width:75%;border:0px #FFFFFF;background:#e9e9e9;">
								<input type="password" name="password" size="25">
							</td>
						</tr>
						<tr>
							<td style="width:25%;border:0px #FFFFFF;background:#e9e9e9;font-weight:bold;"></td>
							<td style="width:75%;border:0px #FFFFFF;background:#e9e9e9;">
								<input type="submit" name="submit" value="Login">
							</td>
						</tr>
					</table>
				</form>
			</center>
		</div>
		<br><br>
	</div>
</div>
<div class="clear"></div>