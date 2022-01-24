<?php

// ***************************************************
// Deconnexion de l'utilisateur
// ***************************************************

// Demarrage de la session
session_start();

// Effacement des donnees
$_SESSION = array();

// Destruction de la session
session_destroy();

?>