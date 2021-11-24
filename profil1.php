<?php
session_start();

include('bdd.php');

try {
    if (isset($_SESSION['id'])) {


        $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id =? ");
        $requser->execute(array($_SESSION['id']));
        $user = $requser->fetch();

        if (isset($_POST['newlogin']) and !empty($_POST['newlogin']) and $_POST['newlogin'] != $user['login']) { // si le nouveau login a une valeur; n'est pas vide et n'est pas identique a un login dejà present dans la bdd 

            $newlogin = htmlspecialchars($_POST['newlogin']);
            $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login=? WHERE id=?"); // permet la mise a jours des données de la bdd 
            $insertlogin->execute(array($newlogin, $_SESSION['id']));
            header('Location: connexion.php');
        }




        if (isset($_POST['newmdp']) and !empty($_POST['newmdp']) and isset($_POST['newmdp2']) and !empty($_POST['newmdp2'])) { // si le nouveau mdp a une valeur; n'est pas vide et n'est pas identique a un login dejà present dans la bdd 


            $mdp1 = sha1($_POST['newmdp']);
            $mdp2 = sha1($_POST['newmdp2']);

            if ($mdp1 == $mdp2) {

                $insertmdp = $bdd->prepare("UPDATE utilisateurs  SET  password=? WHERE id=?");
                $insertmdp->execute(array($mdp1, $_SESSION['id']));
                header('location: connexion.php');
            } else {
                echo 'Les mot de passe ne correspondent pas ';
            }
        }
    }
} catch (PDOException $e) {

    echo 'echec : ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>modification du profil</title>
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
    <main class="modif1">



        <form classe="modif" action="#" method="post">

            <h2>Modification de mon profil</h2>


            <label>Nom d'utilisateur</label>
            <input type="text" name="newlogin" placeholder="nom d'utilisateur" value="<?php echo @$user['login'] ?>">

            <label>Mot de passe</label>
            <input classe="input-profil" type="password" name='newmdp' placeholder="mot de passe">


            <label>Confirmer le mot de passe</label>

            <input classe="input-profil" type="password" name='newmdp2' placeholder="Confirmer le   mot de passe">

            <input id='modifier' type="submit" value="Modifier">

        </form>

    </main>

    <footer class="footer">

        <ul class="navigation">
            <h3 class="navi">Navigation</h3>
            <li><a href="index.html">Accueil</a></li>
            <li><a href="voyage6.html">Contactez-nous</a></li>
        </ul>

        <ul class="contact">
            <h3 class="info">Mes informations</h3>
            <li>Tony Guillot</li>
            <li>Tony.guillot@laplateforme.io</li>
            <li><a href="https://github.com/tony-guillot/module-connexion.git">Repository Github</a></li>
        </ul>

    </footer>
</body>

</html>