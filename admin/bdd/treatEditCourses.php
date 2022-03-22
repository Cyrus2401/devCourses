<?php
    require('functions.php');

    @$titreEdit = verifyInput($_POST['titreEdit']);
    @$matiereEdit = $_POST['matiereEdit']; 
    @$editCourses = $_POST['editCourses'];

    $error = "";
    $valid = "";

    if(isset($editCourses) && isset($_FILES['fileEdit'])){

        if(empty($titreEdit) || !preg_match("/^[a-zA-Z- 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ++]*$/",$titreEdit))
            $error = "Le champ Entrer le 'Titre du Cours' est invalide !";

        if($matiereEdit == "")
            $error =  "Veuiller choisi le langage de programmation";

        //Variables de stockage de l'image
        $image = $_FILES['fileEdit']['tmp_name'];
        $name = $_FILES['fileEdit']['name'];
        $size = $_FILES['fileEdit']['size'];
        $imageError = $_FILES['fileEdit']['error'];
        $type = $_FILES['fileEdit']['type'];

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

                $requete = $connexion->prepare("SELECT * FROM cours WHERE nomDuFichier=? and titre=? and matiere=?");
                $requete ->execute(array($name, $titreEdit, $matiereEdit));
                $verifyName = $requete->rowCount();

                if ($verifyName !=0 ) {
                    $error = "Ce cours a été déjà enregisté !";
                }
                else{
                    $requete = $connexion -> prepare("UPDATE cours SET titre =:titre, nomDuFichier=:nomDuFichier, contenu=:contenu, dateDePublication = Now(), tempsDePublication = Now(), matiere=:matiere WHERE id_cours =:num LIMIT 1");
                    
                    $requete->bindValue(':num', $_POST['id_cours'], PDO::PARAM_INT);
                    $requete->bindValue(':titre', $titreEdit, PDO::PARAM_STR);
                    $requete->bindValue(':nomDuFichier', $name, PDO::PARAM_STR);
                    $requete->bindValue(':contenu', $fileName, PDO::PARAM_STR); 
                    $requete->bindValue(':matiere', $matiereEdit, PDO::PARAM_STR);

                    $executeIsOk = $requete->execute();
                    
                    if($executeIsOk)
                        $valid = "Modification effectuée avec succès ";
                    else    
                        $error = "Echec de la mise à jour"; 

                }
            }
        }   
        else
        {
            $error = "Veuiller choisir un fichier PDF qui ne pèse pas plus de 30Mo!";
        }
    }


    
?>
