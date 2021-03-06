<?php

//-----------------------------------------------------------------
// INCLUSIONS UNIQUES
//-----------------------------------------------------------------
include_once("./functions/functions_debug.php"); // Messages erreurs base de donnees
include_once("./login/session_control.php");     // Permet le contrôle des utilisateurs (pour savoir si l'utilisateur est déjà connecté)
$dbTableUsers = 'users';

// --------------------------------------------------------------------
// TITRES
// --------------------------------------------------------------------
$messages_translation['title']['registration_validation'][''] = "Activation impossible";
$messages_translation['title']['registration_validation'][''] = "Activation terminée";
// --------------------------------------------------------------------
// MESSAGE
// --------------------------------------------------------------------
$messages_translation['message']['registration_validation'][''] = "La clef n'existe pas, ou le compte à déjà été activé. Pour renvoyer un mail cliquer ici.";
$messages_translation['message']['registration_validation'][''] = "";


// Titre de la page
$pageTitle = "Validation de l'adresse email";



//-----------------------------------------------------------------
// CODE PRINCIPAL
//-----------------------------------------------------------------

// validation d'un compte par email
if (!empty($_GET['id']) && !empty($_GET['key'])) {
	
	$securedUserId = htmlspecialchars($_GET['id']);
	$securedEmailActivationKey = htmlspecialchars($_GET['key']);
	
	// Connexion à la base des requetes
	try {
		include('./functions/functions_db.php');
		$stmt = $db->query('SELECT COUNT(*) FROM '.$dbTableUsers.' WHERE userId="'.$securedUserId.'" && emailActivationKey="'.$securedEmailActivationKey.'"');
		$ableToValidate = $stmt->fetchColumn();
		if ($ableToValidate != 0) {
			// Activation prise en compte
			echo "activation terminée";
			$stmt = $db->query('UPDATE '.$dbTableUsers.' SET emailActivated="0"  WHERE userId="'.$securedUserId.'"');
		} else {
			echo "echec activation";
		}
		$stmt->closeCursor();
		
	} catch (Exception $e) {
		viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
	}

} else {
	echo "redirection";
}

?>

<!DOCTYPE html>
<html>
	
    <head>
        <meta charset="utf-8" />
        <title>[*]Titre</title>
		
		<?php if ($userLogged==true) {echo '<meta http-equiv="refresh" content="3; URL=./intro.php">';} ?>
		
		<!--[if lt IE 9]>
			<script type="text/javascript" src="./js/jquery_1.9.1.js"></script>
		<![endif]-->
		<!--[if gte IE 9]>
			<script type="text/javascript" src="./js/jquery_2.0.1.js"></script>
		<![endif]-->
		<!--[if !IE]><!-->
			<script type="text/javascript" src="./js/jquery_2.0.1.js"></script>
		<!--<![endif]-->
		
		<script type="text/javascript" src="./js/input_placeholder.js"></script>
		
		<!-- Feuilles de style !-->
		<link rel="stylesheet" href="./theme/lightblue/css/general.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/intro.css" type="text/css" /> <!-- Gestion des champs de formulaire et des légendes !-->
		<link rel="stylesheet" href="./theme/lightblue/css/form.css" type="text/css" />
	</head>
	
	<body>
	
		<!--  HEADER !-->
		<div id="miniHeader">
			<div class="center">
				<div class="logo"><a class="logoLink" href="./index.php" title="<?php echo $messages_translation['help']['registration']['logo_link']; ?>"></a></div>
			</div>
		</div>
		
		<!--  BODY !-->
		<div id="content">
			
			<!--  UTILISATEUR DEJA CONNECTE !-->			
			<?php if ($userLogged==true) { ?>
					
				<div class="center">
					<div id="alertBox">
						<div class="logo"></div>
						<div class="text">
							<h2><?php echo $messages_translation['title']['registration']['already_connected']; ?></h2>
							<p><?php echo $messages_translation['message']['registration']['already_connected']; ?></p>
						</div>
					</div>
				</div>
			
			<!--  INSCRIPTION EST TERMINE !-->		
			<?php } elseif (($newEntry==true) && ($emailRequestEnableF==0)) { ?>
					
				<div class="center">
					<div id="alertBox">
						<div class="logo"></div>
						<div class="text">					
							<h2><?php echo $messages_translation['title']['registration']['registration_completed']; ?></h2>
							<p><?php echo $messages_translation['message']['registration']['registration_completed']; ?></p>
						</div>
					</div>
				</div>
				
			<!-- EMAIL ENVOYE + DEMANDE !-->		
			<?php } elseif (($newEntry==true) && ($emailRequestEnableF==1)) { ?>
			<?php } else {} ?>		
				<div class="center">
					<div id="alertBox">
						<div class="logo"></div>
						<div class="text">					
							<h2><?php echo $messages_translation['title']['registration']['confirmation_request']; ?></h2>
							<p><?php echo $messages_translation['message']['registration']['confirmation_request']; ?></p>
						</div>
					</div>
				</div>
		
				<div class="formHeightSpacer"></div>
				<form>
				<!-- email !-->
				<input 
					class="inscriptionInputWidth"
					type="email"
					id="email1" 
					oninput="checkEmail()" 
					name="email1" 
					maxlength="40"
					placeholder="<?php echo $messages_translation['form']['registration']['email_legend']; ?>"
					pattern="<?php echo $emailRegex; ?>"
					autocomplete="off"
				/>
				</form>

		</div>
		
		<!-- PIED DE PAGE !-->
		<div id="footer">
			<div class="center">
				<div class="creativeCommonsLogo"></div>
				<div class="html5Css3Logo"></div>
				<div style="clear:both;"></div>
			</div>
		</div>
		
    </body>
</html>