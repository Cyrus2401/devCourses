<?php require("header.php") ?>
<?php require("bdd/treatAddCourses.php") ?>

    <div class="divContainForm">
        <h1>Ajouter un Cours</h1>

        
        <form method="POST" enctype="multipart/form-data">
            <?php if(isset($addCourses) && empty($error)) { ?> <div class="alert alert-success"><?php echo $valid ?><span class="bi-check2-circle"></span></div><?php }  ?>

            <?php if(isset($addCourses) && !empty($error)) { ?> <div class="alert alert-danger"><?php echo $error ?><span class="bi-x-circle"></span></div><?php } ?>
            
            <p>
                <input name="titre" type="text" class="form-control" placeholder="Entrer le titre du cours" required>
            </p>
            <p>
                <input type="hidden" name="MAX_FILE_SIZE" value="50000000">
                <input name="file" type="file" class="form-control" required>
            </p>
            
            <p>
                <select name="matiere" id="" class="form-select" required>
                    <option value="">Langue de programmation</option>
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
                <button name="addCourses" type="submit">Ajouter</button>
            </p>
        </form>

    </div>
<?php require("footer.php") ?>
