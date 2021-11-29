<?php
session_start();
include('bdd.php');
include('navbar.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    

        

        <?php


        $insert = $bdd->prepare("SELECT *FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id  = commentaires.id_utilisateur ");
        $comment  = $insert->execute();
        ?>
        <div class="commentaires">
        <H1>Commentaires</H1>
        <?php
        while ($comment = $insert->fetch()) {

            echo $comment ['login'] . ':' . ' ' . $comment['commentaire'] . '  '. ':' . $comment['date'] . '<br /> <br />';
        }
        ?>

        <h3 id="poster"> <a href="commentaire.php"> Poster un commentaire</a></h3>

    </div>

    <?php   include('footer.php'); ?>
</body>

</html>






?>