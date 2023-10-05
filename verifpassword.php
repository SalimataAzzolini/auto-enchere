<?php

session_start();

$data_base = new PDO("mysql:dbname=auto_enchere;host=localhost", "root", "root");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = ($_POST["password"]);
    $hash = password_hash($password, PASSWORD_DEFAULT);

    if ($_POST["password"] === $_POST['password2']) {

        $requete = $data_base->prepare("INSERT INTO user (nom,prenom,email,password) VALUES (?,?,?,?)");
        $requete->execute([$nom, $prenom, $email, $hash]);

        header('Location: connexion.php');
    } else {
        echo "Erreur vérifiez vos mots de passes et/ou email";
    }

}
// <?php 
//     session_start();
//  //   
  
//     if(!empty($_POST['email']) && !empty($_POST['password']))
//     {
//         $email = htmlspecialchars($_POST['email']);
//         $password = ($_POST['password']);

//         $requete = $au->prepare('SELECT email , password FROM user = ?');
//         $requete->execute(array($password , $hash));
        
        

//         if($hash =! $password)
//         {
           
                
//                 if(password_verify($password, $requete['password']))
//                 {
//                   $_SESSION['user'] = array('id'=>$requete['id'], 'pseudo'=>$requete['email']) ;
//                    $_SESSION['user'] = $requete['email'];
                   
//                       header('Location: index.php'.$_SESSION['email']);
//                     die();
//                 }else{ header('Location: index.php?login_err=password'); die(); }
          
//         }else{ header('Location: index.php?login_err=already'); die(); }
//     }