<?php
require_once '../utils/db_connect.php';

$operation = '';
foreach ($_POST as $key => $value) {
	$position = strpos($key, 'operation_');
	
	if (gettype($position) != "boolean") {
		$operation = substr($key, $position + 10);
	}
}

$menu_id = -1;
if (isset($_POST['menu']) and strlen($_POST['menu']) > 0) {
	$menu_id = $_POST['menu'];
}

$parent_id = -1;
$menu_list = executeSelect("SELECT * from menus WHERE id = $menu_id");
if (isset($menu_list['0'])) {
	$parent_id = $menu_list['0']['parent'];
}

if ($operation == 'add') {
	$menu_value_edit = array();
	$menu_value_edit['0'] = array('id' => '', 'menu' => $menu_id, 'language' => '', 'value' => '');
	$languages_list = executeSelect("SELECT * FROM languages where active = 1");
}

if ($operation == 'edit') {
	if (isset($_POST['id'])) {
		$menu_value_edit = executeSelect("SELECT * FROM menu_values WHERE id = " . $_POST['id']);
		$menu_id = $menu_value_edit['0']['menu'];
		$languages_list = executeSelect("SELECT * FROM languages where active = 1");
	}
}

if ($operation == 'delete') {
	if (isset($_POST['id'])) {
		executeOperation("DELETE FROM menu_values WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'save') {
	// print_r($_POST);
	
	$id = $_POST['id'];
	$menu = $_POST['menu'];
	$language = $_POST['language'];
	$value = $_POST['value'];
	
	$menu_values_search = executeSelect("SELECT * FROM menu_values WHERE menu = $menu AND language = $language");
	if (isset($menu_values_search['0'])) {
		$id = $menu_values_search['0']['id'];
	}
	
	if (isset($id) and strlen($id) > 0) {
		//it is update
		executeOperation("UPDATE menu_values SET language = $language, value='$value' WHERE id = $id");
	} else {
		// it is insert
		$id = getMaxId("menu_values") + 1;
		executeOperation("INSERT INTO menu_values values($id, $menu, $language, '$value')");
	}
}


$menu_values_list = executeSelect("SELECT m.*, l.language FROM menu_values m, languages l WHERE l.id = m.language AND m.menu = $menu_id ORDER BY m.id");
require_once 'view.php';
?>