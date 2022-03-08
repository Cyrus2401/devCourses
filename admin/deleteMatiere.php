<?php require("header.php") ?>
<?php require("bdd/treatDeleteMatiere.php") ?>

    <?php
        require('./bdd/connexionBdd.php');

        $requete = $connexion->prepare("SELECT * FROM `matieres` WHERE id_matiere = :num");

        $requete->bindValue(':num', $_GET['deleteMatiere'], PDO::PARAM_INT);

        $executeIsOk = $requete->execute();

        $matiere = $requete->fetch();   

    ?>

    <form method="POST" class="form formDelete">   
        <div>
            <label class="form-label mb-3">Voulez-vous vraiment supprimer le langage de programmation <em>" <?php echo strtoupper($matiere['nom']);?> "</em></label>
            
            <p>
                <input type="hidden" name="idMatiere" value="<?php echo $matiere['id_matiere']; ?>">
                <button  name="deleteMatiere" type="submit" class="btn btn-danger">Supprimer</button> 
                <a href="listMatiere.php" type="button" class="btn btn-primary">Annuler</a>
            </p>
        </div>
    </form>

<?php require("footer.php"); ?>