<?php

/*
 * @param $file
 * filename of a pic to be resized
 * 
 * @param $folder
 * foldername of the file to be proccessed
 * 
 * @img_prop
 * getimagesize() of a file to be processed
 * 
 */

function resize($file, $folder, $img_prop) {
    // getfile name
    $filename = pathinfo($folder . $file, PATHINFO_FILENAME);
    // get width and height of the original image
    $width = $img_prop[0];
    $height = $img_prop[1];
    // create a func for different types of files to create image
    $ext = image_type_to_extension($img_prop[2], false);
    $image_create_func = "imagecreatefrom" . $ext;
    if (!function_exists($image_create_func)) {
        die("$image_create_func exists");
    }
    $image_save_func = "image" . $ext;
    if (!function_exists($image_save_func)) {
        die("$image_save_func exists");
    }
    // define new width and height according to maximums
    if ($height >= MAX_H) {
        $factor = MAX_H / $height;
        $new_height = MAX_H;
        $new_width = floor($width * $factor);
    } else if ($width >= MAX_W) {
        $factor = MAX_W / $width;
        $new_width = MAX_W;
        $new_height = floor($height * $factor);
    }
    $new_size = [$new_width, $new_height];
    // create new image from file
    $image_src = $image_create_func($file);
    // create new truecolor image
    $image_layer = imagecreatetruecolor($new_size[0], $new_size[1]);
    // copy and chnage image size with resampling
    imagecopyresampled($image_layer, $image_src, 0, 0, 0, 0, $new_size[0], $new_size[1], $width, $height);
    $resizedImageName = $folder . $filename . '_resize.' . $ext;
    // output image to file
    imagejpeg($image_layer, $resizedImageName, 100);
    return $resizedImageName;
}
