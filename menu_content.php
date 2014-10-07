	<table style="width:100%">
		<tr>
			<td style="vertical-align: top; padding-top: 20px;">
<?php 
$menu_child_list = executeSelect("SELECT * FROM menus WHERE parent = $menuId AND state > 0 ORDER BY position, id");

$childs = count($menu_child_list);
foreach ($menu_child_list as $menu) {
?>
	<div style="width: 150px; cursor: pointer; background-image: url('images/slice/rect5203.png'); color: blue; margin-right: 5px; margin-bottom: 2px; padding-left: 10px; text-transform: uppercase;" 
		onclick="javascript:submitMenuForm('<?php echo $menu['id'];?>')"><?php echo  $menu['name']; ?> </div>
<?php 		
}
?>
			</td>
			<td>
<?php 
require_once('listProducts.php');

$content = executeSelect("SELECT * FROM pages WHERE menu = $menuId AND language = $languageId");
if (isset($content[0])) {
	echo $content[0]['value'];
}

?>	
			</td>
		</tr>
	</table>
