<?php require("header.php") ?>
<?php require("bdd/treatDeleteCourses.php") ?>

    <?php
        require('./bdd/connexionBdd.php');

        $requete = $connexion->prepare("SELECT * FROM `cours` WHERE id_cours = :num");

        $requete->bindValue(':num', $_GET['deleteCourses'], PDO::PARAM_INT);

        $executeIsOk = $requete->execute();

        $cours = $requete->fetch();   

    ?>

    <form method="POST" class="form formDelete">   
        <div>
            <label class="form-label mb-3">Voulez-vous vraiment supprimer ce cours "<em> <?php echo strtoupper($cours['titre']); ?> "</em> ?</label>
            
            <p>
                <input type="hidden" name="idCourses" value="<?php echo $cours['id_cours']; ?>">
                <button  name="deleteCourses" type="submit" class="btn btn-danger">Supprimer</button> 
                <a href="listCourses.php" type="button" class="btn btn-primary">Annuler</a>
            </p>
        </div>
    </form>

<?php require("footer.php"); ?>