<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
    

<div class="container">
    
  <form action="" method="post" id="form" class="form-control">
  <h1>Log in</h1>
  
  
  <div class="mb-3">
    <label for="email" class="form-label"></label>
    <input type="email" name="email" class="form-control" placeholder="Mail">
  </div>
  <div class="mb-3">
    <label for="pswd" class="form-label"></label>
    <input type="password" name="pswd" class="form-control" placeholder="Password">
  </div>

  <button type="submit" class="btn btn-primary" >Send</button>
  <a href="formulaire.php" id="reg">Registe</a>

  <div id="erreur">
    <?php
      $emailFalse
    ?>
  </div>
  <div id="erreur">
    <?php
      $pswdFalse
    ?>
  </div>

</form>
 
</div>


</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connexion_BDD.php');

class User{
    //propriétés
    public $name;
    public $surname;
    public $email;
    public $password;
    }

        $dbname = "ToDoList";
        $dbhost = "localhost";
        $dbpass = "Greta1234!";
        $dbuser = "greta";

        $pswdFalse = "Votre mot de passe est incorrect";
        $emailFalse = "Votre d'adresse mail est incorrect";


if(!empty($_POST['email']) && !empty($_POST['pswd'])) {
    

  $sql = "SELECT * FROM `user` WHERE `email` = :email";
    $query = $db->prepare($sql);
    $query->bindValue(":email", $_POST['email'], PDO::PARAM_STR);
    $query->execute();
    $verifUser = $query->fetch();
    // verification pour savoir si l'adresse mail est déjà utilisée
    // var_dump($verifUser);

if ($_POST['email'] === $verifUser['email'] && password_verify($_POST['pswd'], $verifUser['mdp'])){

  session_start();
  $id_session = session_id();
  $_SESSION['email'] = $verifUser['email'];
  $_SESSION['id'] = $verifUser['id'];
  $_SESSION['prenom'] = $verifUser['prenom'];
  $_SESSION['taches'] = $verifUser['taches'];
  $_SESSION['id_user'] = $verifUser['id_user'];

    header('Location: http://localhost/php/projet_binome/todolist.php');

    } else if ($_POST['email'] !== $verifUser['email']) {

// vérification de la présence du mail dans la base de donnée
      echo $emailFalse;
        
    

    } else if ($_POST['pswd'] !== password_verify($_POST['pswd'], $verifUser['mdp'])) {

// verification pour savoir si le mot de passe est enregistré dans la bdd (fonction password_verify pour déhasher le mot de passe)
      echo $pswdFalse;

    } 
};

?>









