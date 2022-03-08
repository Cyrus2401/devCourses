<?php 
        @$idMatiere = $_POST['idMatiere'];
        @$deleteMatiere = $_POST['deleteMatiere'];

        $error = "";
        $valid = "";

        if(isset($deleteMatiere)){
            require('./bdd/connexionBdd.php');

            $requete = $connexion -> prepare("UPDATE matieres SET etat = 0 WHERE id_matiere=:num LIMIT 1");
            $requete->bindValue(':num', $_POST['idMatiere'], PDO::PARAM_INT);

            $executeIsOk = $requete->execute();

            

            if($executeIsOk){  
                header('Location:listMatiere.php');
            }
            
        }


    ?>