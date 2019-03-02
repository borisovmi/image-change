<?php

session_name("pics");
session_start();

if (!isset($_POST["submit"]) || empty($_FILES["image"]["name"])) {
    die('go back and upload any file!');
}

// define max width and height constants for output image
define('MAX_W', 1024);
define('MAX_H', 768);

require_once 'checkFlag.php';
require_once 'resize.php';
require_once 'getColors.php';

// flag that allows or not to upload and proccess the file
$upload_flag = false;
// define where to save the uploaded image
$folder = "uploads/";
// get the name of uploading file
$file = $_FILES['image']['name'];
echo "$file<br>";
// get the name temporary file on server
$tmp_file = $_FILES["image"]["tmp_name"];
echo "$tmp_file<br>";
// get the name for the image of original size that will be saved
$dest_file = $folder . $file;
echo "$dest_file<br><hr>";
// get name of input
$input_name = key($_FILES);
// check that the image is valid by using checkFlag.php
if (getimagesize($tmp_file)) {
    $upload_flag = checkFlag($upload_flag, $tmp_file, $dest_file, $input_name);
} else {
    echo "File is not an image.";
    $upload_flag = false;
}

// save uploaded file
if (!$upload_flag) {
    die("Sorry, your file was not uploaded.");
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $dest_file)) {
        echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.<br>";
        // save and show resized file, check if need to resize
        $img_prop = getimagesize($dest_file);
        if ($img_prop[0] <= MAX_W && $img_prop[1] <= MAX_W) {
            $_SESSION['newName'] = $dest_file;
        } else {
            $_SESSION['newName'] = resize($file, $folder, $img_prop);
        }
        //echo '<img src='. $_SESSION['newName'].'>';
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// get 5 mostly used colors
if (isset($_SESSION['newName']) && !empty($_SESSION['newName'])) {
    $_SESSION['colorSet'] = getColors($_SESSION['newName'], 5);
    header("location: resultView.php");
}



