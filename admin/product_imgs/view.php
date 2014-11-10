<form action="" method="post">
	<input type="hidden" name="menu" value="<?php echo $menu_id; ?>" />
	<input type="hidden" name="action" value="products" /> 
	<input type="submit" name="operation_submenu" value="Inapoi la produs" />
</form>
<h2> Imagine principala </h2>

<img src="<?php echo "../images/". $product_id . "_150_150.jpg"; ?>" alt="Fara imagine" height="150" width="150">

<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="product" value="<?php echo $product_id; ?>" />
	<input type="hidden" name="action" value="product_imgs" /> 
	<input type="file" name="file">
	<input type="submit" name="operation_setMain" value="Salveaza" />
</form>

<h2> Imagini secundare </h2>
<?php
?>
<table style="padding: 0px;	border-spacing: 0px; width: 800px;">
    <tr style="background-color: yellow">
        <td style="width: 100px;">Nume
        </td>
        <td>
        </td>
    </tr>
    <?php
    foreach ($detailImages as $detailImage) {
        if ($detailImage == '.' || $detailImage == '..') {
            continue;
        }
        ?>
        <tr>
            <td>
                <img src="<?php echo "../images/". $product_id . "/" . $detailImage; ?>" alt="Fara imagine" height="30" width="30">
            </td>
            <td><?php echo $detailImage?></td>
            <td>
                <form action="" method="post" style="float: left">
                    <input type="hidden" name="product" value="<?php echo $product_id; ?>" />
                    <input type="hidden" name="action" value="product_imgs" />
                    <input type="hidden" name="image" value="<?php echo $detailImage?>" />
                    <input type="submit" name="operation_delete" value="Sterge" />
                </form>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<h3> Adauga imagine secundara </h3>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="product" value="<?php echo $product_id; ?>" />
    <input type="hidden" name="action" value="product_imgs" />
    <input type="file" name="file">
    <input type="submit" name="operation_addDetail" value="Adauga" />
</form>

