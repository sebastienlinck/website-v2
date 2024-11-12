<?php
require('auth.php');
require('functions.php');
session_start();

$loginData = getLoginData();
$address = getAddress($loginData);
$linkTwitter = getSocialLink($loginData, 'twitter');
$linkFacebook = getSocialLink($loginData, 'facebook');
$linkInstagram = getSocialLink($loginData, 'instagram');
$linkLinkedin = getSocialLink($loginData, 'linkedin');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/contact.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="js/fonctions.js"></script>
</head>

<body>
    <?php include('navbar.php'); ?>
    <?php include('header.php'); ?>

    <div class="container">
    </div>

    <form id="addressForm">
        <input type="hidden" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>">
    </form>

    
    <div id="map"></div>
  
    <script>
        afficherCarte("<?php echo htmlspecialchars($address); ?>");
    </script>

    <div class="RS">
        <?php if ($linkTwitter) : ?>
            <a href="https://twitter.com/<?php echo htmlspecialchars($linkTwitter); ?>" target="_blank"><img class="small" src="../img/icons/twitter.svg" alt="Twitter"></a>
        <?php endif; ?>

        <?php if ($linkFacebook) : ?>
            <a href="https://www.facebook.com/<?php echo htmlspecialchars($linkFacebook); ?>" target="_blank"><img class="small" src="../img/icons/facebook.svg" alt="Facebook"></a>
        <?php endif; ?>

        <?php if ($linkInstagram) : ?>
            <a href="https://www.instagram.com/<?php echo htmlspecialchars($linkInstagram); ?>" target="_blank"><img class="small" src="../img/icons/instagram.svg" alt="Instagram"></a>
        <?php endif; ?>

        <?php if ($linkLinkedin) : ?>
            <a href="https://www.linkedin.com/in/<?php echo htmlspecialchars($linkLinkedin); ?>" target="_blank"><img class="small" src="../img/icons/linkedin.svg" alt="LinkedIn"></a>
        <?php endif; ?>
    </div>

    <?php include('footer.php'); ?>

</body>

</html>