<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
	<tr>
		<td colspan="3">
<?php 
if (isset($menu_tree)) {
?>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="action" value="menu" /> 
				<input type="hidden" name="operation_submenu" value="Submeniu" />
				<input type="submit" value="Meniu" /> 
			</form>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="action" value="menu" /> 
				<input type="hidden" name="operation_submenu" value="Submeniu" />
				<input type="hidden" name="id" value="<?php echo $menu_tree[0]['id'];?>" />
				<?php echo "->"; ?>
				<input type="submit" value="<?php echo $menu_tree[0]['name'];?>" /> 
			</form>
<?php 
	while (isset($menu_tree[0]['child'])) {
		$menu_tree = $menu_tree[0]['child'];
?>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="action" value="menu" /> 
				<input type="hidden" name="operation_submenu" value="Submeniu" />
				<input type="hidden" name="id" value="<?php echo $menu_tree[0]['id'];?>" />
				<?php echo "->"; ?>
				<input type="submit" value="<?php echo $menu_tree[0]['name'];?>" /> 
			</form>
<?php
	}
}
?>
		</td>
	</tr>
	<tr style="background-color: yellow">
		<td style="width: 200px;">Meniu
		</td>
		<td style="width: 100px;">Pozitie
		</td>
		<td>
		</td>
	</tr>
<?php
foreach ($menu_list as $menu) {
?>	
	<tr>
		<td><?php echo $menu['name']?></td>
		<td><?php echo $menu['position']?></td>
		<td>
			<form action="" method="post" style="float: left;">
				<input type="hidden" name="id" value="<?php echo $menu['id']; ?>" /> 
				<input type="hidden" name="parent" value="<?php echo $menu['parent']; ?>" /> 
				<input type="hidden" name="action" value="menu" /> 
				<input type="submit" name="operation_submenu" value="Submeniu"/>
				<input type="submit" name="operation_edit" value="Editeaza"/>
			</form>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="menu" value="<?php echo $menu['id']; ?>" /> 
				<input type="hidden" name="action" value="menu_values" /> 
				<input type="submit" value="Traduceri" />
			</form>			
			<form action="" method="post" style="float: left">
				<input type="hidden" name="menu" value="<?php echo $menu['id']; ?>" /> 
				<input type="hidden" name="action" value="pages" /> 
				<input type="submit" value="Pagini" />
			</form>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="menu" value="<?php echo $menu['id']; ?>" /> 
				<input type="hidden" name="action" value="products" /> 
				<input type="submit" value="Produse" />
			</form>
		</td>
	</tr>
<?php
}
?>
</table>
<form action="" method="post">
	<input type="hidden" name="action" value="menu" /> 
	<input type="hidden" name="parent" value="<?php echo $parent_id; ?>" />
	<input type="submit" name="operation_add" value="Adauga" />
</form>

<br/>
<br/>
<?php 
if (isset($menu_edit)) {
	foreach ($menu_edit as $menu) {
?>
<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $menu['id']; ?>" /> 
<input type="hidden" name="action" value="menu" /> 
<input type="hidden" name="parent" value="<?php echo $parent_id; ?>" /> 
<table>
	<tr>
		<td>Meniu</td>
		<td><input type="text" name="name" value="<?php echo $menu['name']; ?>"></td>
	</tr>
	<tr>
		<td>Pozitia</td>
		<td>
			<select name="position">
			<?php
			for ($i = 1; $i < 30; $i++) {
				if ($i == $menu['position']) {
				?>
				<option selected="selected"><?php echo $i; ?></option>	
				<?php 
				} else {
				?>
				<option><?php echo $i; ?></option>	
				<?php 
				}
			} 
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Stare</td>
		<td><input type="checkbox" name="state" value="1" <?php if($menu['state'] > 0) { ?> checked="checked" <?php } ?>></td>
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