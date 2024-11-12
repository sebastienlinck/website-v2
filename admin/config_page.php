<?php
require('auth.php');
require('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    savePageConfig($_POST);
    header('Location: pages.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Création de la page</title>
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/section.css">

    <script>
        function addSection(h3 = '', h4 = '', p = '', svg = '../img/hastag.svg') {
            const sectionContainer = document.getElementById('sections');
            const sectionCount = sectionContainer.children.length;
            const newSection = document.createElement('div');
            newSection.className = 'section';
            newSection.innerHTML = `
    <h2>Section ${sectionCount + 1}</h2>
        <input type="text" id="h3_${sectionCount}" name="sections[${sectionCount}][h3]" value="${h3}" placeholder="Titre de la section."><br>
        <input type="text" id="h4_${sectionCount}" name="sections[${sectionCount}][h4]" value="${h4}"  placeholder="Sous-titre de la section."><br>
        <textarea id="p_${sectionCount}" name="sections[${sectionCount}][p]" placeholder="Contenu de la section.">${p}</textarea><br>
        <select id="svg_${sectionCount}" name="sections[${sectionCount}][svg]">

                <?php
                $svgDirectory = '../img/';

                if (is_dir($svgDirectory)) {
                    $dirHandle = opendir($svgDirectory);
                    while (($file = readdir($dirHandle)) !== false) {
                        if (pathinfo($file, PATHINFO_EXTENSION) === 'svg') {
                            $sansExtension = pathinfo($file, PATHINFO_FILENAME);
                            echo '<option value="' . $svgDirectory . $file . '" alt="' . $sansExtension . '">';
                            echo  $sansExtension . '</option>';
                        }
                    }
                    closedir($dirHandle);
                } else {
                    echo '<p>Aucun fichier SVG trouvé.</p>';
                }
                ?>
                </select><br>
                <img class="move-up small" src="../img/icons/up_arrow.svg" onclick="sectionPlus(this.parentElement)">
                <img class="delete small" src="../img/icons/bin.svg" onclick="removeSection(this)">
                <img class="move-down small" src="../img/icons/down_arrow.svg"onclick="sectionMoins(this.parentElement)">
                `;
            sectionContainer.appendChild(newSection);
        }
    </script>
</head>

<body>
    <form action="" method="POST">
        <div id="sections"></div>
        <div class="modal">
            <div class="modal-item">
                <input type="text" id="page_name" name="page_name" placeholder="Titre de la page" required><br><br>
            </div>
            <div class="modal-item">
                <img onclick="addSection()" src="../img/icons/add.svg" alt="Ajout Section"><br><br>
                <input type="hidden" name="page_id" id="page_id" value="">
                <input type="image" src="../img/icons/save.svg" alt="Submit" />
                <a href="pages.php"><img src="../img/icons/back.svg" alt="Retour à la gestion des pages"></a>
                <a href="main.php"><img src="../img/icons/home.svg" alt="Retour au menu principal"></a>
            </div>
        </div>
    </form>
</body>

</html>