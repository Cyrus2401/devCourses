<?php
    require('functions.php');

    @$titre = verifyInput($_POST['titre']);
    @$matiere = $_POST['matiere']; 
    @$addCourses = $_POST['addCourses'];

    $error = "";
    $valid = "";

    if(isset($addCourses) && isset($_FILES['file'])){

        if(empty($titre))
            $error = "Entrer le titre du cours";

        if($matiere == "")
            $error =  "Veuiller choisir le langage de programmation";

        //Variables de stockage de l'image
        $image = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $imageError = $_FILES['file']['error'];
        $type = $_FILES['file']['type'];

        //Afficher l'extension
        $tab_extension = explode('.', $name);
        $extension = strtolower(end($tab_extension));

        //tableau des extensions autorisees
        $extensions_autorisees = ['pdf','PDF'];
        $taile_max = 50000000;

        if(in_array($extension, $extensions_autorisees) && $size <= $taile_max && $imageError == 0){

            if(empty($error)){

                $name_unique = uniqid('',true);
                $fileName = $name_unique.'.'.$extension;

                move_uploaded_file($image, "./filesUpload/".$fileName);

                require('connexionBdd.php');

                $requete1 = $connexion->prepare("SELECT * FROM cours WHERE nomDuFichier=? and titre=? and matiere=? and etat = 1");
                $requete1 ->execute(array($name, $titre, $matiere));
                $verifyRequete1 = $requete1->rowCount();

                $requete2 = $connexion->prepare("SELECT * FROM cours WHERE nomDuFichier=? and titre=? and matiere=? and etat = 0");
                $requete2 ->execute(array($name, $titre, $matiere));
                $verifyRequete2 = $requete2->rowCount();

                if($verifyRequete1 != 0) {
                
                    $error = "Ce cours a été déjà enregisté !";
                }
                elseif($verifyRequete1 == 0 && $verifyRequete2 != 1){
                    $requete1 = $connexion -> prepare("INSERT INTO cours(titre, nomDuFichier, contenu, dateDePublication, tempsDePublication, matiere) VALUES (?,?,?,NOW(),NOW(),?)");
        
                    $requete1 -> execute(array($titre, $name, $fileName, $matiere)); 
                    $valid = "Un nouveau cours a été ajouté";
                }
                elseif($verifyRequete2 == 1){

                    $requete2 = $connexion -> prepare("UPDATE cours SET etat = 1 WHERE nomDuFichier =:nomDuFichier LIMIT 1");
                    
                    $requete2->bindValue(':nomDuFichier', $name, PDO::PARAM_STR);

                    $executeIsOk = $requete2->execute();
                    
                    if($executeIsOk)
                        $valid = "Un nouveau cours a été ajouté";
                    
                }
            }
        }   
        else
        {
            $error = "Veuiller choisir un fichier PDF qui ne pèse pas plus de 50Mo!";
        }
    }


    
?>
