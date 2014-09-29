<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
	<tr>
		<td colspan="3">
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $parent_id; ?>" />
				<input type="hidden" name="action" value="menu" /> 
				<input type="submit" name="operation_submenu" value="Inapoi la meniu" />
			</form>
		</td>
	</tr>
	<tr style="background-color: yellow">
		<td style="width: 200px;">Limba
		</td>
		<td style="width: 100px;">Titlu pagina
		</td>
		<td>
		</td>
	</tr>
<?php
foreach ($pages_list as $page) {
?>	
	<tr>
		<td><?php echo $page['language']?></td>
		<td><?php echo $page['title']?></td>
		<td>
			<form action="" method="post" style="float: left">
				<input type="hidden" name="id" value="<?php echo $page['id']; ?>" /> 
				<input type="hidden" name="action" value="pages" /> 
				<input type="submit" name="operation_edit" value="Editeaza" />
				<input type="submit" name="operation_delete" value="Sterge" />
			</form>
		</td>
	</tr>
<?php
}
?>
</table>
<form action="" method="post">
	<input type="hidden" name="action" value="pages" /> 
	<input type="hidden" name="menu" value="<?php echo $menu_id; ?>" />
	<input type="submit" name="operation_add" value="Adauga" />
</form>

<br/>
<br/>
<?php 
if (isset($page_edit)) {
	foreach ($page_edit as $page) {
?>
<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $page['id']; ?>" /> 
<input type="hidden" name="action" value="pages" /> 
<input type="hidden" name="menu" value="<?php echo $page['menu']; ?>" /> 
<table>
	<tr>
		<td>Limba</td>
		<td>
			<select name="language">
			<?php 
			foreach ($languages_list as $language) {
				if ($language['id'] == $page['language']) {
				?>	
				<option selected="selected" value="<?php echo $language['id']; ?>"><?php echo $language['language'] ?></option>
				<?php 
				} else {
				?>	
				<option value="<?php echo $language['id']; ?>"><?php echo $language['language'] ?></option>
				<?php 
				}
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Titlu pagina</td>
		<td><input type="text" name="title" value="<?php echo $page['title']; ?>"></td>
	</tr>
	<tr>
		<td>Cuvinte cheie</td>
		<td><input type="text" size="50" name="keywords" value="<?php echo $page['keywords']; ?>"></td>
	</tr>
	<tr>
		<td>Pagina</td>
		<td>
			<script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript">
				tinyMCE.init({
					// General options
					mode : "textareas",
					theme : "advanced",
					plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
			
					// Theme options
					theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
					theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
					theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
					theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
			
					// Example content CSS (should be your site CSS)
					content_css : "css/content.css",
			
					// Drop lists for link/image/media/template dialogs
					template_external_list_url : "lists/template_list.js",
					external_link_list_url : "lists/link_list.js",
					external_image_list_url : "lists/image_list.js",
					media_external_list_url : "lists/media_list.js",
			
					// Style formats
					style_formats : [
						{title : 'Bold text', inline : 'b'},
						{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
						{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
						{title : 'Example 1', inline : 'span', classes : 'example1'},
						{title : 'Example 2', inline : 'span', classes : 'example2'},
						{title : 'Table styles'},
						{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
					],
			
					// Replace values for the template plugin
					template_replace_values : {
						username : "Some User",
						staffid : "991234"
					}
				});
			</script>
			<textarea rows="15" cols="50" name="value"><?php echo $page['value']; ?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="operation_save" value="Salveaza">
			<input type="reset" value="Anuleaza">
		</td>
	</tr>
</table>
</form>
<?php 	
	}
}
?>