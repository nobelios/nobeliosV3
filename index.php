<?php

//*****************************************************************
//*                   PAGE DE CONNEXION                           *
//*****************************************************************
// Dernière mise à jour le 07/06/2013                             *
// Nobelios V3.0.0                                                *
//*****************************************************************

//-----------------------------------------------------------------
// INCLUSIONS UNIQUES
//-----------------------------------------------------------------
include_once("./functions/functions_debug.php"); 			// Messages erreurs base de donnees
include_once("./login/session_control.php");				// Permet le contrôle des utilisateurs (pour savoir si l'utilisateur est déjà connecté)
include_once("./language/french.php");						// Affichage des messages en français

//-----------------------------------------------------------------
// VARIABLES A DECLARER
//-----------------------------------------------------------------

// Noms des tables utilisées
$dbTableUsers		= 'users';

// Déclaration des variables
$errorDiv			 = null; 	// Par défaut aucune erreur
$connectionStart 	 = false;	// Par défaut aucune connexion
$redirection 		 = false;
$redirectionPage 	 = null;
$adminApprove        = false;
$emailValidated      = false;


//-----------------------------------------------------------------
// TEST DES DONNEES DE CONNEXION
//-----------------------------------------------------------------

// Test si demande de connexion
if (!empty($_POST['email']) && !empty($_POST['password'])) {
	
	// Protection des données de formulaire
	$emailProtected = htmlspecialchars($_POST['email']);
	$passwordProtected = htmlspecialchars($_POST['password']);
	
	// Tentative de connexion à la base de données
	try {
		
		include_once('./functions/functions_db.php');
		$stmt = $db->query('SELECT COUNT(*) FROM ' . $dbTableUsers . ' WHERE email="' . $emailProtected . '" AND password="' . $passwordProtected . '"');
		$userExist = $stmt->fetchColumn();
		
		// Test si l'utilisateur existe dans la base de données
		if ($userExist != 0) {
			
			// test si l'adresse email doit etre confirmée
			$stmt = $db->query('SELECT * FROM ' . $dbTableUsers . ' WHERE email="' . $emailProtected . '" AND password="' . $passwordProtected . '"');
			// test si le compte doit etre activé par l'administrateur
			$data = $stmt->fetch();
			
			// Test si email validé
			if ($data['emailActivated'] == 1) {
				
				// Test si activé par administrateur
				if ($data['adminActivated'] == 1) {
					// Démarrage de la session
					session_start();
					$_SESSION['userId']= $data['userId'];
					$_SESSION['login']= $data['login'];
					$connectionStart = true;
				
				// Le compte doit etre validé par un administrateur
				} else {
					$adminApprove=true;
				}
				
			// L'addresse email doit etre confirmée
			} else {
				$emailValidated=true;
			}
		
		// L'utilisateur n'existe pas
		} else {	
			// afficher l'erreur d'identifiant ou mdp
			$errorDiv = '<div style="width: 280px; height: 32px; border: 1px solid #ff8800; background-color: #ffe5c8; line-height: 32px; font-family: arial; font-size: 14px; padding: 0px 10px;">Adresse Email ou mot de passe incorrect</div>
			<div style="height: 10px;"></div>';
		}
		
		// Fermeture du curseur
		$stmt->closeCursor();
	
	// Erreurs détectées et affichage
	} catch (Exception $e) {
		viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
	}
}

// Destruction de la session
if (isset($_GET['killsession'])) {
	session_start();
	session_destroy();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Nobelios 3.0.0</title>
		<?php if ($connectionStart==true) {echo '<meta http-equiv="refresh" content="0; URL=./intro.php">';} ?>
		<!-- Feuilles de style !-->
		<link rel="stylesheet" href="./theme/lightblue/css/general.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/intro.css" type="text/css" /> <!-- Gestion des champs de formulaire et des légendes !-->
		<link rel="stylesheet" href="./theme/lightblue/css/form.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/connection.css" type="text/css" />
	</head>
	
    <body style="margin: 0px; padding: 0px; background-color: #025ea9;">
		
		<!--  Header !-->
		<div id="bigHeader">
			<div class="center">
				<div class="logo"></div>
			</div>
		</div>
		
		<!-- Body !-->
		<div id="content">
			
			<?php if ($emailValidated==true) {?>
			
			<div class="center">
				<div id="alertBox">
					<div class="logo"></div>
					<div class="text">
						<h2><?php echo $messages_translation['title']['connection']['email_must_be_validated']; ?></h2>
						<p>
							<?php
								echo $messages_translation['message']['connection']['email_must_be_validated']; 
							?>
						</p>
						<p>
							<?php
								echo '<a href="./index.php?new_email">'.$messages_translation['link']['connection']['new_validation_email'].'</a><br />
									  <a href="./index.php">'.$messages_translation['link']['connection']['return'].'</a>';
							?>
						</p>
					</div>
				</div>
			</div>
			
			<?php } elseif ($adminApprove==true) {?>
			
			<div class="center">
				<div id="alertBox">
					<div class="logo"></div>
					<div class="text">
						<h2><?php echo $messages_translation['title']['connection']['admin_must_approve']; ?></h2>
						<p>
							<?php 
								echo $messages_translation['message']['connection']['admin_must_approve']; 
							?>
						</p>
						<p>
							<?php 
								echo '<a href="./index.php">'.$messages_translation['link']['connection']['return'].'</a>'; 
							?>
						</p>
					</div>
				</div>
			</div>
			
			<?php } else { ?>
			
			<div class="center">
				<div id="connection">
					<div class="logo"></div>
					<div class="form">
						<form method="post" action="./index.php">
							<?php echo $errorDiv; ?>
							
							<!-- Email !-->
							<input 
								class="connectionInputWidth" 
								type="email" 
								required="required" 
								aria-required="true" 
								placeholder="Email" 
								maxlength="40"
								name="email" 
							/>
							
							<div class="formHeightSpacer"></div>
							
							<!-- Mot de passe !-->
							<input 
								class="connectionInputWidth" 
								type="password" 
								required="required" 
								aria-required="true" 
								placeholder="Mot de passe" 
								maxlength="20"
								name="password" 
							/>
							
							<div class="formHeightSpacer"></div>
							
							<input type="submit" value="Connexion" />
							
							<div class="formHeightSpacer"></div>
							
							<div style="height: 36px;">
								<div style="background-image: url(./theme/lightblue/images/icon_sendpassword_details.png); float: left; height: 36px; width: 32px;"></div>
								<div style="float: left; height: 36px; line-height: 36px; font-family: arial; font-size: 13px; padding-left: 10px;"><?php echo $messages_translation['link']['connection']['lose_password']; ?></div>
							</div>
							
							<div class="clearFloat"></div>
							
							<div style="height: 36px;">	
								<div style="background-image: url(./theme/lightblue/images/icon_inscription_details.png); float: left; height: 36px; width: 32px;"></div>
								<div style="float: left; height: 36px; line-height: 36px; font-family: arial; font-size: 13px; padding-left: 10px;"><a href="./inscription.php"><?php echo $messages_translation['link']['connection']['inscription']; ?></a></div>
							</div>
							
							<div class="clearFloat"></div>
							
						</form>
					</div>
					<div style="clear: left;">
					</div>
				</div>
			</div>
			<?php } ?>
			
		</div>
		
		<!-- PIED DE PAGE !-->
		<div id="footer">
			<div class="center">
				<div class="creativeCommonsLogo"></div>
				<div style="clear:both;"></div>
			</div>
		</div>
    </body>
</html>