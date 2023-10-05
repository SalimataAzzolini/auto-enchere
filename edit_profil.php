<?php
session_start();

$data_base = new PDO("mysql:dbname=auto_enchere;host=localhost", "root", "root");

if (isset($_SESSION['user_id'])) {//si l'utilisateur est connecté

    $requete = $data_base->prepare("SELECT * FROM user WHERE id = ?");
    $requete->execute([$_SESSION['user_id']]);
    $user = $requete->fetch();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {//si on a cliqué sur le bouton "mettre à jour mon profil"

        $newnom = htmlspecialchars($_POST['newnom']);
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $newemail = htmlspecialchars($_POST['newemail']);
        $mdp1 = $_POST['newmdp1'];
        $mdp2 = $_POST['newmdp2'];

        $editResult = true;


        if (isset($_POST['newnom'])) {

            $insert_nom = $data_base->prepare("UPDATE user SET nom = ? WHERE id = ?");//on prépare la requête pour modifier le nom
            $result = $insert_nom->execute([$newnom, $_SESSION['user_id']]);//on execute la requête avec le nouveau mot de passe avec l'id de l'utilisateur connecté
            $editResult = $result == false ? false : $editResult;//si la requête a échoué, on met $editResult à false
        }

        if (isset($_POST['newprenom'])) {

            $insert_prenom = $data_base->prepare("UPDATE user SET prenom = ? WHERE id = ?");
            $result = $insert_prenom->execute([$newprenom, $_SESSION['user_id']]);
            $_SESSION['user_firstname'] = $newprenom;
            $editResult = $result == false ? false : $editResult;
        }

        if (isset($_POST['newemail'])) {

            if (filter_var($_POST['newemail'], FILTER_VALIDATE_EMAIL)) {
                $insertemail = $data_base->prepare("UPDATE user SET email = ? WHERE id = ?");
                $result = $insertemail->execute([$newemail, $_SESSION['user_id']]);
                $editResult = $result == false ? false : $editResult;
            }
        }

        if (isset($mdp1) && $mdp1 == $mdp2) {
            $insertmdp = $data_base->prepare("UPDATE user SET password = ? WHERE id = ?");
            $result = $insertmdp->execute([$mdp1, $_SESSION['user_id']]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  
    <title>Document</title>
</head>
<body>

<header>

<a href="index.php"><img src="images/logo.png" alt="" class="logo" /></a>
<a href="index.php"><img src="images/logo_text.png" alt="" class="logo_text" /></a>

<nav>
    <a href="edit_profil.php"> <button> Modifier votre profil </button> </a>
    <a href="deconnexion.php"> <button> Déconnexion </button> </a>
</nav>

</header>
    
    <div class="div_form " >
    <form method="POST" action="edit_profil.php">
      
        <label> Entrez votre nouveau nom : </label>
        <input type="text" name="newnom" placeholder="<?= $user["nom"]; ?>">


        <label>Entrez votre nouveau prenom :</label>
        <input type="text" name="newprenom" placeholder="<?= $user["prenom"]; ?>">


        <label for="email">Entrez votre nouvel email :</label>
        <input type="text" name="newemail" placeholder="<?= $user["email"]; ?>">

        <label>Entrez votre nouveau mot de passe :</label>
        <input type="password" name="newmdp1" placeholder="...">


        <label>Confirmation du nouveau mot de passe :</label>
        <input type="password" name="newmdp2" placeholder="..." />

        <button> Mettre à jour mon profil</button> 
        <?php
        if (isset($editResult) && $result == true) {//si $editResult est défini et que la requête a réussi
            echo "Vos données ont été mises à jour !"; ?>

        <?php } ?>

    </form>
</div>
    
    <!-- <a href="index.php"><button>Retour à l'accueil</button></a> -->



<?php } else {
    echo  "Vos deux mot de passe ne correspondent pas !";
}
?>


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

.div_form {
   
  padding: 7% 35% 0;
  margin-top: 2%;
}
form {
  font-family: "Roboto", sans-serif;
  position: fixed;
  left: 5%;
  z-index: 1;
  background: #ffffff;
  width: 800px;
  padding: 45px;
  text-align: left;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: white;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: rgb(56, 17, 17);
  width: 40%;
  margin-left: 30%;
  margin-right: 15%;
  border: 0;
  padding: 12px;
  color: #ffffff;
  font-size: 14px;
  border-radius: 2px;
  cursor: pointer;
}
form button:hover,
form button:active,
form button:focus {
  background: rgb(34, 10, 10);
}






</style>

