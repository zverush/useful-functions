<?php
/**
 * Create image from format of source file
 * @author https://github.com/Newbilius/holycms3/blob/master/api/pic_resize_holy.php#L66
 */

    $parts = pathinfo($this->water_path);
    $file_type = strtolower($parts['extension']);
    $file_name = $this->water_path;

    switch ($file_type) {
        case "jpeg": case "jpg": $this->water_pic = imagecreatefromjpeg($file_name);
            break;
        case "gif": $this->water_pic = imagecreatefromgif($file_name);
            break;
        case "png": $this->water_pic = imagecreatefrompng($file_name);
            break;
        case "bmp": $this->water_pic = imagecreatefrombmp($file_name);
            break;
    };
?>