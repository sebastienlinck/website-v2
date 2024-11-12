<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $json = file_get_contents('config/login.json');
    $userData = json_decode($json, true);

    if ($inputUsername === $userData['username'] && password_verify($inputPassword, $userData['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $userData['username'];
        $_SESSION['nom'] = $userData['nom'];
        $_SESSION['prenom'] = $userData['prenom'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['adresse'] = $userData['adresse'];
        $_SESSION['code_postal'] = $userData['code_postal'];
        $_SESSION['ville'] = $userData['ville'];
        $_SESSION['pays'] = $userData['pays'];

        header('Location: main.php');
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="post" action="login.php">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Se connecter</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>
