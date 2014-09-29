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
		<td style="width: 100px;">Valoare
		</td>
		<td>
		</td>
	</tr>
<?php
foreach ($menu_values_list as $menu_value) {
?>	
	<tr>
		<td><?php echo $menu_value['language']?></td>
		<td><?php echo $menu_value['value']?></td>
		<td>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="id" value="<?php echo $menu_value['id']; ?>" /> 
				<input type="hidden" name="action" value="menu_values" /> 
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
	<input type="hidden" name="action" value="menu_values" /> 
	<input type="hidden" name="menu" value="<?php echo $menu_id; ?>" />
	<input type="submit" name="operation_add" value="Adauga" />
</form>

<br/>
<br/>
<?php 
if (isset($menu_value_edit)) {
	foreach ($menu_value_edit as $menu_value) {
?>
<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $menu_value['id']; ?>" /> 
<input type="hidden" name="action" value="menu_values" /> 
<input type="hidden" name="menu" value="<?php echo $menu_value['menu']; ?>" /> 
<table>
	<tr>
		<td>Limba</td>
		<td>
			<select name="language">
			<?php 
			foreach ($languages_list as $language) {
				if ($language['id'] == $menu_value['language']) {
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
		<td>Valoarea</td>
		<td><input type="text" name="value" value="<?php echo $menu_value['value']; ?>"></td>
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