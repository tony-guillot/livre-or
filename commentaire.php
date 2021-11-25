<?php 
session_start();
include('bdd.php');


            if(isset($_POST['valider'])){

                if(!empty($_POST['commentaire'])){

                    $commentaire = nl2br(htmlspecialchars($_POST['commentaire']));
                    $comm_date = date('d/m/Y');
                    $id_user= $_SESSION['id'];
                    $comm_user = $_SESSION['login'];

                    $insert = $bdd->prepare('INSERT INTO commentaires (commentaire, id_utilisateur, date)VALUES(?,?;?)');
                    $insert->execute(array($commentaire, $comm_user, $id_user));
                   

                    $valid = 'le commentaire à bien été envoyé';
                }else{

                    $erreur  = 'veuillez completer tout les champs';
                }
            }
$id= $_GET['id'];

$user = $bdd->prepare('SELECT * FROM utilisateurs WHERE id=?');
$user->fetch();


           











?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     

     <form action="" method="post">
            
     <h1>Poster un commentaire</h1> 

            <?php if(isset($erreur)){
            
            echo '<p classe erreur>' . $erreur . '</p>';
            
            }else(isset($valid)){

                echo '<p classe='erreur'>' . $valid . '</p>';
            }
            ?>
            <input type="text" name="login" placeholder="Nom D'utilisateur">
            <textarea name="commentaire"  cols="30" rows="10" placeholder="Votre commentaire"></textarea>
            <input type="submit" name='valider' value="Poster votre commentaire">
            <input type="hidden" name="id_utilisateur">
     </form>
</body>            
</html>


