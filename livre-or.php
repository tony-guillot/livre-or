<?php
session_start();
include('bdd.php');


try{

                                                    
$allcomment = $bdd->query('SELECT * FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id');

while($comment = $allcomment->fetch()){

    $comment['commentaire'];
}



?>








<?php

// while($comm = $allcomment->fetch()){
//     $comm['id_utilisateur'] == $comm['login'];

//     echo $comm['login'] . ':'.'  ' .$comm['commentaire']. '    '. $comm['date'];
//     echo 'ok';
//     ?>


  
    <?php



} catch (PDOException $e) {

    echo 'echec : ' . $e->getMessage();
}


?>
<h2> <a href="commentaire">Poster un commentaire </a></h2>


