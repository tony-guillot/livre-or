<?php
session_start();
include('bdd.php');
include('navbar.php');

try {
    if(!isset($_SESSION['id'])){

        header("location: connexion.php");

     }
    if (isset($_SESSION['id'])) {
        $getid = $_SESSION['id'];
        $usercom = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
        $usercom->execute(array($getid));
        $usercom = $usercom->fetch();
        
        if (isset($_POST['submit_commentaire'])) {

            if (isset($_SESSION['id'], $_POST['commentaire']) and !empty($_POST['commentaire'])) {

                $commentaire = htmlspecialchars(($_POST['commentaire']));
                if ($_SESSION['id']) {

                    $ins = $bdd->prepare('INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?,?,NOW())');
                    $ins->execute(array($commentaire, $getid));

                    $msg = " Votre commentaire a bien été posté ";
                }
            }

             else {
                $msg = "Tous les champs doivent être complétés";
            }
        }
    }
} catch (PDOException $e) {

    echo 'echec : ' . $e->getMessage();
}

$commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE commentaire = ? ORDER BY id DESC');
$commentaires->execute(array(@$getid));
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
    <main>
        <form class="form2" method="POST">
            <div class="commentaire">

                <?php if (isset($msg)) {

                    echo '<p class="erreur"> ' .$msg;
                }

                ?>
                <h2 id="h2com">Commentaires:</h2>


                <textarea id="textcom" name="commentaire" rows="5" cols="33" placeholder="Votre commentaire..."></textarea><br />
                <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
            </div>
    </main>
    </form>

    <?php   include('footer.php'); ?>
</body>

</html>