<nav>
        <ul>
            <?php
            if (file_exists('config.json')) {
                $pages = json_decode(file_get_contents('config.json'), true);
                foreach ($pages as $page) {
                    $pageId = htmlspecialchars($page['id']);
                    $pageName = htmlspecialchars($page['name']);
                    echo "<li><a href='display.php?page_id=$pageId'>$pageName</a></li>";
                }
            }
            ?>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="pages.php">Retour</a></li>
        </ul>
    </nav>