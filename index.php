<?php       // Essentiel pour la création de session
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <?php
        include "includes/head.inc.html";
    ?>
</head>
<body>
<header>
    <?php
        include "includes/header.inc.html";
    ?>
</header>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 pt-3">
            <a href="index.php" type="submit" class="btn btn-outline-secondary col-sm-12">Home</a> <!-- bouton "HOME" -->
            <?php
            if(!empty($_SESSION)) {
                include "includes/ul.inc.html";
            }
            ?>
        </nav>
        <section class="col-sm-8 pt-3">
            <?php
            if(isset($_GET['add'])) {       // Include pour le formulaire
                include 'includes/form.inc.html';
            }
            else if(isset($_POST['enregistrer'])){      //Création de session
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
            else if(isset($_GET['del'])){       //Données supprimées
                $login = $_SESSION['table'];
                session_destroy();
                echo "<h2>Les données ont bien été supprimées</h2>";
            }
            else if(isset($_GET['debugging'])){     //Débogage
                echo "<h2>Débogage</h2>";
                echo "<p>===> Lecture du tableau à l'aide de la fonction print_r()</p>";
                $table = $_SESSION['table'];
                echo "<pre>";
                print_r($table);
                echo "</pre>";
            }
            else if(isset($_GET['concatenation'])){     //Concaténation
                $con = $_SESSION['table'];
                echo "<h2>Concaténation</h2>";
                echo "<br>";
                echo "<p>===> Construction d'une phrase avec le contenu du tableau :</p>";
                echo "<h3>$con[first_name] $con[last_name]</h3>";
                echo "<p>$con[age] ans, je mesure $con[size] et je fais partie des $con[situation] de la promo Simplon.</p>";
                $con['last_name'] = strtoupper($con['last_name']);
                echo "<br>";
                echo "<p>===> Construction d'une phrase après MAJ du tableau :</p>";
                echo "<h3>$con[first_name] $con[last_name]</h3>";
                echo "<p>$con[age] ans, je mesure $con[size] et je fais partie des $con[situation] de la promo Simplon.</p>";
                echo "<br>";
                echo "<p>===> Affichage d'une virgule à la place du point pour la taille :</p>";
                $virgule = str_replace(".", ",",$con['size']);
                echo "<h3>$con[first_name] $con[last_name]</h3>";
                echo "<p>$con[age] ans, je mesure $virgule et je fais partie des $con[situation] de la promo Simplon.</p>";
            }
            else if (isset($_GET['loop'])) {        //Boucle
                $login = $_SESSION['table'];
                echo "<h2>Boucle</h2>";
                echo "<br>";
                echo "<p>===> Lecture du tableau à l'aide d'une boucle foreach</p>";
                echo "<br>";
                $i = 0;
                foreach($login as $cle => $element) {
                echo '<div>à la ligne n°'.$i.' correspond la clé "'.$cle.'" et contient "'.$element.'"</div>';
                $i++;
                }
            }
            else if (isset($_GET['function'])){     //Appelle function foreach
                $login = $_SESSION['table'];
                echo "<h3>Fonction</h3>";
                echo "<br>";
                echo "<p>===> J'utilise ma fonction readTable()</p>";
                readTable();
            }
            else{
                echo "<a href='index.php?add' class='btn btn-primary ml-5 px-3'>Ajouter des données</a>";
            }
            ?>
            <?php
            function readTable(){       // Création de la fonction
                $login = $_SESSION['table'];
                $gui = '"';
                $i = 0;
                foreach($login as $cle => $element) {
                    echo '<div>à la ligne n°'.$i.' correspond la clé "'.$cle.'" et contient "'.$element.'"</div>';
                    $i++;
                }
            }
            ?>
        </section>
    </div>
</div>

<footer>
    <?php
        include "includes/footer.inc.html";
    ?>
</footer>
</body>
</html>