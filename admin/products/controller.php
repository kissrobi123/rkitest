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
	$product_edit = array();
	$product_edit['0'] = array('id' => '', 'menu' => $menu_id, 'name' => '', 'length' => '0', 'width' => '0', 'height' => '0', 'shortDescr' => '');
}

if ($operation == 'edit') {
	if (isset($_POST['id'])) {
		$product_edit = executeSelect("SELECT * FROM products WHERE id = " . $_POST['id']);
		$menu_id = $product_edit['0']['menu'];
	}
}

if ($operation == 'delete') {
	if (isset($_POST['id'])) {
		executeOperation("DELETE FROM products WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'save') {
	// print_r($_POST);
	
	$id = $_POST['id'];
	$menu = $_POST['menu'];
	$name = $_POST['name'];
	$length = $_POST['length'];
	$width = $_POST['width'];
	$height = $_POST['height'];
	$shortDescr = $_POST['shortDescr'];
	
	if (isset($id) and strlen($id) > 0) {
		//it is update
		executeOperation("UPDATE products SET name = '$name', length = '$length', width = '$width', height = '$height', shortDescr = '$shortDescr' WHERE id = $id");
	} else {
		// it is insert
		$id = getMaxId("products") + 1;
		executeOperation("INSERT INTO products values($id, $menu, '$name', $length, $width, $height, '$shortDescr')");
	}
}


$products_list = executeSelect("SELECT m.* FROM products m WHERE m.menu = $menu_id ORDER BY m.id");
require_once 'view.php';
?>