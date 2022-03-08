<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - devCourses</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-icons/bootstrap-icons.css">
    <link rel="shortcut icon" href="../images/560216.png" >
</head>
<body>
    <header>
        <h1>
            <img src="../images/560216.png" alt="">
            <a href="index.php">devCourses</a>
        </h1>
        <div class="dropdown">
            <h3 class="dropdown-toggle" id="dropdownMenuTitle" data-bs-toggle="dropdown" aria-expanded="false">
                Administrateur
            </h3>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuTitle">
                <a href="addCourses.php" class="dropdown-item">Ajouter un Cours</a>
                <hr class="dropdown-divider">
                <a href="addMatiere.php" class="dropdown-item">Ajouter un Langage de Programmation</a>
                <hr class="dropdown-divider">
                <a href="listCourses.php" class="dropdown-item">Liste des Cours Publiés</a>
                <hr class="dropdown-divider">
                <a href="listMatiere.php" class="dropdown-item">Liste des Langages de Programmation</a>
            </div>
        </div>
    </header>