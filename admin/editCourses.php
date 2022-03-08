<?php require("header.php") ?>
<?php require("bdd/treatEditCourses.php") ?>

<?php
    require('./bdd/connexionBdd.php');

    $requete = $connexion->prepare("SELECT * FROM `cours` WHERE id_cours = :num");

    $requete->bindValue(':num', $_GET['editCourses'], PDO::PARAM_INT);

    $executeIsOk = $requete->execute();

    $cours = $requete->fetch();   

?>

    <div class="divContainForm">
        <h1>Modifier un Cours</h1>
    
        <form method="POST" enctype="multipart/form-data">
            <?php if(isset($editCourses) && empty($error)) { ?> <div class="alert alert-success"><?php echo $valid ?><span class="bi-check2-circle"></span></div><?php } ?>

            <?php if(isset($editCourses) && !empty($error)) { ?> <div class="alert alert-danger"><?php echo $error ?><span class="bi-x-circle"></span></div><?php } ?>
            <input type="hidden" name="id_cours" value="<?php echo $cours['id_cours'] ?>">
            <p>
                <input name="titreEdit" value="<?php echo $cours['titre'] ?>" type="text" class="form-control" placeholder="Entrer le titre du cours" required>
            </p>

            <p>
                <input type="hidden" name="MAX_FILE_SIZE" value="50000000">
                <input name="fileEdit" type="file" class="form-control" required>
            </p>

            <p>
                <select name="matiereEdit" id="" class="form-select">
                    <option value="<?php echo $cours["matiere"]; ?>"><?php echo $cours["matiere"]; ?></option>
                    <?php
                        require('./bdd/connexionBdd.php');

                        $requete = $connexion->query("SELECT * FROM `matieres` WHERE etat=1");
                        $count = 0;

                        while ($resultats = $requete->fetch()) 
                        {
                            $count++; 
        
                            echo '
                                <option value="'.$resultats["nom"].'">'.$resultats["nom"].'</option> 
                            ';   
                        }
                    ?>
                </select>
            </p>

            <p class="divBtn">
                <button name="editCourses" type="submit">Modifier</button>
            </p>
        </form>
    </div>

<?php require("footer.php") ?>