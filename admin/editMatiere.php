<?php require("header.php") ?>
<?php require("bdd/treatEditMatiere.php") ?>

    <?php
        require('./bdd/connexionBdd.php');

        $requete = $connexion->prepare("SELECT * FROM `matieres` WHERE id_matiere = :num");

        $requete->bindValue(':num', $_GET['editMatiere'], PDO::PARAM_INT);

        $executeIsOk = $requete->execute();

        $matiere = $requete->fetch();   

    ?>

    <div class="divContainForm">
        <h1>Modifier un Langage de Programmation</h1>

        <form method="POST" class="form" enctype="multipart/form-data">
            <?php if(isset($addMatiereEdit) && empty($error)) { ?> <div class="alert alert-success"><?php echo $valid ?><span class="bi-check2-circle"></span></div><?php } ?>

            <?php if(isset($addMatiereEdit) && !empty($error)) { ?> <div class="alert alert-danger"><?php echo $error ?><span class="bi-x-circle"></span></div><?php } ?>

            <input type="hidden" name="id_matiere" value="<?php echo $matiere["id_matiere"]; ?>">

            <p>
                <input value="<?php echo $matiere["nom"]; ?>" name="nomMatiereEdit" type="text" placeholder="Entrer le langage de programmation" class="form-control" required>
            </p>

            <p>
                <select name="typeLangageEdit" id="" class="form-select" required>
                    <option value="<?php echo $matiere["typeLangage"]; ?>"><?php echo $matiere["typeLangage"]; ?></option>
                    <option value="frontend">Frontend</option>
                    <option value="backend">Backend</option>
                </select>
            </p>

            <p>
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                <input name="imageEdit" type="file" class="form-control" required>
            </p>

            <p class="divBtn">
                <button name="addMatiereEdit" type="submit" >Modifier</button>
            </p>

        </form>
    </div>

<?php require("footer.php"); ?>