<?php 
// on commence a utiliser les sessions
    session_start();
// on suprime a session de l'utilisateur connecte
    session_destroy();
// on redirige l'utilisateur vers la page d'accueil (index.php)
    header('location: index.php');

?>