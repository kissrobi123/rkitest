<?php
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
			Nume: <?php echo $product['name'];?><br/>
			Dim(Lxlxh): <?php echo $product['length'] . ' x ' . $product['width'] . ' x ' . $product['height'];?><br/>
			Descr: <?php echo $product['shortDescr'];?></td>
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
	<img src="<?php echo "images/".$product['id']; ?>">
	<br/>
<?php
	}
?>
	<div style="text-align: left; width: 400px; display: inline-block">
	Dim(Lxlxh): <?php echo $product['length'] . ' x ' . $product['width'] . ' x ' . $product['height'];?>
	<br/>
	Descriere: <?php echo $product['shortDescr'];?>
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