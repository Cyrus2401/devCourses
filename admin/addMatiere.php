<?php require("header.php") ?>
<?php require("bdd/treatAddMatiere.php") ?>

    
    <div class="divContainForm">
        <h1>Ajouter un Langage de Programmation</h1>
    
        <form method="POST" class="form" enctype="multipart/form-data">
            <?php if(isset($addMatiere) && empty($error)) { ?> <div class="alert alert-success"><?php echo $valid ?><span class="bi-check2-circle"></span></div><?php }  ?>

            <?php if(isset($addMatiere) && !empty($error)) { ?> <div class="alert alert-danger"><?php echo $error ?><span class="bi-x-circle"></span></div><?php } ?>

            <p>
                <input class="form-control" value="<?php if(isset($addMatiere) && !empty($error)) echo $nomMatiere; ?>" name="nomMatiere" type="text" class="" placeholder="Entrer le nom du langage de programmation" required>
            </p>
            <p>
                <select name="typeLangage" id="" class="form-select" required>
                    <option value="">Type de langage de programmation</option>
                    <option value="frontend">Frontend</option>
                    <option value="backend">Backend</option>
                </select>
            </p>
            <p>
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                <input name="image" type="file" class="form-control" required>
            </p>
            <p class="divBtn">
                <button type="submit" name="addMatiere">Ajouter</button>
            </p>
        </form>

    </div>
<?php require("footer.php"); ?>