<?php
require_once '../utils/db_connect.php';

$operation = '';

foreach ($_POST as $key => $value) {
	$position = strpos($key, 'operation_');
	if ($position >= 0) {
		$operation = substr($key, $position + 10);
	}
}

if ($operation == 'add') {
    $lang_key_edit = array();
    $lang_key_edit['0'] = array('id' => '', 'language' => '$lang_id', 'key' => '', 'value' => '');
}

if ($operation == 'edit') {
    if (isset($_POST['id'])) {
        $lang_key_edit = executeSelect("SELECT * FROM lang_keys WHERE id = " . $_POST['id']);
    }
}

if ($operation == 'delete') {
    if (isset($_POST['id'])) {
        executeOperation("DELETE FROM lang_keys WHERE id = " . $_POST['id']);
    }
}

if ($operation == 'save') {
	// print_r($_POST);
	
	$id = $_POST['id'];
	$language = $_POST['lang_id'];
    $key = $_POST['key'];
    $value = isset($_POST['value']) ? $_POST['value'] : '';

	if (isset($_POST['id']) and strlen($_POST['id']) > 0) {
		//it is update
		executeOperation("UPDATE lang_keys SET `key` = '$key', value = '$value' WHERE id = $id");
	} else {
		// it is insert
		$id = getMaxId("lang_keys") + 1;
		executeOperation("INSERT INTO lang_keys values($id, $language, '$key', '$value')");
	}
}

$lang_id = -1;
if (isset($_POST['lang_id']) and strlen($_POST['lang_id']) > 0) {
    $lang_id = $_POST['lang_id'];
}

$lang_keys_list = executeSelect("SELECT * FROM lang_keys where language = $lang_id");
require_once 'view.php';

?>