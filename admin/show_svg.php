<?php
require('auth.php');
require('functions.php');


//verifier si c'est un envois de fichier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['svgFile'])) {
    $result = addSVG($_FILES['svgFile']);
    if ($result !== true) {
        echo '<p>' . $result . '</p>';
    } else {
        header('Location: show_svg.php');
        exit;
    }
}
// verifier si c'est une suppression de fichier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_filename'])) {
    $filename = $_POST['delete_filename'];
    $result = deleteSVG($filename);
    if ($result !== true) {
        echo '<p>' . $result . '</p>';
    } else {
        header('Location: show_svg.php');
        exit;
    }
}
//verifier si c'est un changement de nom pour un fichier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['oldFilename'], $_POST['newFilename'])) {
    $oldFilename = $_POST['oldFilename'];
    $newFilename = $_POST['newFilename'];
    $result = renameSVG($oldFilename, $newFilename);
    if ($result !== true) {
        echo '<p>' . $result . '</p>';
    } else {
        header('Location: show_svg.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Afficher les SVG</title>
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/svg.css">
</head>

<body>

    <h1>Liste des fichiers SVG</h1>
    <div class="svg-container">
        <?php
        $svgDirectory = '../img/';
        if (is_dir($svgDirectory)) {
            $dirHandle = opendir($svgDirectory);
            while (($file = readdir($dirHandle)) !== false) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'svg') {
                    $sansExtension = pathinfo($file, PATHINFO_FILENAME);
                    echo '<div class="svg-item">';
                    echo '<img src="' . $svgDirectory . $file . '" alt="' . $sansExtension . '">';
                    echo '<p>' . $sansExtension . '</p>';
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="delete_filename" value="' . $file . '">';
                    echo '<button class="delete-btn" type="submit">X</button>';
                    echo '</form>';
                    echo '<img class="edit-svg-icon" src="../img/edit.svg" alt="Modifier" data-filename="' . $file . '">';
                    echo '</div>';
                }
            }
            closedir($dirHandle);
        } else {
            echo '<p>Aucun fichier SVG trouvé.</p>';
        }
        ?>
    </div>

    <div class="modalSvg">
        <div class="overlay"></div>
        <div class="modal-item">
            <form id="uploadForm" action="" method="POST" enctype="multipart/form-data">
                <label for="svgFile">Choisissez un fichier SVG :</label>
                <input type="file" id="svgFile" name="svgFile" accept=".svg" required>
                <br>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </div>

    <div class="modalEditSvg">
        <div class="overlayEdit"></div>
        <div class="modal-item">
            <form id="renameForm" action="" method="POST">
                <input type="hidden" id="oldFilename" name="oldFilename">
                <input type="text" id="newFilename" name="newFilename" placeholder="Nouveau nom du SVG" required>
                <br>
                <button type="submit">Renommer</button>
                <p id="renameMessage"></p>
            </form>
        </div>
    </div>

    <div class="modal">
        <div class="modal-item">
            <img id="addBtn" src="../img/icons/add.svg" alt="Ajout SVG"><br><br>
            <a href="main.php"><img src="../img/icons/home.svg" alt="Retour au menu principal"></a>
        </div>
    </div>

    <script src="js/modal.js"></script>
</body>

</html>
