<?php

require('functions.php');

@$nomMatiereEdit = verifyInput($_POST['nomMatiereEdit']);
@$typeLangageEdit = $_POST['typeLangageEdit']; 
@$addMatiereEdit = $_POST['addMatiereEdit'];

$error = "";
$valid = "";

if(isset($addMatiereEdit) && isset($_FILES['imageEdit'])){

    if(empty($nomMatiereEdit) || !preg_match("/^[a-zA-Z- 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ++]*$/",$nomMatiereEdit))
        $error = "Le champ Entrer le 'nom du langage de programmation' est invalide !";

    if($typeLangageEdit == "")
        $error =  "Veuiller choisi le type du langage de programmation";

    //Variables de stockage de l'image
    $image = $_FILES['imageEdit']['tmp_name'];
    $name = $_FILES['imageEdit']['name'];
    $size = $_FILES['imageEdit']['size'];
    $imageError = $_FILES['imageEdit']['error'];
    $type = $_FILES['imageEdit']['type']; 

    //Afficher l'extension
    $tab_extension = explode('.', $name);
    $extension = strtolower(end($tab_extension));

    //tableau des extensions autorisees
    $extensions_autorisees = ['jpg','jpeg','png'];
    $taile_max = 5000000;

    if(in_array($extension, $extensions_autorisees) && $size <= $taile_max && $imageError == 0)
    {

        if(empty($error)){
            $name_unique = uniqid('',true);
            $fileName = $name_unique.'.'.$extension;

            move_uploaded_file($image, "./imagesUpload/".$fileName);

            require('connexionBdd.php');

            $requete = $connexion->prepare("SELECT * FROM matieres WHERE nom=? and typeLangage=?");
			$requete ->execute(array($nomMatiereEdit, $typeLangageEdit));
			$verifyName = $requete->rowCount();

            if ($verifyName !=0 ) {
				$error = "Ce langage de programmation a été déjà enregisté !";
			}
            else{
                $requete = $connexion -> prepare("UPDATE matieres SET nom =:nom, typeLangage=:typeLangage, image=:image WHERE id_matiere=:num LIMIT 1");
                
                $requete->bindValue(':num', $_POST['id_matiere'], PDO::PARAM_INT);
                $requete->bindValue(':nom', $nomMatiereEdit, PDO::PARAM_STR);
                $requete->bindValue(':typeLangage', $typeLangageEdit, PDO::PARAM_STR);
                $requete->bindValue(':image', $fileName, PDO::PARAM_STR);

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
        $error = "Veuiller choisir une image qui ne pèse pas plus de 5Mo!";
    }	
}

?>