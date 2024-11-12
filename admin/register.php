<?php
require_once('functions.php');
registerUser();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1ère connexion ! Inscription</title>
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <form method="POST">
        <label for="username">Identifiant</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required><br>
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" required><br>       
         <label for="email">e-mail</label>
        <input type="email" id="email" name="email" required><br>
        <div class="rs">
            <label for="RS">Vos réseaux sociaux : </label><br>
            <div class="rs_item">
                <label for="twitter">Twitter</label>
                <input type="checkbox" name="twitter" id="twitter" onclick="toggleInput('link_twitter')">
                <input type="text" id="link_twitter" name="link_twitter" class="link" placeholder="Identifiant Twitter" disabled><br>
            </div>
            <div class="rs_item">
                <label for="facebook">Facebook</label>
                <input type="checkbox" name="facebook" id="facebook" onclick="toggleInput('link_facebook')">
                <input type="text" id="link_facebook" name="link_facebook" class="link" placeholder="Identifiant Facebook" disabled><br>
            </div>
            <div class="rs_item">
                <label for="instagram">Instagram</label>
                <input type="checkbox" name="instagram" id="instagram" onclick="toggleInput('link_instagram')">
                <input type="text" id="link_instagram" name="link_instagram" class="link" placeholder="Identifiant Instagram" disabled><br>
            </div>
            <div class="rs_item">
                <label for="linkedin">Linkedin</label>
                <input type="checkbox" name="linkedin" id="linkedin" onclick="toggleInput('link_linkedin')">
                <input type="text" id="link_linkedin" name="link_linkedin" class="link" placeholder="Identifiant LinkedIn" disabled><br>
            </div>
        </div>
        <label for="tel">Votre numéro de télèphone</label>
        <input type="tel" name="tel" id="tel" required placeholder="00 01 02 03 04"><br>
        <label for="adresse">Votre adresse :</label>
        <input type="text" id="adresse" name="adresse" required><br>
        <label for="code_postal">Votre code postal :</label>
        <input type="text" id="code_postal" name="code_postal" required><br>
        <label for="ville">Votre ville :</label>
        <input type="text" id="ville" name="ville" required><br>
        <label for="pays">Votre pays :</label>
        <input type="text" id="pays" name="pays" required><br>
        <button type="submit">Connexion</button>
    </form>

    <script>
        function toggleInput(inputId) {
            const input = document.getElementById(inputId);
            input.disabled = !input.disabled;
            if (input.disabled) {
                input.value = '';
            }
        }
    </script>
</body>

</html>
