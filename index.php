<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Premier back</title>
</head>
<body>
<header>
    <div class="jumbotron d-none d-sm-block">
        <h1 class="display-4">PHP procédural</h1>
        <hr class="my-4">
        <p class="lead">J'apprends et je me perfectionne.</p>
    </div>
</header>
    <div class="row">
        <nav class="d-inline col-sm-2 col-lg-2 m-5">
            <a href="index.php" type="submit" class="btn btn-outline-secondary col-sm-8">Home</a>
            <?php
            if(!empty($_SESSION)) {
                include "includes/ul.inc.html";
            }
            ?>
        </nav>
        <section class="col-sm-8 m-5">
            <?php
            if(isset($_GET['add'])) {
                include 'includes/form.inc.html';
            }
            else if(isset($_POST['enregistrer'])){
                $pre = $_POST['user-prenom'];
                $nom = $_POST['user-name'];
                $age = $_POST['user-age'];
                $taille = $_POST['user-nombre'];
                $rad = $_POST['user-radio'];
                $table = [
                    "prenom" => $pre ,
                    "nom"  =>  $nom,
                    "age" => $age,
                    "taille" => $taille,
                    "choix" => $rad
                ];
                $_SESSION['table'] = $table;
                echo "<h2> Données sauvegardées</h2>";
            }
            else if(isset($_GET['del'])){
                $login = $_SESSION['table'];
                session_destroy();
                echo "<h2>Données supprimées</h2>";
            }
            else{
                echo "<a href='index.php?add' class='btn btn-primary ml-5 px-3'>Ajouter des données</a>";
            }
            ?>
        </section>
    </div>
<footer>
        <p class="text-center">© 2021 Quentin Lecompte - PHP</p>
</footer>
</body>
</html>