<?php 
session_start();
include('bdd.php');

try{
$commentaire = htmlspecialchars($_POST['commentaire']);

$com = $bdd->prepare('INSERT INTO commentaires (commentaire)VALUES(:commentaire)');
$com->bindValue(':commentaire', $commentaire);
$com->execute();

}
catch(PDOException $e){

    echo $e->getMessage();
}
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
     <h1>Poster un commentaire</h1> 

     <form action="" method="post">

            <input type="text" name="login" placeholder="Nom D'utilisateur">
            <textarea name="commentaire"  cols="30" rows="10" placeholder="Votre commentaire"></textarea>
            <input type="submit" name='sumbit_commentaire' value="Poster votre commentaire">
     </form>
</body>            
</html>

<?php if (isset($commentaire_erreur)){

    echo $commentaire_erreur;
}

