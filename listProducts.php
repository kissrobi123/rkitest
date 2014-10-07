<?php
function listProducts($menuId, $languageId) {
	$childMenus = executeSelect("SELECT * FROM menus WHERE parent = $menuId AND state > 0 ORDER BY position, id");
	$products = executeSelect("SELECT * FROM products WHERE menu = $menuId");
	if (count($products) > 0) {
		foreach ($products as $product) {
			$producLangs = executeSelect("SELECT * FROM product_langs WHERE product = " . $product['id'] . " AND language = $languageId");
			if (isset($producLangs['0'])) {
				$product['name'] = $producLangs['0']['name'];
				$product['shortDescr'] = $producLangs['0']['shortDescr'];
			}
?>
<table>
	<tr>
		<td rowspan="3"><img src="<?php echo "images/".$product['id']. "_150_150.jpg"; ?>" onclick="javascript:submitProductForm('<?php echo $product['id'];?>')"> </td>
		<td style="vertical-align:top">
			Nume: <?php echo $product['name'];?><br/>
			Dim(Lxlxh): <?php echo $product['length'] . ' x ' . $product['width'] . ' x ' . $product['height'];?><br/>
			Descr: <?php echo $product['shortDescr'];?></td>
	</tr>
</table>
<?php
		}
	} else {
		foreach ($childMenus as $childMenu) {
			listProducts($childMenu['id'], $languageId);
		}
	}
}

listProducts($menuId, $languageId);
?>