<?php
session_start();
require_once 'functions.php';
$loginData = json_decode(file_get_contents('config/login.json'), true);

$jsonFile = 'config.json';
$pageId = isset($_GET['page_id']) ? $_GET['page_id'] : null;
$pageTitle = $pageId ? getPageTitle($pageId, $jsonFile) : 'Contact';

echo "<header>
<h1>" . $loginData['nom'] . " " .$loginData['prenom'] . "</h1>
<h2>$pageTitle</h2>
</header>";

echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>
