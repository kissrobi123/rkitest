<?php
require_once '../utils/db_connect.php';

$operation = '';
foreach ($_POST as $key => $value) {
	$position = strpos($key, 'operation_');
	
	if (gettype($position) != "boolean") {
		$operation = substr($key, $position + 10);
	}
}

$parent_id = -1;
if (isset($_POST['parent']) and strlen($_POST['parent']) > 0) {
	$parent_id = $_POST['parent'];
}

if ($operation == 'submenu') {
	if (isset($_POST['id']) and strlen($_POST['id']) > 0) {
		$parent_id = $_POST['id'];
	}
}

if ($parent_id > 0) {
	$menu_tree = executeSelect("SELECT * FROM menus WHERE id = $parent_id");
	while ($menu_tree[0]['parent'] > 0) {
		$new_menu_tree = executeSelect("SELECT * FROM menus WHERE id = " . $menu_tree[0]['parent']);
		$new_menu_tree[0]['child'] = $menu_tree;
		$menu_tree = $new_menu_tree;
	}
}

if ($operation == 'add') {
	$menu_edit = array();
	$menu_edit['0'] = array('id' => '', 'name' => '', 'position' => '');
}

if ($operation == 'edit') {
	if (isset($_POST['id'])) {
		$menu_edit = executeSelect("SELECT * FROM menus WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'delete') {
	if (isset($_POST['id'])) {
		executeOperation("DELETE FROM menus WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'save') {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$position = $_POST['position'];
	$parent = $_POST['parent'];
	
	if (isset($_POST['id']) and strlen($_POST['id']) > 0) {
		//it is update
		executeOperation("UPDATE menus SET name = '$name', position=$position WHERE id = $id");
	} else {
		// it is insert
		$id = getMaxId("menus") + 1;
		executeOperation("INSERT INTO menus values($id, '$name', $position, $parent)");
	}
}

$menu_list = executeSelect("SELECT * FROM menus WHERE parent is null and $parent_id = -1 or parent = $parent_id ORDER BY position, id");
require_once 'view.php';
?>