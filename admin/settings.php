<?php
require('auth.php');
require('functions.php');

session_start();

$loginData = json_decode(file_get_contents('config/login.json'), true);

updateUserInfo();
?>
<!DOCTYPE html>
<html lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de vos informations</title>
    <style>
        .social-input {
            display: none;
        }
    </style>
</head>

<body>

    <h1>Changement de vos informations</h1>
    <form method="post">
        <label for="username">Identifiant</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($loginData['username']); ?>" required><br>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password"><br>
        <label for="password2">Confirmez le mot de passe</label>
        <input type="password" name="password2" id="password2"><br>

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($loginData['nom']); ?>" required><br>

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($loginData['prenom']); ?>" required><br>

        <label for="adresse">Adresse</label>
        <input type="text" name="adresse" id="adresse" value="<?php echo htmlspecialchars($loginData['adresse']); ?>" required><br>

        <label for="tel">Téléphone</label>
        <input type="text" name="tel" id="tel" value="<?php echo htmlspecialchars($loginData['tel']); ?>" required><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($loginData['email']); ?>" required><br>

        <label for="ville">Ville</label>
        <input type="text" name="ville" id="ville" value="<?php echo htmlspecialchars($loginData['ville']); ?>" required><br>

        <label for="code_postal">Code postal</label>
        <input type="text" name="code_postal" id="code_postal" value="<?php echo htmlspecialchars($loginData['code_postal']); ?>" required><br>

        <label for="pays">Pays</label>
        <input type="text" name="pays" id="pays" value="<?php echo htmlspecialchars($loginData['pays']); ?>" required><br>

        <div class="rs">
            <div>
                <label for="twitter_checkbox">Twitter</label>
                <input type="checkbox" name="twitter_checkbox" id="twitter_checkbox" <?php echo $loginData['twitter'] ? 'checked' : ''; ?>>
                <input type="text" name="twitter" id="twitter" class="social-input" value="<?php echo htmlspecialchars($loginData['twitter'] !== false ? $loginData['twitter'] : ''); ?>">
            </div>

            <div>
                <label for="facebook_checkbox">Facebook</label>
                <input type="checkbox" name="facebook_checkbox" id="facebook_checkbox" <?php echo $loginData['facebook'] ? 'checked' : ''; ?>>
                <input type="text" name="facebook" id="facebook" class="social-input" value="<?php echo htmlspecialchars($loginData['facebook'] !== false ? $loginData['facebook'] : ''); ?>">
            </div>

            <div>
                <label for="instagram_checkbox">Instagram</label>
                <input type="checkbox" name="instagram_checkbox" id="instagram_checkbox" <?php echo $loginData['instagram'] ? 'checked' : ''; ?>>
                <input type="text" name="instagram" id="instagram" class="social-input" value="<?php echo htmlspecialchars($loginData['instagram'] !== false ? $loginData['instagram'] : ''); ?>">
            </div>

            <div>
                <label for="linkedin_checkbox">LinkedIn</label>
                <input type="checkbox" name="linkedin_checkbox" id="linkedin_checkbox" <?php echo $loginData['linkedin'] ? 'checked' : ''; ?>>
                <input type="text" name="linkedin" id="linkedin" class="social-input" value="<?php echo htmlspecialchars($loginData['linkedin'] !== false ? $loginData['linkedin'] : ''); ?>">
            </div>
        </div>

        <input type="submit" value="Enregistrer">
    </form>

    <a href="main.php">Retour au menu principal</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function toggleSocialInput(checkboxId, inputId) {
                const checkbox = document.getElementById(checkboxId);
                const input = document.getElementById(inputId);
                input.style.display = checkbox.checked ? 'block' : 'none';
                checkbox.addEventListener('change', function() {
                    input.style.display = checkbox.checked ? 'block' : 'none';
                });
            }
            toggleSocialInput('twitter_checkbox', 'twitter');
            toggleSocialInput('facebook_checkbox', 'facebook');
            toggleSocialInput('instagram_checkbox', 'instagram');
            toggleSocialInput('linkedin_checkbox', 'linkedin');
        });
    </script>

</body>

</html>