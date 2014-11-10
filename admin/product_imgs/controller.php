<?php
require_once '../utils/img.php';

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

if ($operation == 'setMain') {
	if ($_FILES["file"]["error"] > 0) {
	} else {
		$fileName = "../images/". $product_id;
		move_uploaded_file($_FILES["file"]["tmp_name"], $fileName. ".jpg");
		makeThumb($fileName . ".jpg", $fileName . "_150_150.jpg");
        makeSizesBasedThumb($fileName . ".jpg", $fileName . "_30_30.jpg", 30, 30);
	}
}

if ($operation == 'addDetail') {
    if ($_FILES["file"]["error"] > 0) {
    } else {
        $fileName = "../images/". $product_id;
        $dirThumb = $fileName;
        $dirOrig = $fileName . "_o";
        if (!file_exists($dirThumb) ) {
            mkdir($dirThumb);
            mkdir($dirOrig);
        }
        $fileName = time() . ".jpg";
        move_uploaded_file($_FILES["file"]["tmp_name"], $dirOrig . "/" . $fileName);
        makeSizesBasedThumb($dirOrig . "/" . $fileName, $dirThumb . "/" . $fileName, 30, 30);
    }
}

if ($operation == 'delete' && isset($_POST['image']) and strlen($_POST['image']) > 0) {
    $image = $_POST["image"];
    $fileName = "../images/". $product_id;
    $dirThumb = $fileName;
    $dirOrig = $fileName . "_o";

    if (file_exists($dirOrig . "/" . $image)) {
        unlink($dirOrig . "/" . $image);
    }
    if (file_exists($dirThumb . "/" . $image)) {
        unlink($dirThumb . "/" . $image);
    }
}

$detailImages = scandir("../images/". $product_id);

require_once 'view.php';
?>