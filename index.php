<?php 
require_once 'utils/db_connect.php';
connect();

// print_r($_POST);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />
<link rel="StyleSheet" HREF="css/main.css" TYPE="text/css">
<title>Arad gaji reformatus egyhazkozseg</title>
	<script type="text/javascript">
	function submitMenuForm(id) {
		document.getElementById('menuId').value = id;
		document.getElementById('productId').value = null;
		document.getElementById('formToSubmit').submit();
	}
	function submitProductForm(id) {
		document.getElementById('productId').value = id;
		document.getElementById('formToSubmit').submit();
	}
	function submitLanguageForm(id) {
		document.getElementById('languageId').value = id;
		document.getElementById('formToSubmit').submit();
	}
	</script>
	
</head>

<body>
<?php 
$menuId = 1;
if (isset($_POST['menuId'])) {
	$menuId = $_POST['menuId'];
}
$productId = 1;
if (isset($_POST['productId']) && strlen($_POST['productId']) > 0) {
	$productId = $_POST['productId'];
	$products = executeSelect("SELECT * FROM products WHERE id = $productId");
	if (isset($products['0'])) {
		$menuId = $products['0']['menu'];
	}
}
$languageId = 1;
if (isset($_POST['languageId'])) {
	$languageId = $_POST['languageId'];
}
?>
	<form action="" method="post" id="formToSubmit">
		<input type="hidden" name="productId" id="productId" value="<?php echo $productId; ?>"/>
		<input type="hidden" name="menuId" id="menuId" value="<?php echo $menuId; ?>"/>
		<input type="hidden" name="languageId" id="languageId" value="<?php echo $languageId; ?>"/>
	</form>
<div class="header">
	<?php 
	require_once 'language.php';
	?>
<div class="main">
	<div class="spacer">&nbsp;</div>
	<div class="content">
		<table style="height:100%">
			<tr>
				<td style="background-image: url('images/slice/rect5205.png'); background-repeat: repeat-y; background-position: right; vertical-align: top;width: 50px; height: 100%">
					<input type="image" src="images/slice/rect5207.png" /> 
					<input type="image" src="images/slice/rect5207_new.png" />
				</td>
				<td rowspan="2" style="width: 900px">
					<table style="height: 100%;">
						<tr>
							<td style="width: 100%; background-image: url('images/slice/rect5209.png'); background-repeat: repeat-x;"><input type="image" src="images/slice/rect5209.png" />
							</td>
						</tr>
						<tr style="height: 100%; border: 1px solid blue; vertical-align: top">
							<td>
								<?php require_once 'main.php'; ?>
							</td>
						</tr>
						<tr>
							<td style="background-image: url('images/slice/rect5219.png'); background-repeat: repeat-x; width: 100%"><input type="image" src="images/slice/rect5219.png" /></td>
						</tr>
					</table>
				</td>
				<td style="background-image: url('images/slice/rect5205_inv.png'); background-repeat: repeat-y; background-position: right; vertical-align: top;width: 50px;">
					<input type="image" src="images/slice/rect5207_inv.png" />
					<input type="image" src="images/slice/rect5207_new_inv.png" />
				</td>
			</tr>
			<tr>
				<td style="background-image: url('images/slice/rect5213.png'); background-repeat: repeat-y; background-position: right; vertical-align: bottom;">
					<input type="image" src="images/slice/rect5217.png" /> 
				</td>
				<td style="background-image: url('images/slice/rect5205_inv.png'); background-repeat: repeat-y; background-position: right; vertical-align: bottom;">
					<input type="image" src="images/slice/rect5217_inv.png" /> 
				</td>
			</tr>
		</table>
	</div>
	<div class="spacer">&nbsp;</div>
	<div class="spacer">&nbsp;</div>
</div>
</div>


</body>

</html>
<?php 
close_connection();
?>