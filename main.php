<?php 
require_once 'utils/db_connect.php';
require_once 'utils/menu.php';
connect();

function getMenuTranslation($menuId, $languageId, $menu) {
	$menu_translation = executeSelect("SELECT * FROM menu_values WHERE menu = $menuId AND language = $languageId");
	
	if (isset($menu_translation[0])) {
		return $menu_translation[0]['value'];
	}
	
	return $menu;
}

// print_r($_POST);
?>
	<div>
		<div style="height: 210px; font-size: 40px; text-align: center; text-shadow:blue; text-transform: uppercase;">
			<input type="image" src="images/templom1b.jpg" style="float: left; padding-right: 20px;">
			Arad gaji reformatus egyhazkozseg
		</div>
	</div>	
	<div class="menu">
		<table>
			<tr style="height: 46px; width: 700px; text-transform: uppercase; overflow: hidden;">
				<td style="background-image: url('images/slice/rect7524.png'); background-repeat: repeat-x;">
					<div style="width: 20px;"></div>
				&nbsp;
				</td>
	<?php 	
$menu_list = executeSelect("SELECT * FROM menus WHERE parent <= 0 and state > 0 ORDER BY position, id");

$viewMenuTree = false;
$menu_tree = executeSelect("SELECT * FROM menus WHERE id = $menuId");
while ($menu_tree[0]['parent'] > 0) {
	$viewMenuTree = true;
	$new_menu_tree = executeSelect("SELECT * FROM menus WHERE id = " . $menu_tree[0]['parent']);
	$new_menu_tree[0]['child'] = $menu_tree;
	$menu_tree = $new_menu_tree;
}

$menuCount = count($menu_list);
$selectedMenu = $menu_tree[0]['id'];
$i = 0;
foreach ($menu_list as $menu) {
	$img = $menu['id'] == $selectedMenu ? 'images/slice/rect7522.png' : 'images/slice/rect7524.png';
?>
				<td style="background-image: url('<?php echo $img?>'); background-repeat: repeat-x; white-space: nowrap; padding: 0px 5px 0px 5px; cursor:pointer;" 
				onclick="javascript:submitMenuForm('<?php echo $menu['id'];?>')">
					<div style="width: 100%;"><?php echo getMenuTranslation($menu['id'], $languageId, $menu['name']);?></div>
				</td>
<?php 
	if ($i + 1 < $menuCount) {
?>
				<td style="background-image: url('images/slice/rect7524.png'); background-repeat: repeat-x; white-space: nowrap;">
					<div style="width: 100%;">|</div>
				</td>
<?php 			
	}
	
	$i++;
}
	
?>				
				<td style="width:100%; background-image: url('images/slice/rect7524.png'); background-repeat: repeat-x;"></td>
			</tr>
		</table>
	</div>
	<div class="submenu">
		<table>
<?php 
if ($viewMenuTree) {
?>
			<tr style="width: 700px; text-transform: uppercase; overflow: hidden; font-size: 10px;">
				<td>
					<div style="float: left; cursor: pointer;" onclick="javascript:submitMenuForm('<?php echo $menu_tree[0]['id'];?>')"><?php echo $menu_tree[0]['name'];?> </div> 
<?php 

while (isset($menu_tree[0]['child'])) {
	$menu_tree = $menu_tree[0]['child'];
?>
					<div style="float: left">-&gt;</div> 
					<div style="float: left; cursor: pointer;" onclick="javascript:submitMenuForm('<?php echo $menu_tree[0]['id'];?>')"><?php echo $menu_tree[0]['name'];?> </div> 
<?php
}
?>
				</td>
			</tr>
<?php
} ?>
		</table>
	</div>
<?php
require_once 'menu_content.php';
?>