<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
	<tr>
		<td colspan="3">
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $parent_id; ?>" />
				<input type="hidden" name="action" value="menu" /> 
				<input type="submit" name="operation_submenu" value="Inapoi la meniu" />
			</form>
		</td>
	</tr>
	<tr style="background-color: yellow">
		<td style="width: 200px;">Limba
		</td>
		<td style="width: 100px;">Nume
		</td>
		<td>
		</td>
	</tr>
<?php
foreach ($products_list as $product) {
?>	
	<tr>
		<td><?php echo $product['language']?></td>
		<td><?php echo $product['name']?></td>
		<td>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="id" value="<?php echo $product['id']; ?>" /> 
				<input type="hidden" name="action" value="products" /> 
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
	<input type="hidden" name="action" value="products" /> 
	<input type="hidden" name="menu" value="<?php echo $menu_id; ?>" />
	<input type="submit" name="operation_add" value="Adauga" />
</form>

<br/>
<br/>
<?php 
if (isset($product_edit)) {
	foreach ($product_edit as $product) {
?>
<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $product['id']; ?>" /> 
<input type="hidden" name="action" value="products" /> 
<input type="hidden" name="menu" value="<?php echo $product['menu']; ?>" /> 
<table>
	<tr>
		<td>Limba</td>
		<td>
			<select name="language">
			<?php 
			foreach ($languages_list as $language) {
				if ($language['id'] == $product['language']) {
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
		<td><input type="text" name="name" value="<?php echo $product['name']; ?>"></td>
	</tr>
	<tr>
		<td>Lungime</td>
		<td><input type="text" size="50" name="length" value="<?php echo $product['length']; ?>"></td>
	</tr>
	<tr>
		<td>Latime</td>
		<td><input type="text" size="50" name="width" value="<?php echo $product['width']; ?>"></td>
	</tr>
	<tr>
		<td>Inaltime</td>
		<td><input type="text" size="50" name="height" value="<?php echo $product['height']; ?>"></td>
	</tr>
	<tr>
		<td>Descriere</td>
		<td><input type="text" size="50" name="shortDescr" value="<?php echo $product['shortDescr']; ?>"></td>
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