<?php
function makeThumb($filename, $destination) {
    makeSizesBasedThumb($filename, $destination, 150, 150);
}

function makeSizesBasedThumb($filename, $destination, $newWidth, $newHeight) {
    $size=getimagesize($filename);
    switch($size["mime"]){
        case "image/jpeg":
            $im = imagecreatefromjpeg($filename); //jpeg file
            break;
        case "image/gif":
            $im = imagecreatefromgif($filename); //gif file
            break;
        case "image/png":
            $im = imagecreatefrompng($filename); //png file
            break;
    }

    if (isset($im)) {
        $w = imagesx($im);
        $h = imagesy($im);

        $percent = ($w > $h) ? ($newWidth / $w) : ($newHeight / $h);
        $new_w = $w * $percent;
        $new_h = $h * $percent;
        // Re sample
        $image_p = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($image_p, $im, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

        // Output
        imagejpeg($image_p, $destination, 100);
    }
}
?>
