<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>devCourses - Download_Courses</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-icons/bootstrap-icons.css">
    <link rel="shortcut icon" href="../images/560216.png" >
</head>
<body>
    <?php
        require('../admin/bdd/connexionBdd.php');

        $requete = $connexion->prepare("SELECT * FROM `matieres` WHERE id_matiere = :num");

        $requete->bindValue(':num', $_GET['download'], PDO::PARAM_INT);

        $executeIsOk = $requete->execute();

        $matiere = $requete->fetch();   

    ?>

    <div class="titleListCourses">
        <h1>Listes des cours <?php echo strtoupper(@$matiere["nom"]); ?></h1>
    </div>

    <div class="containCoursLIST">

        <?php
            require('../admin/bdd/connexionBdd.php');

            $requete = $connexion->prepare("SELECT * FROM cours WHERE etat=1 and matiere= :matiere");

            $requete->bindValue(':matiere', @$matiere["nom"], PDO::PARAM_STR);

            $executeIsOk = $requete->execute();

            $count = 0;

            while ($resultats = $requete->fetch()) 
            {
                $count++;  

                echo ' 
                    <div class="showCourses">
                        <div>'.$resultats["nomDuFichier"].'</div>
                        <span title="Télécharger">
                            <a target="_blank" class="bi-download" href="../admin/filesUpload/'.$resultats["contenu"].'"></a>
                        </span>
                    </div>
                ';   
            }
        ?>
    </div>
    
    

</body>
</html>