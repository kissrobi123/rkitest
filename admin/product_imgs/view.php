<form action="" method="post">
	<input type="hidden" name="menu" value="<?php echo $menu_id; ?>" />
	<input type="hidden" name="action" value="products" /> 
	<input type="submit" name="operation_submenu" value="Inapoi la produs" />
</form>
<h2> Imagine principala </h2>

<img src="<?php echo "../images/". $product_id . "_150_150.jpg"; ?>" alt="Fara imagine" height="150" width="150">

<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="product" value="<?php echo $product_id; ?>" />
	<input type="hidden" name="action" value="product_imgs" /> 
	<input type="file" name="file">
	<input type="submit" name="operation_setMain" value="Salveaza" />
</form>

<h2> Imagine principala </h2>
<?php
?>