<?php
session_start();
include('bdd.php');


try{

        ?>

        <div class="commentaires">

       <?php


         $insert = $bdd->prepare("SELECT *FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id  = commentaires.id_utilisateur ");
         $comment  = $insert->execute();      
         
         
         while($comment= $insert->fetch()){

            echo $comment['login'] .':'. ' '. $comment['commentaire'] .'   '. $comment['date'];

        

         }
         ?>

        </div>















  





} catch (PDOException $e) {

    echo 'echec : ' . $e->getMessage();
}


?>
<h2> <a href="commentaire">Poster un commentaire </a></h2>


