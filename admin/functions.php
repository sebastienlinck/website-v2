<?php


//Fonctions pour les sauvegardes :

function registerUser()
{
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $code_postal = $_POST['code_postal'];
        $ville = $_POST['ville'];
        $pays = $_POST['pays'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];

        $twitter = isset($_POST['twitter']) ? $_POST['link_twitter'] : false;
        $facebook = isset($_POST['facebook']) ? $_POST['link_facebook'] : false;
        $instagram = isset($_POST['instagram']) ? $_POST['link_instagram'] : false;
        $linkedin = isset($_POST['linkedin']) ? $_POST['link_linkedin'] : false;

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $userData = [
            'username' => $username,
            'password' => $hashed_password,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'adresse' => $adresse,
            'code_postal' => $code_postal,
            'ville' => $ville,
            'pays' => $pays,
            'tel' => $tel,
            'twitter' => $twitter,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'linkedin' => $linkedin
        ];

        $jsonData = json_encode($userData, JSON_PRETTY_PRINT);

        file_put_contents('config/login.json', $jsonData);

        header('Location: login.php');
        exit;
    }
}



function updateUserInfo()
{
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $loginData = json_decode(file_get_contents('config/login.json'), true);

        $loginData['username'] = $_POST['username'];
        if (!empty($_POST['password']) && $_POST['password'] === $_POST['password2']) {
            $loginData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
        $loginData['nom'] = $_POST['nom'];
        $loginData['prenom'] = $_POST['prenom'];
        $loginData['adresse'] = $_POST['adresse'];
        $loginData['tel'] = $_POST['tel'];
        $loginData['email'] = $_POST['email'];
        $loginData['ville'] = $_POST['ville'];
        $loginData['code_postal'] = $_POST['code_postal'];
        $loginData['pays'] = $_POST['pays'];

        $loginData['twitter'] = isset($_POST['twitter_checkbox']) ? $_POST['twitter'] : false;
        $loginData['facebook'] = isset($_POST['facebook_checkbox']) ? $_POST['facebook'] : false;
        $loginData['instagram'] = isset($_POST['instagram_checkbox']) ? $_POST['instagram'] : false;
        $loginData['linkedin'] = isset($_POST['linkedin_checkbox']) ? $_POST['linkedin'] : false;

        file_put_contents('config/login.json', json_encode($loginData, JSON_PRETTY_PRINT));
        $_SESSION['username'] = $loginData['username'];
        $_SESSION['nom'] = $loginData['nom'];
        $_SESSION['prenom'] = $loginData['prenom'];
        $_SESSION['adresse'] = $loginData['adresse'];
        $_SESSION['code_postal'] = $loginData['code_postal'];
        $_SESSION['ville'] = $loginData['ville'];
        $_SESSION['pays'] = $loginData['pays'];

        header('Location: login.php');
        exit;
    }
}
function savePageConfig($postData) {
    $pageId = isset($postData['page_id']) && !empty($postData['page_id']) ? $postData['page_id'] : uniqid();
    $pageName = isset($postData['page_name']) ? preg_replace('/[^a-zA-Z0-9-_ ]/', '', $postData['page_name']) : '';
    $sections = isset($postData['sections']) ? array_values($postData['sections']) : [];

    $pages = file_exists('config.json') ? json_decode(file_get_contents('config.json'), true) : [];

    $pageKey = false;
    foreach ($pages as $key => $page) {
        if ($page['id'] === $pageId) {
            $pageKey = $key;
            break;
        }
    }

    foreach ($sections as &$section) {
        if (!isset($section['id']) || empty($section['id'])) {
            $section['id'] = uniqid();
        }
    }

    if ($pageKey === false) {
        $pages[] = [
            'id' => $pageId,
            'name' => $pageName,
            'sections' => $sections
        ];
    } else {
        $pages[$pageKey]['name'] = $pageName;
        $pages[$pageKey]['sections'] = $sections;
    }

    file_put_contents('config.json', json_encode($pages, JSON_PRETTY_PRINT));
}

//Fonction pour les pages



function readPages() {
    if (file_exists('config.json')) {
        return json_decode(file_get_contents('config.json'), true);
    }
    return [];
}

function writePages($pages) {
    file_put_contents('config.json', json_encode($pages, JSON_PRETTY_PRINT));
}

