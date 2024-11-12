<?php
require('auth.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="css/settings.css">
</head>

<body>
    <button><a href="pages.php">Toutes les pages</a></button>
    <button><a href="show_svg.php">Gerer les SVG</a></button>


    <div class="overlay" id="overlay">  </div>
   
    <div class="settings" id="modal">
        <img src="../img/settings.svg" id="btnOpen" alt="settings">
        <ul>
            <li><a href="settings.php">Paramètre</a></li>
        </ul>
    </div>



    <script src="js/settings.js"></script>
</body>

</html>