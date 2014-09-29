<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
	<tr>
		<td colspan="3">
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $parent_id; ?>" />
				<input type="hidden" name="action" value="folder" /> 
				<input type="submit" name="operation_subfolder" value="Inapoi la folder" />
			</form>
		</td>
	</tr>
	<tr style="background-color: yellow">
		<td style="width: 200px;">Nume
		</td>
		<td style="width: 400px;">Link
		</td>
		<td>
		</td>
	</tr>
<?php
$fileFolder = str_replace('admin/', 'files/', $_SERVER['HTTP_REFERER']);
foreach ($file_list as $file) {
?>	
	<tr>
		<td><?php echo $file['name']?></td>
		<td><?php echo $fileFolder . $file['id']?></td>
		<td>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="id" value="<?php echo $file['id']; ?>" /> 
				<input type="hidden" name="action" value="file" /> 
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
	<input type="hidden" name="action" value="file" /> 
	<input type="hidden" name="folder" value="<?php echo $folder_id; ?>" />
	<input type="submit" name="operation_add" value="Adauga" />
</form>

<br/>
<br/>
<?php 
if (isset($file_edit)) {
	foreach ($file_edit as $file) {
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $file['id']; ?>" /> 
<input type="hidden" name="action" value="file" /> 
<input type="hidden" name="folder" value="<?php echo $file['folder']; ?>" /> 
<table>
	<tr>
		<td>Nume</td>
		<td><input type="text" name="name" value="<?php echo $file['name']; ?>"></td>
	</tr>
	<tr>
		<td>Descriere</td>
		<td><input type="text" name="description" value="<?php echo $file['description']; ?>"></td>
	</tr>
	<tr>
		<td>Fisier</td>
		<td><input type="file" name="file"></td>
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