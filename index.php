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
                $table = array(
                    "first_name" => $pre,
                    "last_name"  =>  $nom,
                    "age" => $age,
                    "size" => $taille,
                    "situation" => $rad
                );
                $_SESSION['table'] = $table;
                echo "<h2> Données sauvegardées</h2>";
            }
            else if(isset($_GET['del'])){
                $login = $_SESSION['table'];
                session_destroy();
                echo "<h2>Les données ont bien été supprimées</h2>";
            }
            else if(isset($_GET['debugging'])){
                echo "<h2>Débogage</h2>";
                echo "<p>===> Lecture du tableau à l'aide de la fonction print_r()</p>";
                $table = $_SESSION['table'];
                echo "<pre>";
                print_r($table);
                echo "</pre>";
            }
            else if(isset($_GET['concatenation'])){
                $con = $_SESSION['table'];
                echo "<h2>Concaténation</h2>";
                echo "<p>===> Construction d'une phrase avec le contenu du tableau :</p>";
                echo "<h3>$con[first_name] $con[last_name]</h3>";
                echo "<p>$con[age] ans, je mesure $con[size] et je fais partie des $con[situation] de la promo Simplon.</p>";
                $nomMaj = strtoupper($con['last_name']);
                echo "<p>===> Construction d'une phrase après MAJ du tableau :</p>";
                echo "<h3>$con[first_name] $nomMaj</h3>";
                echo "<p>$con[age] ans, je mesure $con[size] et je fais partie des $con[situation] de la promo Simplon.</p>";
                echo "<p>===> Affichage d'une virgule à la place du point pour la taille :</p>";
                $virgule = str_replace(".", ",",$con['size']);
                echo "<h3>$con[first_name] $nomMaj</h3>";
                echo "<p>$con[age] ans, je mesure $virgule et je fais partie des $con[situation] de la promo Simplon.</p>";
            }
            else if (isset($_GET['loop'])) {
                $login = $_SESSION['table'];
                echo "<h2>Boucle</h2>";
                echo "<p>===> Lecture du tableau à l'aide d'une boucle foreach</p>";
                $i = 0;
                foreach($login as $cle => $element) {
                echo "<p>à la ligne n°$i correspond la clé $cle et contient $element</p>";
                $i++;
                }
            }
            else if (isset($_GET['function'])){
                $login = $_SESSION['table'];
                echo "<h3>Fonction</h3>";
                echo "<p>===> J'utilise ma fonction readTable()</p>";
                readTable();
            }
            else{
                echo "<a href='index.php?add' class='btn btn-primary ml-5 px-3'>Ajouter des données</a>";
            }
            ?>
            <?php
            function readTable(){
                $login = $_SESSION['table'];
                foreach($login as $cle => $element) {
                echo "<p>à la ligne n°$i correspond la clé $cle et contient $element</p>";
                $i++;
                }
            }
            ?>
        </section>
    </div>
<footer>
        <p class="text-center">© 2021 Quentin Lecompte - PHP</p>
</footer>
</body>
</html>