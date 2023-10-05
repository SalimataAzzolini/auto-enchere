<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data_base = new PDO("mysql:dbname=auto_enchere;host=localhost", "root", "root");


    $marque = htmlspecialchars($_POST["marque"]);
    $modele = htmlspecialchars($_POST["modele"]);
    $annee = htmlspecialchars($_POST["annee"]);
    $kilometre = htmlspecialchars($_POST["kilometre"]);
    $energie = htmlspecialchars($_POST["energie"]);
    $puissance = htmlspecialchars($_POST["puissance"]);
    $description = htmlspecialchars($_POST["description"]);
    $date_fin_annonce = htmlspecialchars($_POST["date"]);
    $prix = htmlspecialchars($_POST["prix"]);
    // On recupere l'id user vendeur grace à la session de la personne connecté
    $id_user_vendeur = $_SESSION["user_id"];


    $requete = $data_base->prepare("INSERT INTO annonce (marque,modele,annee,kilometre,energie,puissance,
description,date_fin_annonce,prix_depart, id_user_vendeur) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $requete->execute([
        $marque, $modele, $annee, $kilometre, $energie, $puissance,
        $description, $date_fin_annonce, $prix, $id_user_vendeur
    ]);
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title> Auto Enchere</title>

</head>

<body>

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

    <div class="container">
        <img src="images/voiture_rouge.png" alt="" class="voiture_rouge">
        <p> Votre annonce est en ligne </p>
        <a href="index.php"><button> Revenir à l'accueil </button></a> <br>



    </div>



</body>

</html>




<style>
    /* style entete */

    header {
        background-color: #ffffff;
        position: fixed;
        left: 0px;
        right: 0px;
        top: 0px;
        min-height: 13vh;
        display: flex;
        justify-content: space-between;
        border-bottom: 4px solid rgb(66, 21, 21);
    }

    .logo {
        height: 12vh;
        margin-left: 20px;
    }

    .logo_text {
        height: 8vh;
        margin-top: 20px;
        margin-left: -10%;
    }

    nav {
        margin-top: 30px;
        margin-right: 15px;
    }

    nav button {
        background-color: rgb(66, 21, 21);
        color: #fff;
        padding: 7px 12px;
        border: none;
        cursor: pointer;
        border-radius: 2px;
    }

    nav button:hover {
        opacity: 0.8;
    }



    .container {
        position: fixed;
        top: 20%;
        left: 2%;
    }

    button {
        background-color: rgb(66, 21, 21);
        color: #fff;
        padding: 12px 20px;
        border: none;
        cursor: pointer;
        margin-bottom: 10px;
        border-radius: 3px;
    }

    /* Animation gauche droite */
    .voiture_rouge {
        float: right;
        width: 50%;
        margin-left: -230px;
        cursor: pointer;

    }


    .voiture_rouge {
        animation: nope 12s forwards;
    }

    @keyframes nope {
        0% {
            transform: translateX(0px);
        }

        20% {
            transform: translateX(-10px);
        }

        40% {
            transform: translateX(10px);
        }

        60% {
            transform: translateX(-10px);
        }

        80% {
            transform: translateX(10px);
        }
    }
</style>