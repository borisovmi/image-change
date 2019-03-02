<?php

/*
 * function checkFlag
 * Returns boolean $upload_flag
 * 
 * @param $upload_flag 
 * flag to be changed, boolean value
 * 
 * @param $dest_file
 * filename to be checked
 * 
 * @param $tmp_file
 * temp filename to be checked
 * 
 * @param $input_name
 * name from a html form send by post
 * 
 */

function checkFlag($upload_flag, $tmp_file, $dest_file, $input_name) {
    $upload_flag = true;
    $img_prop = getimagesize($tmp_file);
    // check if the file already exists
    if (file_exists($dest_file)) {
        echo "<br>Sorry, file already exists.<br>";
        $upload_flag = false;
    }
    // check image size (15MB)
    if ($_FILES[$input_name]["size"] > 15000000) {
        echo "<br>Sorry, your file is too large.<br>";
        $upload_flag = false;
    }
    // check extension and mimetype
    if (image_type_to_extension($img_prop[2]) != ".jpg" && image_type_to_extension($img_prop[2]) != ".jpeg") {
        echo "<br>Sorry, only JPG or JPEG files are allowed.<br>";
        $upload_flag = false;
    }
    if (image_type_to_mime_type($img_prop[2]) != 'image/jpg' && image_type_to_mime_type($img_prop[2]) != 'image/jpeg') {
        echo "<br>Sorry, only JPG or JPEG mimes are allowed.<br>";
        $upload_flag = false;
    }
    return $upload_flag;
}
