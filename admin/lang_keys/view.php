<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
	<tr style="background-color: yellow">
		<td style="width: 200px;">Cheie
		</td>
		<td style="width: 100px;">Traducere
		</td>
        <td>
        </td>
	</tr>
<?php
foreach ($lang_keys_list as $lang_key) {
?>	
	<tr>
        <td><?php echo $lang_key['key']?></td>
        <td><?php echo $lang_key['value']?></td>
        <td>
            <form action="" method="post"  style="float: left">
                <input type="hidden" name="id" value="<?php echo $lang_key['id']; ?>" />
                <input type="hidden" name="lang_id" value="<?php echo $lang_id; ?>" />
                <input type="hidden" name="action" value="lang_keys" />
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
    <input type="hidden" name="action" value="lang_keys" />
    <input type="hidden" name="lang_id" value="<?php echo $lang_id; ?>" />
    <input type="submit" name="operation_add" value="Adauga" />
</form>
<br/>
<br/>
<?php
if (isset($lang_key_edit)) {
foreach ($lang_key_edit as $lang_key) {
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $lang_key['id']; ?>" />
<input type="hidden" name="lang_id" value="<?php echo $lang_id; ?>" />
<input type="hidden" name="action" value="lang_keys" />
<table>
	<tr>
		<td>Cheie</td>
		<td>
            <select name="key">
                <option <?php if($lang_key == 'Nume:'){ ?> selected="selected" <?php }?>>
                    Nume:
                </option>
                <option <?php if($lang_key == 'Dim(Lxlxh):'){ ?> selected="selected" <?php }?>>
                    Dim(Lxlxh):
                </option>
                <option <?php if($lang_key == 'Descr:'){ ?> selected="selected" <?php }?>>
                    Descr:
                </option>
            </select>
        </td>
	</tr>
	<tr>
		<td>Traducere</td>
		<td><input type="text" name="value" value="<?php echo $lang_key['value'];?>" /> </td>
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