<div style="float: right; margin-top: 5px; margin-right: 30px; border: 1px solid white; padding: 5px;">
<?php
$language_list = executeSelect("SELECT * FROM languages WHERE active = 1 ORDER BY id");
foreach ($language_list as $language) {
?>
	<input type="image" onclick="javascript:submitLanguageForm('<?php echo $language['id']; ?>')" src="images/languages/<?php echo $language['id']; ?>" style="height: 10px;"/>
<?php 
}
?>
</div>