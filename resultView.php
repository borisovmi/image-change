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
        <img src="<?= $_SESSION['newName'] ?>">
        <div>
            <?php foreach ($_SESSION['colorSet'] as $color) : ?>
                <div style="width: 30px; height: 30px; background-color: <?= "rgb($color[red], $color[blue], $color[green])" ?>; display: inline-block"></div>
                <span>rgb: <?= $color['red'] . ", " . $color['blue'] . ", " . $color['green'] ?></span><br>
            <?php endforeach; ?>
        </div>
        <a href="index.php"><button>Transform another image</button> </a>
    </body>
</html>








