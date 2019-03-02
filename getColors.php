<?php

/*
 * @param $imageFile
 * image file name
 * 
 * @param $numColors
 * how many most popular color you want to get
 * 
 * @param $px
 * each $px to be checked which color it is
 * 
 */

function getColors($imageFile, $numColors) {
    // this array will hold all RGB values of each px
    $colors = [];
    // get image size
    $size = getimagesize($imageFile);
    if (!$size) {
        die("Unable to get image size data");
    }
    // create imagecreatefrom% function for different types of files
    $ext = image_type_to_extension($size[2], false);
    $image_create_func = "imagecreatefrom" . $ext;
    if (!function_exists($image_create_func)) {
        die("$image_create_func exists");
    }
    // open file to work with
    $img = $image_create_func($imageFile);
    if (!$img) {
        die("Unable to open image file");
    }

    // iterate pixels in the pic and get its color and put it in $colors
    for ($x = 1; $x < $size[0]; $x += 500) {
        for ($y = 1; $y < $size[1]; $y+=100) {
            $thisColor = imagecolorat($img, $x, $y);
            $colors[] = $thisColor;
        }
    }


    // get number of times that the color was used
    $repeated_colors = array_count_values($colors);
    // get array of colors (px index on the image)
    $repeated_colors = array_keys($repeated_colors);
    // get array of 3 mostly used colors (px index on the image)
    $repeated_colors = array_slice($repeated_colors, 0, $numColors);
    // get rgb of those pxs
    $rgbColors = [];
    for ($i = 0; $i < count($repeated_colors); $i++) {
        $rgbColors[] = imagecolorsforindex($img, $repeated_colors[$i]);
    }


    return $rgbColors;
}
