<link rel="stylesheet" href="style_detail_annoncee.css">

<?php

session_start();

$dataBase = new PDO("mysql:dbname=auto_enchere;host=localhost", "root", "root");

// on cree une variable qui permet de recupere l'id de l'annonce clique
$annonce_id = filter_var($_GET["annonce"], FILTER_SANITIZE_NUMBER_INT);

$requete = $dataBase->prepare("SELECT * FROM annonce  WHERE id=?");
$requete->execute([$annonce_id]);
$detailAnnonce = $requete->fetch();// on recupere les donnees de l'annonce

$price = $dataBase->prepare("SELECT MAX(prix_propose) FROM enchere WHERE id_annonce=?");// on recupere le prix max de l'enchere sur l'annonce
$price->execute([$annonce_id]);
$lastPrice = $price->fetch();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <title> Auto enchere</title>

    <link rel="stylesheet" href="style/style_detail_annoncee.css">

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


    <?php if ($detailAnnonce) { ?>

        <h3> L'annonce en détail :</h3>
        <div class="container_annonce">
           
            <div class="annonce">
                <p> <strong>Prix de réserve :  <?php echo $detailAnnonce["prix_depart"]; ?> </strong> €</p>
                <p>Marque : <?php echo $detailAnnonce["marque"]; ?></p>
                <p>Modèle : <?php echo $detailAnnonce["modele"]; ?></p>
                <p>Année : <?php echo $detailAnnonce["annee"]; ?></p>
                <p>Kilométrage : <?php echo $detailAnnonce["kilometre"]; ?></p>
                <p>Energie : <?php echo $detailAnnonce["energie"]; ?></p>
                <p>Puissance : <?php echo $detailAnnonce["puissance"]; ?></p>
                <p>description : <?php echo $detailAnnonce["description"]; ?></p>
                <p> Date fin des enchères : <?php echo $detailAnnonce["date_fin_annonce"]; ?></p>
                <p>Dernière enchère proposée : <?php echo $lastPrice["MAX(prix_propose)"] ?? 0; ?></p>

                <?php
                // Déclaration de la variable date qui prend la date d'aujourd'hui
                $date = date('Y-m-d');
                // On fait notre condition : si la date de fin de l'annonce et 
                //    superieur ou egal alors il peut enchérir sinon on lui met enchere terminer
                if ($detailAnnonce["date_fin_annonce"] >= $date) {

                ?> <form action="insert_enchere.php" method="POST">
                        <label for="prix_propose"> <strong> Proposer un prix</strong> </label>
                        <input type="number" id="prix_propose" name="prix_propose">

                        <input type="hidden" value=<?php echo $detailAnnonce["id"]; ?> name="id_annonce">
                        <input type="hidden" name="price" value="<?= $detailAnnonce["prix_depart"]; ?>">
                        <input type="hidden" name="detailAnnonce" value="<?= $lastPrice["MAX(prix_propose)"]; ?>">

                        <button class="button_encherir"> valider </button>

                    </form>

                <?php } else

                    echo "Fin des enchères"; ?>
                    <!-- <a href="index.php"> <button class="btn_retour_accueil">Retour à l'accueil</button></a>  -->
            </div>
            
        </div>

    <?php } else { ?>
        <div class=" title">
            <h1>Aucune annonce trouvée</h1>
        </div>

    <?php } ?>

</body>

</html>