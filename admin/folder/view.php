<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
	<tr>
		<td colspan="3">
<?php 
if (isset($folder_tree)) {
?>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="action" value="folder" /> 
				<input type="hidden" name="operation_subfolder" value="Subfolder" />
				<input type="submit" value="Folder" /> 
			</form>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="action" value="folder" /> 
				<input type="hidden" name="operation_subfolder" value="Subfolder" />
				<input type="hidden" name="id" value="<?php echo $folder_tree[0]['id'];?>" />
				<?php echo "->"; ?>
				<input type="submit" value="<?php echo $folder_tree[0]['name'];?>" /> 
			</form>
<?php 
	while (isset($folder_tree[0]['child'])) {
		$folder_tree = $folder_tree[0]['child'];
?>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="action" value="folder" /> 
				<input type="hidden" name="operation_subfolder" value="Subfolder" />
				<input type="hidden" name="id" value="<?php echo $folder_tree[0]['id'];?>" />
				<?php echo "->"; ?>
				<input type="submit" value="<?php echo $folder_tree[0]['name'];?>" /> 
			</form>
<?php
	}
}
?>
		</td>
	</tr>
	<tr style="background-color: yellow">
		<td style="width: 200px;">Folder
		</td>
		<td>
		</td>
	</tr>
<?php
foreach ($folder_list as $folder) {
?>	
	<tr>
		<td><?php echo $folder['name']?></td>
		<td>
			<form action="" method="post" style="float: left;">
				<input type="hidden" name="id" value="<?php echo $folder['id']; ?>" /> 
				<input type="hidden" name="parent" value="<?php echo $folder['parent']; ?>" /> 
				<input type="hidden" name="action" value="folder" /> 
				<input type="submit" name="operation_subfolder" value="Subfolder"/>
				<input type="submit" name="operation_edit" value="Editeaza"/>
				<input type="submit" name="operation_delete" value="Sterge" />
			</form>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="folder" value="<?php echo $folder['id']; ?>" /> 
				<input type="hidden" name="action" value="file" /> 
				<input type="submit" value="Fisiere" />
			</form>
		</td>
	</tr>
<?php
}
?>
</table>
<form action="" method="post">
	<input type="hidden" name="action" value="folder" /> 
	<input type="hidden" name="parent" value="<?php echo $parent_id; ?>" />
	<input type="submit" name="operation_add" value="Adauga" />
</form>

<br/>
<br/>
<?php 
if (isset($folder_edit)) {
	foreach ($folder_edit as $folder) {
?>
<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $folder['id']; ?>" /> 
<input type="hidden" name="action" value="folder" /> 
<input type="hidden" name="parent" value="<?php echo $parent_id; ?>" /> 
<table>
	<tr>
		<td>Folder</td>
		<td><input type="text" name="name" value="<?php echo $folder['name']; ?>"></td>
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