<?php

$servname = 'localhost';
$dbname = $dbname = 'tony-guillot_livreor';    // log de connexion à la bdd 
$user = 'tony';
$mdp ='toto199800912';

try{
$bdd = new PDO("mysql:host=$servname;dbname=$dbname","$user","$mdp");//connexion à la bdd
$bdd-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch(PDOException $e){   // le try est catch perme l'affiche d'erreur plus precis 

    echo 'echec : ' .$e->getMessage();
}
