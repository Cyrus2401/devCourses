<?php

require('functions.php');

@$nomMatiere = verifyInput($_POST['nomMatiere']);
@$typeLangage = $_POST['typeLangage']; 
@$addMatiere = $_POST['addMatiere'];

$error = "";
$valid = "";

if(isset($addMatiere) && isset($_FILES['image'])){

    if(empty($nomMatiere))
        $error = "Entrer le nom du langage de programmation";

    if(empty($typeLangage))
        $error =  "Veuiller choisir le type du langage de programmation";

    //Variables de stockage de l'image
    $image = $_FILES['image']['tmp_name'];
    $name = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $imageError = $_FILES['image']['error'];
    $type = $_FILES['image']['type'];

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

            require('connexionBdd.php');

            $requete1 = $connexion->prepare("SELECT * FROM matieres WHERE nom=? and nomImage=? and etat = 1");
			$requete1 ->execute(array($nomMatiere, $name));
			$verifyRequete1 = $requete1->rowCount();

            $requete2 = $connexion->prepare("SELECT * FROM matieres WHERE nom=? and nomImage=? and etat = 0");
			$requete2 ->execute(array($nomMatiere, $name));
			$verifyRequete2 = $requete2->rowCount();

            if($verifyRequete1 != 0) {
				$error = "Ce langage de programmation ou cette image image a été déjà enregisté !";
			}
            elseif($verifyRequete1 == 0 && $verifyRequete2 != 1){

                move_uploaded_file($image, "./imagesUpload/".$fileName);

                $requete1 = $connexion -> prepare("INSERT INTO matieres(nom, typeLangage,image, nomImage) VALUES (?,?,?,?)");
    
                $requete1 -> execute(array($nomMatiere, $typeLangage, $fileName, $name));
    
                $valid = "Un nouveau langage de programmation a été ajouté";
            }
            elseif($verifyRequete2 == 1){

                move_uploaded_file($image, "./imagesUpload/".$fileName);

                $requete2 = $connexion -> prepare("UPDATE matieres SET etat = 1 WHERE nom =:nom LIMIT 1");
                
                $requete2->bindValue(':nom', $nomMatiere, PDO::PARAM_STR);

                $executeIsOk = $requete2->execute();
                
                if($executeIsOk)
                    $valid = "Un nouveau langage de programmation a été ajouté";
                
            }
        }

    }
    else
    {
        $error = "Veuiller choisir une image  qui ne pèse pas plus de 5Mo!";
    }	
}

?>