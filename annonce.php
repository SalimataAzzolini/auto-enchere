<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <title> Auto enchere </title>

    <link rel="stylesheet" href="style_annonces.css">
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

    <section class="section_annonce">


    </section>

</body>

</html>



<?php
// On lance notre requête vers notre base de données et on instancie un nouvel objet $dbh
$dbh = new PDO("mysql:dbname=auto_enchere;host=127.0.0.1", "root", "");

// On selectionne toutes les annonces depuis notre table annonce
$query = $dbh->query("SELECT a.*, u.prenom FROM annonce a LEFT JOIN user u ON u.id=a.id_user_vendeur");

// On recupere les annonces sous forme d'un tableau associatif et pdo::fetch pour ne pas dupliquer les cles valeurs

$annonces = $query->fetchAll(PDO::FETCH_ASSOC);

// var_dump($annonces);

?> <div class="container_annonce">
    <h2 class="titre_annonce"> LES ANNONCES DU MOMENT </h2>

    <div class="liste_annonce"> 
    <?php
    foreach ($annonces as  $annonce) { ?>
   
        <div class="annonce">
            <p> <strong> Annonce : <?php echo $annonce["id"] ?> </strong></p>
            <p> <strong> Vendu par : <?php echo $annonce["prenom"] ?> </strong></p>
            <p> Prix de réserve : <?= $annonce["prix_depart"] ?></p>
            <p> Marque : <?= $annonce["marque"]; ?></p>
            <p> Modèle : <?= $annonce["modele"]; ?></p>
            <p> Année : <?= $annonce["annee"]; ?></p>

            <a href="detail_annonce.php?annonce=<?= $annonce["id"]; ?>"> <button> En savoir plus </button> </a>
    </div>
  
    <?php } ?>

    </div>
</div>