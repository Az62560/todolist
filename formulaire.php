<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Inscription</title>
</head>
<body>
    

<div class="container">
    
  <form action="" method="post" id="form" class="form-control">
  <h1>Sign up</h1>
  
  <div class="mb-3">
    <label for="name" class="form-label"></label>
    <input type="text" name="name"class="form-control" placeholder="Name">
  </div>
  <div class="mb-3">
    <label for="surname" class="form-label"></label>
    <input type="text" name="surname" class="form-control" placeholder="Surname">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label"></label>
    <input type="email" name="email" class="form-control" placeholder="Mail">
  </div>
  <div class="mb-3">
    <label for="pswd" class="form-label"></label>
    <input type="password" name="pswd" class="form-control" placeholder="Password">
  </div>
  <div class="mb-3">
    <label for="pswd" class="form-label"></label>
    <input type="password" name="pswd2" class="form-control" placeholder="Confirm Password">
  </div>
    <button type="submit" class="btn btn-primary" >Send</button>
    <a href="connexion.php" id="co"> To connect</a>
  <div id="erreur">
    <?php
      $pswdFalse
    ?>
  </div>
  <div id="erreur">
    <?php
      $userFalse
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
    public $password2;
    }

    $emailFalse = "L'adresse mail est déjà utilisée chez nous.";
    $pswdFalse = "Les mots de passe sont différents.<br>Veuillez ressaisir vos mots de passe.";


    if(!empty($_POST['name']) && !empty ($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['pswd']) && !empty($_POST['pswd2'])) {
        $user = new User();
        $user->name = $_POST['name'];
        $user->surname = $_POST['surname'];
        $user->email = $_POST['email'];
        $user->password = $_POST['pswd'];
        $user->password2 = $_POST['pswd2'];
        // var_dump($user);
        // var_dump affiche les valeurs de $user
        
        $sql = "SELECT * FROM `user` WHERE `email` = :email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $user->email, PDO::PARAM_STR);
            $query->execute();
            $verifEmail = $query->fetch();
            
            // verification pour savoir si l'adresse mail est déjà utilisée
            // var_dump($verifEmail);
        if ($_POST['pswd'] !== $_POST['pswd2']) {

            echo $pswdFalse;

        } else if ($verifEmail === false) {

            $sql = "INSERT INTO `user` (`nom`, `prenom`, `email`, `mdp`)
            VALUES (:nom, :prenom, :email, :mdp)";
            $query = $db->prepare($sql);
            $query->bindValue(":nom", $user->name, PDO::PARAM_STR);
            $query->bindValue(":prenom", $user->surname, PDO::PARAM_STR);
            $query->bindValue(":email", $user->email, PDO::PARAM_STR);
            $hash = password_hash($user->password, PASSWORD_DEFAULT);
            $query->bindValue(":mdp", $hash, PDO::PARAM_STR);
            
            
            $query->execute(); 
            header('Location: connexion.php');
            } else {
                
                echo $emailFalse;

            }
        
    };

    

?>