<?php
function listProducts($menuId, $languageId) {
	$childMenus = executeSelect("SELECT * FROM menus WHERE parent = $menuId AND state > 0 ORDER BY position, id");
	foreach ($childMenus as $childMenu) {
		$products = executeSelect("SELECT * FROM products WHERE menu = $menuId");
		if (count($products) > 0) {
?>
<table>
<?php
		foreach ($products as $product) {
			$producLangs = executeSelect("SELECT * FROM product_langs WHERE product = " . $product['id'] . " AND language = $languageId");
			if (isset($producLangs['0'])) {
				$product['name'] = $producLangs['0']['name'];
				$product['shortDescr'] = $producLangs['0']['shortDescr'];
			}
?>
	<tr>
		<td>Nume: </td>
		<td><?php echo $product['name'];?></td>
	</tr>
	<tr>
		<td>Dim(Lxlxh): </td>
		<td><?php echo $product['length'] . ' x ' . $product['width'] . ' x ' . $product['height'];?></td>
	</tr>
	<tr>
		<td>Descr: </td>
		<td><?php echo $product['shortDescr'];?></td>
	</tr>
<?php
		}
?>
</table>
<?php
		} else {
			listProducts($childMenu['id'], $languageId);
		}
	}
}

listProducts($menuId, $languageId);
?>