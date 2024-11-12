<?php
require('auth.php');
require('functions.php');

if (isset($_GET['delete_page_id'])) {
    deletePage($_GET['delete_page_id']);
    header('Location: pages.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des pages</title>
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/icons.css">
    <script src="js/fonctions.js"></script>
</head>

<body>
    <h1>Liste des pages</h1>
    <?php
    $pages = readPages();
    if (!empty($pages)) {
        echo '<ul>';
        foreach ($pages as $page) {
            echo "<li data-id='{$page['id']}'>
                    {$page['name']}
                    <a href='edit_page.php?page_id={$page['id']}'><img id='actions' src='../img/icons/edit.svg' alt='Editer'></a>
                    <a href='display.php?page_id={$page['id']}'><img id='actions' src='../img/icons/see.svg' alt='Afficher'></a>
                    <a href='pages.php?delete_page_id={$page['id']}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette page ?\")'><img id='actions' src='../img/icons/bin.svg' alt='Supprimer'></a>
                    <img class='move-up small' src='../img/icons/up_arrow.svg' onclick='pagePlus(this.parentElement)'>
                    <img class='move-down small' src='../img/icons/down_arrow.svg' onclick='pageMoins(this.parentElement)'>
                  </li>";
        }
        echo '</ul>';
    } else {
        echo '<p>Aucune page trouvée.</p>';
    }
    ?>
    <div class="modal">
        <div class="modal-item"></div>
        <div class="modal-item">
            <a href="config_page.php"><img src="../img/icons/add.svg" alt="Ajouter une page"></a><br><br>
           <img src="../img/icons/save.svg" class="small" onclick="saveOrder()">
            <a href="main.php"><img src="../img/icons/home.svg" alt="Retour au menu principal"></a>
        </div>
    </div>
</body>

</html>
