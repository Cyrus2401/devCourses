<?php 
        @$idCourses = $_POST['idCourses'];
        @$deleteCourses = $_POST['deleteCourses'];

        $error = "";
        $valid = "";

        if(isset($deleteCourses)){
            require('./bdd/connexionBdd.php');

            $requete = $connexion -> prepare("UPDATE cours SET etat = 0 WHERE id_cours =:num LIMIT 1");
            $requete->bindValue(':num', $_POST['idCourses'], PDO::PARAM_INT);

            $executeIsOk = $requete->execute();

            if($executeIsOk){  
                header('Location:listCourses.php');
            }    
        }


    ?>