function updateOrder()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (file_exists('config.json')) {
            $pages = json_decode(file_get_contents('config.json'), true);
            usort($pages, function ($a, $b) use ($data) {
                $orderA = array_search($a['id'], array_column($data, 'id'));
                $orderB = array_search($b['id'], array_column($data, 'id'));
                return $orderA <=> $orderB;
            });

            file_put_contents('config.json', json_encode($pages, JSON_PRETTY_PRINT));
        } else {
            echo 'Fichier config.json introuvable.';
        }
    } else {
        echo 'Méthode non autorisée.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateOrder();
}


function savePage()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pageId = isset($_POST['page_id']) && !empty($_POST['page_id']) ? $_POST['page_id'] : uniqid();
        $pageName = isset($_POST['page_name']) ? preg_replace('/[^a-zA-Z0-9-_ ]/', '', $_POST['page_name']) : '';
        $sections = isset($_POST['sections']) ? array_values($_POST['sections']) : [];

        $pages = file_exists('config.json') ? json_decode(file_get_contents('config.json'), true) : [];

        $pageKey = false;
        foreach ($pages as $key => $page) {
            if ($page['id'] === $pageId) {
                $pageKey = $key;
                break;
            }
        }

        foreach ($sections as &$section) {
            if (!isset($section['id']) || empty($section['id'])) {
                $section['id'] = uniqid();
            }
        }

        if ($pageKey === false) {
            $pages[] = [
                'id' => $pageId,
                'name' => $pageName,
                'sections' => $sections
            ];
        } else {
            $pages[$pageKey]['name'] = $pageName;
            $pages[$pageKey]['sections'] = $sections;
        }

        file_put_contents('config.json', json_encode($pages, JSON_PRETTY_PRINT));
        header('Location: pages.php');
        //ou sur la page même: header('Location: edit_page.php?page_id=' . $pageId);
        exit();
    }
}


function getPageTitle($pageId, $jsonFile) {
    if (file_exists($jsonFile)) {
        $pages = json_decode(file_get_contents($jsonFile), true);
        $page = array_filter($pages, function ($p) use ($pageId) {
            return $p['id'] === $pageId;
        });
        if (!empty($page)) {
            $page = array_values($page)[0];
            return htmlspecialchars($page['name']);
        } else {
            return 'Page non trouvée';
        }
    } else {
        return 'Contact';
    }
}


function deletePage($pageId) {
    $pages = file_exists('config.json') ? json_decode(file_get_contents('config.json'), true) : [];

    foreach ($pages as $key => $page) {
        if ($page['id'] === $pageId) {
            unset($pages[$key]);
            break;
        }
    }

    $pages = array_values($pages);
    file_put_contents('config.json', json_encode($pages, JSON_PRETTY_PRINT));
}



//Fonction pour les SVGs



function renameSVG($oldFilename, $newFilename)
{
    $svgDirectory = '../img/';

    if (file_exists($svgDirectory . $oldFilename)) {
        if (is_writable($svgDirectory . $oldFilename)) {
            if (rename($svgDirectory . $oldFilename, $svgDirectory . $newFilename . '.svg')) {
                return true;
            } else {
            }
        } else {
        }
    } else {
    }
}

function deleteSVG($filename)
{
    $svgDirectory = '../img/';
    $filePath = $svgDirectory . $filename;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            return true;
        } else {
        }
    } else {
    }
}

function addSVG($file)
{
    $uploadDir = '../img/';
    $fileTmpPath = $file['tmp_name'];
    $fileName = basename($file['name']);
    $fileType = $file['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $allowedfileExtensions = array('svg');

    if (in_array($fileExtension, $allowedfileExtensions)) {
        $dest_path = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            return true;
        } else {
            echo "Erreur lors de l'ajout.";
        }
    } else {
        echo 'Extension non valable.';
    }
}

//contact page 


function getLoginData() {
    return json_decode(file_get_contents('config/login.json'), true);
}

function getAddress($loginData) {
    return $loginData['adresse'] . ' ' . $loginData['code_postal'] . ' ' . $loginData['ville'] . ' ' . $loginData['pays'];
}

function getSocialLink($loginData, $platform) {
    return isset($loginData[$platform]) && !empty($loginData[$platform]) ? $loginData[$platform] : null;
}

?>

