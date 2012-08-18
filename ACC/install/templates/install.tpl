<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Admin-Control-Center v{ACCVERSION}</title>
        <meta http-equiv="content-type" content="text/html; charset={CHARSET}">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma" content="no-cache">
        <link rel="stylesheet" type="text/css" href="./style/reset.css" media="screen">
        <link rel="stylesheet" type="text/css" href="./style/text.css" media="screen">
        <link rel="stylesheet" type="text/css" href="./style/grid.css" media="screen">
        <link rel="stylesheet" type="text/css" href="./style/layout.css" media="screen">
		<script type="text/javascript" src="../lib/jquery-1.4.4.js"></script>
		<script type="text/javascript" src="../lib/jquery-ui-1.8.6.custom.min.js"></script>
    </head>
    <body>
        <div class="container_16">
            <div class="grid_16">
                <h1 id="branding">Admin-Control-Center v{ACCVERSION}</h1>
            </div>
            <div class="clear"></div>
            <br>
            <div id="sitecontent" style="display:none;">
				{SITECONTENT}
			</div>
			<div id="noscript" style="display:block;">
				<div class="grid_16">
					<div class="box">
						<h2>Systemmeldung</h2>
						<center><br>
				    		<b>HINWEIS</b><br>
				    		Leider ist Javascript in deinem Browser nicht aktiviert!<br>
				    		Bitte aktiviere erst Javascript in deinem Browser!
				    		<br><br>
						</center>
					</div>
				</div>
    		</div>
    		<div class="clear"></div>
		</div>
		<div style="text-align:center;">This site is optimized for a resolution of 1024x768 pixel or greater!</div>
		{DEBUG_BOX}
		<script type="text/javascript">
			$(document).ready(function(){
	    		document.getElementById('sitecontent').style.display='block';
	    		document.getElementById('noscript').style.display='none';
				{JSCRIPT}
			});
		</script>
	</body>
</html>		