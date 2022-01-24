<?php

// Definition de l'administration
$nbAttemptMax = 3;
$nbLockMax = 3;
$durationLock = 0;

// Noms des tables
$dbTableUsers			= 'users';
$dbTableFiltering		= 'filtering';

// ADRESSE IP USER
// echo "VOTRE ADRESSE IP est :" . $_SERVER["REMOTE_ADDR"] ;


// Pays interdit de connexion ou de tout ?

// Adresse IP interdite de connexion ou de tout ?


// La commande est deverrouillee
if ($_SESSION['lock'] == 0) {
	// On demande une connexion
	if (!empty($_POST['login']) && !empty($_POST['password'])) {
		$loginProtected = htmlspecialchars($_POST['login']);
		$passwordProtected = htmlspecialchars($_POST['password']);
		// Interrogation de la bdd
		$sql = "SELECT COUNT(*) FROM " . $dbTableUsers . " WHERE login='" . $loginProtected . "' AND password='" . $passwordProtected . "'";
		
		if (($dbh->query($sql)->fetchColumn()) > 0) {
			$_SESSION['totalAttempt'] = 0; // Increment du nombre de tentatives total
			$_SESSION['nbAttempt'] = 0; // RaZ du compteur de tentatives avant verrouillage
			$_SESSION['nbLock'] = 0; // Raz du nombre de verrouillages
			
			// include_once('etablir_connexion.php');
				// La connexion est un echec
				// echo 'La connexion a echoue (code erreur)';
			
			$sql = "SELECT userId FROM " . $dbTableUsers . " WHERE login='" . $loginProtected . "' AND password='" . $passwordProtected . "'"; 
			$dbh->query($sql);
			foreach ($dbh->query($sql) as $dbUserData) {
				$_SESSION['userId'] = $dbUserData['userId'];
			}
			
			$userLogged = true;
			

		// Il y a une erreur dans le mot de passe ou dans le login
		} else {
			echo $_SESSION['totalAttempt']++;
			echo $_SESSION['nbAttempt']++; // Increment du nombre d'echecs
			
			// Le nombre de tentative autorise est-il depasse
			if ($_SESSION['nbAttempt'] >= $nbAttemptMax) {
				$_SESSION['nbAttempt'] = 0; // RaZ du compteur de tentatives avant verrouillage
				echo "</br >Nombre tentative : " . $_SESSION['nbLock']++ . "</br >"; // Increment du nombre de verrouillages
				$_SESSION['lock'] = 1; // Flag de verrouillage a l'etat haut
				$_SESSION['dateLock'] = time();				
			}
			
			if ($_SESSION['nbLock'] >= $nbLockMax) {
				$_SESSION['lock']++; // Flag de verrouillage a l'etat haut
				$_SESSION['nbLock'] = 0; // RaZ du nombre de verrouillages
				echo 'Vous avez entre un identifiant ou un mot de passe incorrect a ' . $_SESSION['totalAttempt'] . ' reprises, votre adresse Ip a ete enregistree';
			}
			
			// afficher l'erreur d'identifiant ou mdp
			echo 'Erreur : l\identifiant ou le mot de passe est incorrect.';
		}
	}
// La commande est verrouillee
} else {
	if (time() >= ($_SESSION['dateLock'] + $durationLock)) {
		$_SESSION['lock']  = 0;
	} else {
		echo 'Veuillez attendre x secondes avant de faire une nouvelle tentative';
	}
}

// Affichage du formulaire
if ($userLogged == false) {
	if ($_SESSION['lock'] == 0) {
		echo '<form method="post" action="./index.php?login">
			<label for="login">Identifiant : </label><input id="login" name="login" type="text" /><br />
			<label for="password">Mot de passe : </label><input id="password" name="password" type="password" /><br />
			<input type="submit" />
		</form>';
	}
} else {
	echo 'Vous etes a present connecte : <a href="http://nobelios.com/Ndesign">Accueil</a>.';
}


?>