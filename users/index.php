<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>devCourses</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-icons/bootstrap-icons.css">
    <link rel="shortcut icon" href="../images/560216.png" >
</head>
<body>
 
    <header>
        <div class="containHeader">
            <div class="divImg">
                <img src="../images/560216.png" alt="" width="160" class="img-fluid">
            </div>
            <div>
                <h1>Bienvenue sur devCourses</h1>
                <h5>Un site de téléchargement des cours de programmation</h5>
            </div>
        </div>
    </header>


    <div class="container">
        <section class="row">
            <?php
                require('../admin/bdd/connexionBdd.php');

                $requete = $connexion->query("SELECT * FROM `matieres` WHERE etat=1");

                while ($resultats = $requete->fetch()) {
                    echo '
                        <div class="col-lg-3 col-md-4">
                            <a href="downloadCourses.php?download='.$resultats["id_matiere"].'">
                                <img src="../admin/imagesUpload/'.$resultats["image"].'" alt="" width="50" height="50"  >
                                <span>'.strtoupper($resultats["nom"]).'</span>
                            </a>
                        </div>
                    ';
                }
            ?>
        </section>
    </div>

    <footer>
        &copy <?php echo date("Y"); ?> - devCourses
    </footer>
    
</body>
</html>