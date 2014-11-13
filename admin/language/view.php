<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
	<tr style="background-color: yellow">
		<td style="width: 200px;">Limba
		</td>
		<td style="width: 100px;">Activ
		</td>
        <td>
        </td>
	</tr>
<?php
foreach ($language_list as $language) {
?>	
	<tr>
		<td><?php echo $language['language']?></td>
		<td><input type="checkbox" <?php if ($language['active'] != 0) { ?> checked="checked" <?php } ?> disabled="disabled"/> </td>
		<td>
            <form action="" method="post"  style="float: left">
                <input type="hidden" name="id" value="<?php echo $language['id']; ?>" />
                <input type="hidden" name="action" value="language" />
                <input type="submit" name="operation_edit" value="Editeaza" />
                <input type="submit" name="operation_delete" value="Sterge" />
            </form>
            <form action="" method="post" style="float: left; padding-left: 20px">
                <input type="hidden" name="lang_id" value="<?php echo $language['id']; ?>" />
                <input type="hidden" name="action" value="lang_keys" />
                <input type="submit" name="operation_edit" value="Traduceri chei" />
            </form>
		</td>
	</tr>
<?php
}
?>
</table>
<form action="" method="post">
	<input type="hidden" name="action" value="language" /> 
	<input type="submit" name="operation_add" value="Adauga" />
</form>

<br/>
<br/>
<?php 
if (isset($language_edit)) {
	foreach ($language_edit as $language) {
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $language['id']; ?>" /> 
<input type="hidden" name="action" value="language" /> 
<table>
	<tr>
		<td>Limba</td>
		<td><input type="text" name="language" value="<?php echo $language['language']; ?>"></td>
	</tr>
	<tr>
		<td>Activ</td>
		<td><input type="checkbox" name="active" <?php if ($language['active'] != 0) { ?> checked="checked" <?php } ?> /> </td>
	</tr>
	<tr>
		<td>Imagine</td>
		<td><input type="file" name="file"/> </td>
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