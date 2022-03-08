<?php
    // fonction pour vérifier les input 
    function verifyInput($var){
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripslashes($var);
        return $var;
    }
?>