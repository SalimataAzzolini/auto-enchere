<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <title> Auto enchere </title>
    <link rel="stylesheet" href="style/style_index.css">
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

            <?php
            if (isset($_SESSION["user_firstname"])) {
            ?> <p> Bienvenue <?php echo $_SESSION["user_firstname"]; ?>, vous êtes connecté(e) </p>
            <?php } //else {
            //header('Location: inscription.php');
            //} 
            ?>
        </nav>

    </header>




    <div class="corps_page">

        <a href="annonce.php"> <button class="voir_annonce"> Voir les annonces</button> </a>

        <div class="div_form">

            <h3 class="titre"> DEPOSER VOTRE ANNONCE </h3>

            <form action="insert.php" method="POST" class="form-container">

                <label for="prix"> Prix de réserve : </label>
                <input type="number" name="prix" id="prix">

                <label for="date"> Date fin enchère : </label>
                <input type="date" name="date" id="date"> <br>

                <label for="modele"> Modèle : </label>
                <input type="text" name="modele" id="modele">

                <label for="marque"> Marque : </label>
                <input type="text" name="marque" id="marque"> <br>

                <label for="puissance"> Puissance : </label>
                <input type="text" name="puissance" id="puissance">

                <label for="annee"> Année : </label>
                <input type="number" name="annee" id="annee"> <br>

                <label for="energie"> Energie : </label>
                <input type="text" name="energie" id="energie">

                <label for="kilometre"> Kilometres : </label>
                <input type="number" name="kilometre" id="kilometre"> <br>

                <label for="description"> Description : </label>
                <input name="description" id="description"></input> <br>

                <button> Valider </button>
            </form>
        </div>



    </div>
</body>

</html>