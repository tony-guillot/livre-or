<?php
session_start();
include('bdd.php');




try {
    $bdd = new PDO("mysql:host=$servname;dbname=$dbname", "$user", "$mdp"); //connexion à la bdd
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    // message en cas d'erreur 


    if (isset($_POST['valider'])) {

        $login = htmlspecialchars($_POST['login']);
        $password = sha1($_POST['password']);



        if (!empty($login) && !empty($password)) {

            $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login=:login AND password=:password"); // selection de tout le table utilisateur de la bdd 
            $requser->bindValue(':login', $login); // bind des valeurs 
            $requser->bindValue(':password', $password);
            $requser->execute();  // execution de la requete 
            $userexist = $requser->rowCount(); // rowcount permet de compter le nombre le valeurs dans la requete 

            if ($userexist == 1) { // si le resultat de rowcount est superieur a 0 alors on assosie les variable de session au fetch de la requete SQL 

                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['login'] = $userinfo['login'];
                $_SESSION['password'] = $userinfo['password'];
                // le fetch recupère les valeurs de la requete SQL, puis on lui associe les variables de session.

                
            } else {

                
                 $erreur = '<p class="erreur">' . 'Mauvais identifiant ou mot de passe' . '</p>';
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
    <title>connexion</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Accueil</a>
                    <a href="connexion.php">Connexion</a>
                    <a href="inscription.php">Inscription</a>
                    <a href="profil.php">Modifier le profil</a>
                </li>
            </ul>
        </nav>
    </header>


    <main class="main2 ">

        <form class="formulaire2" action="#" method="post">

            <?php   echo @$erreur  ?>

            <h1>Se connecter</h1>


            <div class="input">
                <input type="text" name="login" require placeholder="Nom d'utilisateur">
                <input type="password" name='password' require placeholder="Mot de passe">
                
            </div>

            <div>
            <p class="inscription">Je n'ai pas de compte. J'en <a href ='connexion.php'>crée un</a> </p>
            <div align='center'>
            <input type="submit" name="valider" value="Se connecter">
            </div>

            <div class="profil">

            <h2 id="connexion">Profil de <?php echo @$userinfo['login']; ?></h2>

            

            <a href="index.php"><input type="submit" value="Se deconnecter"/></a>

            <a href="profil1.php" id="profil_link">Modifier mon profil</a>
            </div>

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