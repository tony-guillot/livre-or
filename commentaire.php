<?php
session_start();
include('bdd.php');

try{ 
if(isset($_SESSION['id'])){
    $getid = $_SESSION['id'];
    $usercom = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $usercom->execute(array($getid));
    $usercom = $usercom->fetch();

    if(isset($_POST['submit_commentaire'])){

        if(isset($_SESSION['id'],$_POST['commentaire']) AND !empty($_POST['commentaire'])){

            $commentaire = htmlspecialchars(($_POST['commentaire']));
            if($_SESSION['id']) {

	            $ins = $bdd->prepare('INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?,?,NOW())');
	            $ins->execute(array($commentaire, $getid));
	            
                $mgs= "Votre commentaire a bien été posté";
	         }
	         
	      } else {
	         $mgs = "Tous les champs doivent être complétés";
	      
        }
    }
}
}
catch(PDOException $e){
    
    echo 'echec : ' .$e->getMessage();
}

$commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE commentaire = ? ORDER BY id DESC');
	   $commentaires->execute(array($getid));
?>


<form class="form2" method="POST">
    <div class="commentaire">
    <h2 id="h2com">Commentaires:</h2>

    <?php if(isset($msg)){
        
        echo $msg;

    }

    ?>
        <textarea id="textcom" name="commentaire" placeholder="Votre commentaire..."></textarea><br />
        <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
    </div>
</form>














