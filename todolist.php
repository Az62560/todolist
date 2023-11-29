<?php
session_start();



error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connexion_BDD.php');

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
}


if(!empty($_POST['task'])) {
   
    $sql = "INSERT INTO `tache` (`taches`, `id_user`) VALUES (:task, :id_user)";
        $query = $db->prepare($sql);
        $query->bindValue(":task", $_POST['task'], PDO::PARAM_STR);
        $query->bindValue(":id_user", $_SESSION['id'], PDO::PARAM_STR);
        $query->execute();
    }   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="app.js" defer></script>
    <title>ToDoList</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" id="nav-bar">
        <div class="container-fluid">            
            <?php
                echo "Bonjour, " . $_SESSION['prenom'] . ".<br>Bienvenue dans ta To Do List.";
            ?>
        </div>
        <form action="deconnexion.php" method="post">
            <button id="dis" type="submit">Deconnexion</button>
        </form>
         
    </nav>
    <br>
    <br>
    <br>
    <br>
    
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title"> Ad</h5>
                <form action="" method="post">
                    <input class="form-control me-2" type="text" name="task" id="newTask" type="search"
                        placeholder="Ajouter une tâche">
                    <br>
                    <button class="btn btn-outline-success" type="submit" onclick="addTask()">Search</button>
                    
<?php
    $requete = "SELECT `taches` FROM `tache` WHERE `id_user` = :id";
    $query = $db->prepare($requete);
    $query->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
    $query->execute();
    $resultat = $query->fetchAll();
// var_dump($resultat);


    $checkBox = '<br> <input type="checkbox"> ';

    if($resultat !== 0) {
        echo '<ul id="todoList">';
        for ($i=0; $i < count($resultat); $i++) { 
            
           echo $checkBox . $resultat[$i]["taches"] ."<br>";
        //    lire les taches dans le tableau $resultat avec la boucle.

        } 
        echo '</ul>';     
    }
    ?>
            
                </form>
        </div>        
    </div>
    
       
</body>
</html>
