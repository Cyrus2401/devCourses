<?php require("header.php") ?>
<?php require("bdd/treatDeleteCourses.php") ?>

    <div class="containList">

        <h1>Liste des Cours Publiés</h1>

        <table>
            <tr>    
                <th>Titre du Cours</th>
                <th>Contenu</th>
                <th>Langage de Programmation</th>
                <th>Dernière Modification</th>
                <th>Actions</th>
            </tr>

            <?php
                require('./bdd/connexionBdd.php');

                $requete = $connexion->query("SELECT * FROM `cours` WHERE etat=1");

                $count = 0;

                while ($resultats = $requete->fetch()) 
                {
                    $count++;  

                    echo ' 
                    <tr>
                        <td>'.$resultats["titre"].'</td>
                        <td>'.$resultats["nomDuFichier"].'</td>
                        <td>'.$resultats["matiere"].'</td>
                        <td>'.$resultats["dateDePublication"].' '.$resultats["tempsDePublication"].'</td>
                        <td>
                            <a href="editCourses.php?editCourses='.$resultats["id_cours"].'" class="bi-pencil-square"></a>
                            <a class="bi-trash-fill" href="deleteCourses.php?deleteCourses='.$resultats["id_cours"].'" >
                            </a>
                        </td>
                    </tr>';   
                }
            ?>
        </table>
        <?php
            if($count == 0)
            {
                echo '<h1>Aucun cours n\'a été enregistré pour l\'instant !</h1>';
            }
        ?>
    </div>

<?php require("footer.php") ?>    