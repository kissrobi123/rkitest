<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />
<link rel="StyleSheet" HREF="css/main.css" TYPE="text/css">
<title>Maekra software</title>
</head>
<body>

<table style="width: 100%; height: 100%">
	<tr>
		<td	style="width: 200px; vertical-align: top; border-right: 1px solid blue;">
			<form method="POST" action="">
				<input type="hidden" name="action" value="language" /> 
				<input type="submit" value="Limbi" />
			</form>
			<form method="POST" action="">
				<input type="hidden" name="action" value="menu" />
				<input type="submit" value="Meniuri" />
			</form>
<!--
			<form method="POST" action="">
				<input type="hidden" name="action" value="folder" />
				<input type="submit" value="Fisiere" />
			</form>
-->
		</td>
		<td style="vertical-align: top;"><?php 
			require_once 'process.php';
		?></td>
	</tr>
</table>

</body>
</html>
