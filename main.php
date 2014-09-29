<?php 
require_once 'utils/db_connect.php';
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
$menu_list = executeSelect("SELECT * FROM menus WHERE parent <= 0 ORDER BY position, id");

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
	<table>
		<tr>
			<td style="vertical-align: top; padding-top: 20px;">
<?php 
$menu_child_list = executeSelect("SELECT * FROM menus WHERE parent = $menuId ORDER BY position, id");

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
$content = executeSelect("SELECT * FROM pages WHERE menu = $menuId AND language = $languageId");
if (isset($content[0])) {
	echo $content[0]['value'];
}

?>
<!-- 
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
	blandit, sapien ut bibendum bibendum, risus enim rhoncus eros, nec
	elementum tortor metus ac elit. Nullam sollicitudin faucibus justo eu
	porttitor. Nunc accumsan ullamcorper lacus. Praesent odio arcu, feugiat
	eu posuere sed, bibendum non dui. Donec vel ipsum risus, nec gravida
	massa. Morbi sit amet quam lorem. Aenean dignissim, est vitae gravida
	venenatis, diam tortor luctus mi, sit amet mattis elit odio id odio.
	Praesent facilisis placerat interdum. Duis adipiscing mollis interdum.
	Vestibulum augue turpis, dapibus ac sodales sit amet, lobortis et eros.
	Nullam hendrerit adipiscing sapien, id rutrum metus aliquam sed. Vivamus
	commodo, dolor et pretium ornare, erat est dictum elit, sed pretium leo
	ante a ante. Donec id turpis sed erat egestas consequat.</p>
	
	<p>Pellentesque pretium vulputate elementum. Donec fringilla pharetra
	ipsum non consequat. Morbi bibendum sagittis odio, et molestie mi
	elementum eu. Etiam adipiscing scelerisque sem. Phasellus commodo
	malesuada arcu. Nullam vel nisi sed elit interdum hendrerit sed et
	sapien. Ut in faucibus justo. Nulla placerat tempor nibh, at aliquam
	nisl fringilla sit amet. Aliquam erat volutpat. Cras vitae quam eget
	turpis feugiat accumsan.</p>
	
	<p>Aliquam diam urna, dictum eget condimentum id, laoreet et lectus. Ut
	viverra urna tincidunt orci imperdiet porttitor. Suspendisse a imperdiet
	purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
	Suspendisse condimentum neque vitae mi laoreet posuere. Nulla facilisi.
	Aliquam metus urna, tincidunt sed sollicitudin ornare, fringilla vitae
	sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
	pretium nisi a nibh dignissim sit amet elementum felis viverra. Maecenas
	elit ipsum, condimentum sed volutpat ut, vehicula eget sem. Pellentesque
	massa leo, egestas et dignissim pretium, consectetur non ipsum. Vivamus
	luctus est sed nunc condimentum sit amet lobortis sem varius. Nam ut
	ante ut turpis volutpat placerat. Curabitur luctus erat eu ligula tempus
	ut pellentesque magna feugiat. Donec vitae porta mauris. Mauris sit amet
	vehicula sem. Pellentesque ac justo quis urna ultricies rhoncus quis sed
	lacus. Sed tempor, elit at dictum iaculis, orci erat tempus odio, in
	volutpat diam nunc id urna. Nulla quis mi magna. Vivamus viverra rhoncus
	quam, a tempus felis tempus id.</p>
	<p>Maecenas eget libero id nibh lacinia sodales sed nec tellus.
	Pellentesque leo mauris, molestie eu auctor eget, consequat a ipsum.
	Suspendisse dapibus ultricies pharetra. Etiam odio dui, facilisis id
	gravida vitae, porttitor vel sem. Vivamus tristique vestibulum rutrum.
	Donec sit amet elit massa. In hac habitasse platea dictumst. Nam a nisi
	lacus. Fusce ut justo felis. Nullam urna augue, imperdiet eu tempor sit
	amet, fringilla aliquet mauris. Nunc in orci dignissim massa aliquet
	luctus.</p>
	<p>Quisque eu mauris odio. Integer condimentum dui velit, eu lobortis
	velit. Phasellus malesuada ullamcorper tincidunt. Aliquam bibendum
	sapien et nibh consequat accumsan. Suspendisse magna arcu, dapibus vitae
	lobortis a, ullamcorper sit amet sem. Nullam et tellus augue, sed
	aliquam enim. Curabitur aliquam nulla vitae purus aliquet porttitor.
	Duis fermentum pharetra facilisis. Vestibulum ullamcorper nulla at dui
	interdum sit amet lacinia felis molestie. Nunc pulvinar iaculis turpis,
	eu malesuada ligula dignissim in. Suspendisse potenti.</p>
	<p>Nullam rhoncus vestibulum sapien. Nam elit orci, ornare at hendrerit
	vehicula, feugiat eget diam. Curabitur sit amet diam urna, non
	scelerisque neque. Aenean semper sollicitudin nibh, tristique lobortis
	urna elementum eget. Sed et urna in arcu varius auctor. In tempor, nisi
	vitae hendrerit faucibus, urna nibh tempor elit, accumsan elementum sem
	nisl non turpis. Donec placerat dictum est, quis luctus dui congue sed.
	Donec tincidunt scelerisque libero, sed adipiscing sapien ultrices
	bibendum. Nunc ligula justo, imperdiet ac eleifend eu, elementum in
	neque. Suspendisse aliquam tempor condimentum. Fusce venenatis fringilla
	risus, faucibus bibendum nisl molestie vitae. Duis rutrum, tortor id
	volutpat adipiscing, est turpis aliquet metus, condimentum consectetur
	nisl justo at urna. Mauris dictum congue rhoncus. Aenean nec lobortis
	erat. Morbi condimentum, turpis id vulputate blandit, velit lacus tempor
	augue, vel semper nisi nunc nec orci. Nulla facilisi. Vivamus porttitor
	nunc ac arcu interdum eget imperdiet mauris convallis. Nulla blandit
	auctor enim quis placerat. Nulla facilisi.</p>
	<p>Morbi nec purus ut justo tempus scelerisque nec eget massa.
	Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
	cubilia Curae; Vestibulum rhoncus porta massa, a ultricies quam tempus
	in. Aenean varius rutrum quam vitae aliquet. Aenean mi nisl, suscipit
	nec lacinia non, scelerisque quis sapien. Suspendisse interdum, enim id
	tempor sagittis, lectus leo sodales eros, nec consectetur arcu diam eu
	lacus. Duis vehicula, tortor in mattis ultrices, nulla orci lacinia
	nulla, sit amet malesuada nibh felis fringilla orci. Aliquam nisl enim,
	ullamcorper vitae suscipit nec, auctor vitae tellus. Etiam dictum
	tincidunt adipiscing. Donec vitae ipsum at ipsum ultricies tincidunt.
	Maecenas nec tortor eget ipsum tincidunt fringilla. Nulla facilisi.
	Vestibulum quis augue ac erat mollis pulvinar vitae ac eros.
	Pellentesque habitant morbi tristique senectus et netus et malesuada
	fames ac turpis egestas. Cras condimentum convallis lobortis.
	Suspendisse a ipsum id sem elementum mattis.</p>
	<p>Sed eu est mauris, at ultrices sapien. Ut in nisi ac nulla fringilla
	volutpat. Fusce in justo risus, eu consequat augue. Duis consequat neque
	ut arcu iaculis nec gravida augue molestie. Quisque varius sodales
	lorem, non sollicitudin tellus cursus vel. Ut iaculis tristique nunc at
	laoreet. Fusce feugiat, eros eu lobortis ullamcorper, nisi elit bibendum
	ante, et congue felis diam at lacus. Sed ut eros quam. Morbi vel velit
	at enim aliquet molestie. Phasellus vel diam lectus, ut suscipit sapien.
	Praesent imperdiet arcu id massa fermentum at convallis quam egestas.
	Donec euismod sem quis nisl tristique ac placerat augue facilisis. Ut
	fringilla elit vitae sapien iaculis consequat. Duis tempor odio ac
	tortor placerat ut venenatis risus porta. Donec ac orci diam, sed cursus
	magna. Curabitur eget metus ac justo faucibus mollis eu vitae felis.
	Aenean elementum adipiscing erat quis egestas. Nunc pellentesque
	consectetur orci, sed pulvinar neque tincidunt eget. Praesent rutrum,
	lectus vel ultrices sollicitudin, dolor tortor gravida justo, eu feugiat
	leo lacus non arcu. Nam vitae diam sed arcu tempor sagittis.</p>
	<p>Pellentesque habitant morbi tristique senectus et netus et malesuada
	fames ac turpis egestas. Nulla sit amet velit a ligula vulputate dapibus
	eget eu nulla. Nulla facilisi. Phasellus id quam velit, ut gravida
	purus. Praesent rhoncus, nulla nec viverra adipiscing, erat augue
	tincidunt tellus, sed imperdiet augue tellus a lectus. Vestibulum quis
	lectus nec massa dapibus porttitor. Aenean vitae sapien turpis, vel
	vestibulum dolor. Aliquam sodales scelerisque risus, non tempus sapien
	pharetra consequat. Donec euismod nulla et sapien posuere pharetra.
	Donec eleifend est et tellus ultrices at gravida leo dignissim. In
	bibendum elementum nibh, sed euismod lacus varius adipiscing. Praesent
	vitae ligula eget lorem eleifend venenatis. Maecenas ligula magna,
	interdum imperdiet vehicula ac, aliquet quis ipsum. Duis lorem risus,
	facilisis vel pellentesque laoreet, posuere ut est. Cum sociis natoque
	penatibus et magnis dis parturient montes, nascetur ridiculus mus.
	Praesent lectus libero, viverra sed cursus vel, tincidunt sed orci.
	Vestibulum tincidunt consectetur nisl, sed consequat felis bibendum id.
	In tempus elit ut odio pharetra in ullamcorper diam tincidunt. Nunc
	condimentum mi vel tortor vestibulum hendrerit. Aenean dignissim libero
	volutpat urna varius eu elementum eros elementum.</p>
	<p>Vivamus ut accumsan nisl. Pellentesque sit amet nulla risus, sed
	tristique sapien. Nunc volutpat sollicitudin justo, eu facilisis quam
	vulputate eu. Sed euismod vulputate elit, quis gravida augue cursus
	sollicitudin. Duis luctus tempor massa, in posuere ante mollis id.
	Maecenas vestibulum lorem vel sem condimentum placerat. Nunc sed lacus
	at sapien venenatis ullamcorper. In convallis nulla non orci porta vitae
	faucibus purus commodo. Donec rhoncus laoreet lorem in tempor. Phasellus
	pretium ipsum eu elit varius vitae mollis odio placerat. Maecenas
	accumsan orci eget nunc tincidunt id commodo ligula ornare. Class aptent
	taciti sociosqu ad litora torquent per conubia nostra, per inceptos
	himenaeos. Curabitur cursus scelerisque fringilla. Vivamus in leo metus.
	Morbi egestas dui a purus ultricies porta. Morbi vel porttitor diam.</p>
	<p>Fusce tincidunt aliquam interdum. In hac habitasse platea dictumst.
	Nulla ultrices velit ac leo pretium a gravida urna viverra. Vivamus enim
	lectus, volutpat eget lacinia vitae, varius in libero. Nullam fringilla,
	arcu ac eleifend dictum, erat ipsum pellentesque eros, ac eleifend erat
	neque nec augue. Phasellus semper turpis sit amet velit auctor iaculis.
	Aliquam adipiscing ante eu dolor scelerisque tristique. Nam vitae nisl
	vel leo iaculis fermentum molestie in eros. Vestibulum elementum
	ultrices elit, non egestas lacus aliquet nec. Fusce euismod nulla eu
	nisi rhoncus eget faucibus nunc tincidunt. Suspendisse sed elit sed
	lectus imperdiet euismod at non sem. Vivamus id erat lectus, et pharetra
	quam. Duis egestas vulputate ligula, ac fringilla metus hendrerit ac.</p>
	<p>Phasellus rutrum feugiat vestibulum. Vivamus semper risus nisl.
	Integer mattis diam id ipsum eleifend congue sit amet ac enim. Nam
	auctor justo nec tellus tincidunt rutrum. Sed pellentesque, nunc
	eleifend consequat sodales, leo felis condimentum lacus, vitae pharetra
	lectus ipsum et ante. Cras sit amet ligula dolor. In ut pharetra ipsum.
	In sed quam nibh, ac rhoncus enim. Integer et diam urna. Ut porttitor
	ipsum quis leo fringilla id varius ante imperdiet. Vestibulum dapibus
	orci et quam ultricies in cursus justo varius. Donec at nibh purus,
	mattis aliquet mi.</p>
	<p>Maecenas blandit, nisi at laoreet iaculis, nisi mi consequat ante,
	quis vulputate eros ipsum scelerisque odio. In hac habitasse platea
	dictumst. Maecenas in euismod mauris. Etiam venenatis tincidunt
	volutpat. Curabitur pretium volutpat urna, sed iaculis nunc ultricies
	sed. Nullam pellentesque mauris sed massa blandit non fermentum sapien
	aliquet. Duis elementum massa at odio fermentum hendrerit quis at arcu.
	Etiam nec odio purus, varius facilisis nibh. Donec eleifend pellentesque
	ipsum ut commodo. Cras nibh arcu, tincidunt sed fermentum vitae,
	fringilla sed diam. Mauris sit amet arcu sapien, eu sagittis nunc.
	Phasellus porttitor, turpis euismod commodo pharetra, risus urna lacinia
	sem, at fermentum magna est eu eros. Nunc quis elit eget erat facilisis
	faucibus ac id odio. Nulla venenatis sollicitudin elit ac aliquam.</p>
	<p>Sed malesuada diam a diam bibendum at tempus urna porta. Integer mi
	mauris, egestas bibendum euismod nec, vulputate non elit. Duis eu libero
	nunc, ac ultrices lorem. Proin tempor, dui id congue pellentesque, ipsum
	diam porttitor diam, eget posuere dui nunc facilisis tortor. Aliquam
	pellentesque felis dictum risus aliquam et euismod eros condimentum.
	Duis porttitor mauris nisl, ut interdum sem. Suspendisse sit amet mattis
	felis. Morbi sit amet porttitor nibh. Etiam vehicula, velit eu rutrum
	rutrum, est risus commodo arcu, sed convallis leo quam a nunc. In hac
	habitasse platea dictumst. Vestibulum faucibus orci a orci tincidunt
	ultricies. Nullam porta, diam scelerisque facilisis posuere, augue diam
	interdum lacus, at suscipit magna justo ut arcu. Vivamus facilisis
	semper tristique. Nam suscipit pretium mi, quis porttitor odio accumsan
	posuere. Morbi consequat accumsan risus sed pellentesque. Nam elementum
	pharetra iaculis. Suspendisse dictum pharetra enim, vitae hendrerit
	lectus tincidunt sit amet.</p>
	<p>Ut et nisi turpis, quis faucibus nulla. Suspendisse sed turpis
	tellus, ullamcorper pharetra diam. Vestibulum pulvinar urna eros, in
	sodales est. Aliquam imperdiet tellus sit amet mauris posuere eget
	adipiscing purus bibendum. Phasellus venenatis bibendum tortor et
	aliquam. Mauris sed metus libero. Phasellus lacinia, tortor vitae mollis
	placerat, enim sem suscipit risus, sit amet venenatis elit sem id odio.
	Nunc euismod metus tortor. Sed at lacus vitae neque consectetur
	consequat. In hac habitasse platea dictumst. Sed malesuada dictum dolor
	id volutpat. Vivamus suscipit eros a dui gravida pellentesque. Proin eu
	odio lectus, ornare egestas arcu. Maecenas ac eros ut erat tristique
	sollicitudin at vel lacus. Nunc quis ipsum massa. Donec eu felis velit,
	eget rutrum leo. Mauris vitae justo tellus, ut molestie sapien.</p>
	 -->
	
		</td>
	</tr>
</table>
