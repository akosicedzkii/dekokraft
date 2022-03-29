<?php

foreach (glob("C:\\xampp\\htdocs\\dekokraft\\uploads\\product_variants\\*.*") as $filename) {
    
     $destination_img = "C:\\xampp\\htdocs\\dekokraft\\uploads\\product_variants\\thumb\\".basename($filename);
        
    $im = imagecreatefrompng($filename);
    $source_width = imagesx($im);
    $source_height = imagesy($im);
    $ratio =  $source_height / $source_width;

    $new_width = 300; // assign new width to new resized image
    $new_height = $ratio * 300;

    $thumb = imagecreatetruecolor($new_width, $new_height);

    $transparency = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
    imagefilledrectangle($thumb, 0, 0, $new_width, $new_height, $transparency);

    imagecopyresampled($thumb, $im, 0, 0, 0, 0, $new_width, $new_height, $source_width, $source_height);

    imagepng($thumb, $destination_img, 9);
    imagedestroy($im);
}



?>