<?php
session_start();
include('bdd.php');

try{

@$login = $_POST['user'];   // on assosie les variable au formulaire grace a POST 
@$nom =$_POST['nom'];
@$prenom = $_POST['prenom'];
@$password = sha1(@$_POST['mdp']); // Sha1 permet de crypter les mdp 
@$confir = sha1(@$_POST['confirmer']);


@$login = htmlspecialchars(trim($login));
@$password = htmlspecialchars(trim($password));

$sql = "SELECT COUNT(login) AS num FROM utilisateurs WHERE login=:login"; // Count assosie login a un numero 
$stmt =$bdd->prepare($sql);
$stmt->bindValue(':login', $login);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC); // fetch récupère les valeur de la requete SQL 

        if($row['num'] > 0 ){ // si le numéro de la requete est superieur a 0 c'est qu'il y a au moin une entrée dans la bdd 

            echo '<p class="erreur"> ' .'le nom d\'utilisateur est dejà pris'. '</p>';

        }elseif($_POST['mdp'] != $_POST['confirmer']){ // si le mot de passe et la confirmation ne sont pas identique 

            die('les mots de passe se sont pas identique');
        }
            
    else{


        $sql2 = "INSERT INTO utilisateurs (login,password)VALUES(:login,:password)";  // insertion des nouvelles valuers dans la bdd avec la requete SQL INSERT INTO 
        $stmt = $bdd->prepare($sql2);
        $stmt ->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt ->bindValue(':password', $password, PDO::PARAM_STR);
            

        if($stmt->execute()){   // si l'execusion de la requete a lieu alors : 

            
            echo 'inscription reussi';

           }else{ // sinon message d'erreur 

            echo 'echec de l\'inscritpion';
        }

    
    }
}catch (PDOException $e) {

        echo 'echec : ' . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Accueil</a>
                    <a href="connexion.php">Connexion</a>
                    <a href="inscription1.php">Inscription</a>
                    <a href="profil1.php">Modifier le profil</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="main2 ">

        <form class="formulaire2" action="#" method="post">

             
            <h1>Inscription</h1>


            <div class="input">
                <input type="text" name="user" require placeholder="Nom d'utilisateur">

                <input type="password" name='mdp' require placeholder="Mot de passe">

                <input type="password" name="confirmer" autocomplete='off' required placeholder="Confirmer le mot de passe">



            </div>

            <div class="inscription">
                <input type="submit" name="valider" value="Confirmer">
            </div>
        </form>

    </main>

    <footer class="footer">

        <ul class="navigation">
            <h3 class="index.php">Accueil</h3>
            <li><a href=connexion.php>Conneion</a></li>
            <li><a href="inscription.php">inscription</a></li>
        </ul>

        <ul class="contact">
            <h3 class="info">Mes informations</h3>
            <li>Tony Guillot</li>
            <li>Tony.guillot@laplateforme.io</li>
            <li><a href="https://github.com/tony-guillot/module-connexion.git">Repository Github</a></li>
        </ul>


</body>

</html>