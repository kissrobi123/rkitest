<?php
function getTranslation($language, $key) {
    $value = $key;
    $lang_keys = executeSelect("SELECT * FROM lang_keys WHERE language = $language AND `key` = '$key'");
    if (isset($lang_keys['0'])) {
        $value = $lang_keys['0']['value'];
    }

    return $value;
}

function listProducts($menuId, $languageId) {
	$products = array();
	$products = addProducts($menuId, $languageId, $products);
	if (count($products) > 0) {
?>
<table>
	<tr>
<?php
		$contor = 0;
		foreach ($products as $product) {
			$producLangs = executeSelect("SELECT * FROM product_langs WHERE product = " . $product['id'] . " AND language = $languageId");
			if (isset($producLangs['0'])) {
				$product['name'] = $producLangs['0']['name'];
				$product['shortDescr'] = $producLangs['0']['shortDescr'];
			}
			$filename = "images/".$product['id']. "_150_150.jpg";
			if (!file_exists($filename)) {
				$filename = "images/blank.jpg";
			}
?>
		<td ><img src="<?php echo $filename; ?>" onclick="javascript:submitProductForm('<?php echo $product['id'];?>')"> </td>
		<td style="vertical-align:top; width: 300px">
			<?php echo getTranslation($languageId, 'Nume:') . " " . $product['name'];?><br/>
			<?php echo getTranslation($languageId, 'Dim(Lxlxh):') . " " . $product['length'] . ' x ' . $product['width'] . ' x ' . $product['height'];?><br/>
			<?php echo getTranslation($languageId, 'Descr:') . " " . $product['shortDescr'];?></td>
<?php
			$contor++;
			if ($contor % 3 == 0) {
?>
	</tr>
	<tr>
		<td>&nbsp;
		</td>
	</tr>
	<tr>
<?php
			}
		}
?>
	</tr>
</table>
<?php
	}
}

function addProducts($menuId, $languageId, $array) {
	$childMenus = executeSelect("SELECT * FROM menus WHERE parent = $menuId AND state > 0 ORDER BY position, id");
	$products = executeSelect("SELECT * FROM products WHERE menu = $menuId");
	if (count($products) > 0) {
		$index = count($array);
		foreach ($products as $product) {
			$producLangs = executeSelect("SELECT * FROM product_langs WHERE product = " . $product['id'] . " AND language = $languageId");
			if (isset($producLangs['0'])) {
				$product['name'] = $producLangs['0']['name'];
				$product['shortDescr'] = $producLangs['0']['shortDescr'];
			}
			$array["'" . $index . "'"] = $product;
			$index++;
		}
	} else {
		foreach ($childMenus as $childMenu) {
			$array = addProducts($childMenu['id'], $languageId, $array);
		}
	}
	
	return $array;
}

function listProduct($productId, $languageId) {
	$products = executeSelect("SELECT * FROM products WHERE id = $productId");
	if (isset($products['0'])) {
		$product = $products['0'];
		$producLangs = executeSelect("SELECT * FROM product_langs WHERE product = " . $product['id'] . " AND language = $languageId");
		if (isset($producLangs['0'])) {
			$product['name'] = $producLangs['0']['name'];
			$product['shortDescr'] = $producLangs['0']['shortDescr'];
		}
?>
<div style="width: 100%; text-align:center">
	<span style="font-size:30px; font-weight: bold"><?php echo $product['name'];?></span><br/>
<?php
	if (file_exists("images/".$product['id'])) {
?>
	<img id="productImg" src="<?php echo "images/".$product['id'].".jpg"; ?>">
	<br/>
<?php
	}

    $detailImages = array();
    $filename = "images/". $productId;
    if (file_exists($filename)) {
        $detailImages = scandir($filename);
    }
?>
    <div style="text-align: left; width: 400px; display: inline-block">
<?php
    if (file_exists($filename . ".jpg")) {
?>
        <img onclick="changeImg(<?php echo "'" . $filename . ".jpg'"; ?>)" src="<?php echo $filename . "_30_30.jpg"; ?>"
             alt="Fara imagine">
<?php
    }

        foreach ($detailImages as $detailImage) {
            if ($detailImage == '.' || $detailImage == '..') {
                continue;
            }
            ?>
            <img onclick="changeImg(<?php echo "'" . "images/". $productId . "_o/" . $detailImage . "'"; ?>)"
                 src="<?php echo "images/". $productId . "/" . $detailImage; ?>" alt="Fara imagine">
        <?php
        }
        ?>
        <br/>
        <?php echo getTranslation($languageId, 'Dim(Lxlxh):') . " " . $product['length'] . ' x ' . $product['width'] . ' x ' . $product['height'];?>
        <br/>
        <?php echo getTranslation($languageId, 'Descriere:') . " " . $product['shortDescr'];?>
    </div>
</div>
<?php
	}
}

if ($productId != null) {
	listProduct($productId, $languageId);
} else {
	listProducts($menuId, $languageId);
}
?>