<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Auto enchere</title>
    <link rel="stylesheet" href="style_connexion.css">
</head>
<header>

    <a href="index.php"><img src="images/logo.png" alt="" class="logo" /></a>
    <a href="index.php"><img src="images/logo_text.png" alt="" class="logo_text" /></a>

    <nav>
        <?php if (isset($_SESSION["user_id"])) { ?>
            <a href="edit_profil.php"> <button> Modifier votre profil </button> </a>
            <a href="deconnexion.php"><button> Déconnexion </button></a>

        <?php } else { ?>
            <a href="connexion.php"> <button> Connexion </button> </a>
            <a href="inscription.php"> <button> Inscription </button> </a>
        <?php } ?>

    </nav>

</header>

<body>

    <h1>Site Auto Enchere</h1>


    <form action="" method="POST">

        <label for="email">Entrez votre email :</label>
        <input type="email" name="email" value="" id="email">

        <br />

        <label for="password">Votre mot de passe :</label>
        <input type="password" name="password" value="" id="password">

        <br />

        <input type="submit" value="connectez vous" />
    </form>

</body>

</html>







<?php

$data_base = new PDO("mysql:dbname=auto_enchere;host=127.0.0.1", "root", "");




if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $requete = $data_base->prepare('SELECT * FROM user WHERE email= ?');
    $requete->execute([$email]);
    $user = $requete->fetch();

    if (!$user) {
        header('Location: inscription.php');
    } else if (password_verify($password, $user['password'])) {
        // Si user est trouvé et que le mot de passe saisi correspond au hash du mot de passe de l'utilisateur
        $_SESSION['user_id'] = $user["id"];
        $_SESSION['user_firstname'] = $user["prenom"];
        header('Location: index.php');
    } else {
        // Si user est trouvé mais que le mot de passe est incorrect
        echo "<p>Email ou mot de passe incorrect</p>";
    }
}
?>