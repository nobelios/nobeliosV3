<?php 

// ***************************************************
// Verification de l'identite de l'utilisateur
// ***************************************************

// Demarrage de la session
session_start();

// La session est-elle active ?
if (!empty($_SESSION['userId'])) {
	$userLogged = true;
} else {
	$userLogged = false;
}

?>