<?php require("header.php") ?>
<?php require("bdd/treatDeleteMatiere.php") ?>
    
    <div class="containList">

        <h1>Liste des Langages de programmation</h1>

        <table>
            <tr>
                <th>Langages de Programmation</th>
                <th>Type de Langage</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>

            <?php
                
                require('./bdd/connexionBdd.php');

                $requete = $connexion->query("SELECT * FROM `matieres` WHERE etat=1");

                $count = 0;
                
                while ($resultats = $requete->fetch()) 
                {
                    $count++;

                    echo ' 
                    <tr>
                        <td>'.strtoupper($resultats["nom"]).'</td>
                        <td>'.strtoupper($resultats["typeLangage"]).'</td>
                        <td><img width="40" src="../admin/imagesUpload/'.$resultats["image"].'"></td>
                        <td>
                            <a href="editMatiere.php?editMatiere='.$resultats["id_matiere"].'" class="bi-pencil-square"></a>
                            <a class="bi-trash-fill" href="deleteMatiere.php?deleteMatiere='.$resultats["id_matiere"].'" >
                        </a>
                        </td>
                    </tr>';
                    
                }
            ?>
        </table>

        <?php
            if($count == 0)
            {
                echo '<h1>Aucun langage de programmation n\'a été enregistré pour l\'instant !</h1>';
            }
        ?>
    </div>
   
<?php require("footer.php") ?>