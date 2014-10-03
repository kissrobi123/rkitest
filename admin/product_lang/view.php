<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
	<tr>
		<td colspan="3">
			<form action="" method="post">
				<input type="hidden" name="menu" value="<?php echo $menu_id; ?>" />
				<input type="hidden" name="action" value="products" /> 
				<input type="submit" name="operation_submenu" value="Inapoi la produs" />
			</form>
		</td>
	</tr>
	<tr style="background-color: yellow">
		<td style="width: 100px;">Nume
		</td>
		<td>
		</td>
	</tr>
<?php
foreach ($productLangs_list as $productLang) {
?>	
	<tr>
		<td><?php echo $productLang['name']?></td>
		<td>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="id" value="<?php echo $productLang['id']; ?>" /> 
				<input type="hidden" name="product" value="<?php echo $product_id; ?>" />
				<input type="hidden" name="action" value="product_lang" /> 
				<input type="submit" name="operation_edit" value="Editeaza" />
				<input type="submit" name="operation_delete" value="Sterge" />
			</form>
		</td>
	</tr>
<?php
}
?>
</table>
<form action="" method="post">
	<input type="hidden" name="action" value="product_lang" /> 
	<input type="hidden" name="product" value="<?php echo $product_id; ?>" />
	<input type="submit" name="operation_add" value="Adauga" />
</form>

<br/>
<br/>
<?php 
if (isset($productLang_edit)) {
	foreach ($productLang_edit as $productLang) {
?>
<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $productLang['id']; ?>" /> 
<input type="hidden" name="action" value="product_lang" /> 
<input type="hidden" name="product" value="<?php echo $productLang['product']; ?>" /> 
<table>
	<tr>
		<td>Limba</td>
		<td>
			<select name="language">
			<?php 
			foreach ($languages_list as $language) {
				if ($language['id'] == $productLang['language']) {
				?>	
				<option selected="selected" value="<?php echo $language['id']; ?>"><?php echo $language['language'] ?></option>
				<?php 
				} else {
				?>	
				<option value="<?php echo $language['id']; ?>"><?php echo $language['language'] ?></option>
				<?php 
				}
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Nume produs</td>
		<td><input type="text" name="name" value="<?php echo $productLang['name']; ?>"></td>
	</tr>
	<tr>
		<td>Descriere</td>
		<td><input type="text" size="50" name="shortDescr" value="<?php echo $productLang['shortDescr']; ?>"></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="operation_save" value="Salveaza">
			<input type="reset" value="Anuleaza">
		</td>
	</tr>
</table>
</form>
<?php 	
	}
}
?>