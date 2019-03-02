<?php
session_name("pics");
session_start();
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
    <body>
        <p>The following form will resize the uploaded image according to max size of 1024x768.</p>
        <p>It will also output the result image and tell you what are the 5 mostly use colors in the image.</p>
        <form method="POST" action="controller.php" enctype="multipart/form-data">  
            <label for="image">Choose an image to process</label>
            <br>
            <input type="file" name="image" id="image">
            <br><br>
            <input type="submit" name="submit" value="Process image">
        </form>
    </body>
</html>







