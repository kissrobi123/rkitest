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
$product_id = -1;
if (isset($_POST['product']) and strlen($_POST['product']) > 0) {
	$product_id = $_POST['product'];
	$product = executeSelect("SELECT * FROM products where id = $product_id");
	if (isset($product['0'])) {
		$menu_id = $product['0']['menu'];
	}
}

if ($operation == 'add') {
	$productLang_edit = array();
	$productLang_edit['0'] = array('id' => '', 'product' => $product_id, 'language' => '', 'name' => '', 'shortDescr' => '');
	$languages_list = executeSelect("SELECT * FROM languages where active = 1");
}

if ($operation == 'edit') {
	if (isset($_POST['id'])) {
		$productLang_edit = executeSelect("SELECT * FROM product_langs WHERE id = " . $_POST['id']);
	}
	$languages_list = executeSelect("SELECT * FROM languages where active = 1");
}

if ($operation == 'delete') {
	if (isset($_POST['id'])) {
		executeOperation("DELETE FROM product_langs WHERE id = " . $_POST['id']);
	}
}

if ($operation == 'save') {
	// print_r($_POST);
	
	$id = $_POST['id'];
	$product = $_POST['product'];
	$language = $_POST['language'];
	$name = $_POST['name'];
	$shortDescr = $_POST['shortDescr'];
	
	if (isset($id) and strlen($id) > 0) {
		//it is update
		executeOperation("UPDATE product_langs SET name = '$name', shortDescr = '$shortDescr', language = $language WHERE id = $id");
	} else {
		// it is insert
		$id = getMaxId("product_langs") + 1;
		executeOperation("INSERT INTO product_langs values($id, $product, $language, '$name', '$shortDescr')");
	}
}


$productLangs_list = executeSelect("SELECT m.* FROM product_langs m WHERE m.product = $product_id ORDER BY m.id");
require_once 'view.php';
?>