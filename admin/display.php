<?php
require('auth.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>
        <?php
        if (isset($_GET['page_id']) && file_exists('config.json')) {
            $pageId = $_GET['page_id'];
            $pages = json_decode(file_get_contents('config.json'), true);
            $page = array_filter($pages, function ($p) use ($pageId) {
                return $p['id'] === $pageId;
            });
            if (!empty($page)) {
                $page = array_values($page)[0];
                echo htmlspecialchars($page['name']);
            } else {
                echo 'Page non trouvée';
            }
        } else {
            echo 'Affichage des pages';
        }
        ?>
    </title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <?php include('navbar.php') ?>
    <?php include('header.php') ?>

    <?php
    if (isset($_GET['page_id']) && file_exists('config.json')) {
        $pageId = $_GET['page_id'];
        $pages = json_decode(file_get_contents('config.json'), true);
        $page = array_filter($pages, function ($p) use ($pageId) {
            return $p['id'] === $pageId;
        });

        if (!empty($page)) {
            $page = array_values($page)[0];

            foreach ($page['sections'] as $section) {
                $h3 = htmlspecialchars($section['h3']);
                $h4 = htmlspecialchars($section['h4']);
                $p = htmlspecialchars($section['p']);
                $svg = htmlspecialchars($section['svg']);
                echo "<section>
                        <article>
                            <h3>$h3</h3>
                            <h4>$h4</h4>
                            <p>$p</p>
                        </article>
                        <article>
                            <img src='$svg' alt='SVG Image'>
                        </article>
                      </section>";
            }
        } else {
            echo '<p>Page non trouvée.</p>';
        }
    } else {
        echo '<p>Aucune page spécifiée ou fichier de configuration introuvable.</p>';
    }
    ?>


    <?php include('footer.php') ?>

</body>

</html>