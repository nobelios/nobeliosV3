<?php

//-----------------------------------------------------------------
// INCLUSIONS UNIQUES
//-----------------------------------------------------------------
include_once("./functions/functions_debug.php"); 			// Messages erreurs base de donnees
include_once("./login/session_control.php");				// Permet le contrôle des utilisateurs (pour savoir si l'utilisateur est déjà connecté)
include_once("./functions/functions_anti_robot.php");		// Module de protection contre le spam robot
include_once("./functions/functions_key_generator.php");    // Générateur de clefs et de codes (pour les clefs de validation)
include_once("./language/french.php");						// Affichage des messages en français

// Textes
$termsOfUse 	     = "Contrat d'utilisation du site \n Comportement général sur le site ...";

// Table des adresse email jetables
function junkMail($mail) {
    $domains = array(
		'ephemail.com',				'ephemail.org',			'ephemail.net',
		'jetable.org', 				'jetable.net', '		jetable.com',
		'haltospam.com', 			'tempinbox.com', 		'brefemail.com',
		'0-mail.com', 				'link2mail.net', 		'pjjkp.com',
		'mailexpire.com',	 		'kasmail.com', 			'spambox.info',
		'spambox.us', 				'mytrashmail.com', 		'dontreg.com',
		'maileater.com', 			'guerrillamail.com', 	'guerrillamail.info',
		'guerrillamail.org', 		'iximail.com',			'klassmaster.com',
		'kleemail.com',				'mailin8r.com',			'mailinator.com', 
		'mailinator.net',			'mailinator2.com',		'myamail.com',
		'nyms.net',					'shortmail.net',		'sogetthis.com',
		'spamday.com',				'spamfr.com',			'spamgourmet.com',
		'spammotel.com',			'yopmail.com', 			'yopmail.fr',
		'temporaryinbox.com',		'spamcorptastic.com',	'filzmail.com',
		'lifebyfood.com',			'tempemail.net',		'spamfree24.org',
		'spamfree24.com',			'spamfree24.net',		'spamfree24.de',
		'spamfree24.eu',			'spamfree24.info',		'spamherelots.com',
		'thisisnotmyrealemail.com', 'slopsbox.com',			'trashmail.net',
		'tyldd.com',				'safetymail.info',		'brefmail.com',
		'bofthew.com',				'trash-mail.com
	');

    list($user,$domain) = explode('@',$mail);
    return in_array($domain,$domains);
}

//-----------------------------------------------------------------
// VARIABLES A DECLARER
//-----------------------------------------------------------------

// Variable de paramètres
$registrationEnableF = 1;
$multiAccountEnableF = 0; // Mode multiCompte authorisation d'avoir plusieurs logins avec la même adresse email.
$antiRobotEnableF	 = 1; // Mode antiRobot
$emailRequestEnableF = 1;
$adminRequestEnableF = 1;

// Noms des tables utilisées
$dbTableUsers		 = 'users';
$dbTableFiltering 	 = 'filtering';

// VARIABLES DE CETTE PAGE QUI DEPENDENT DE L'ADMINISTRATEUR REGEX
$loginRegex 		 = "[a-zA-Z0-9\.\-]{3,16}"; // de 4 à 16 caractère alphanumériques et .- et majuscules sans accents
$emailRegex 		 = "[a-z0-9_\.\-]{2,}@[a-z0-9_.-]{2,}\.[a-z]{2,4}"; //format email
$passwordRegex 		 = "[a-zA-Z0-9\@_\.\-]{8,16}"; // de 8 a 16 caractère alphanumériques avec . - _ @ et majuscules
$antiRobotRegex      = "[0-9\-]{1,3}"; // de 1 à 3 chiffres

// Declaration des variables
$newEntry			 = false;
$errorDiv			 = null;

// Declaration des tableaux
$registrationError   = array();


//-----------------------------------------------------------------
// TEST DES DONNEES DU FORMULAIRE
//-----------------------------------------------------------------

// Test si les inscriptions sont activées
if ($registrationEnableF == 1) {

	// Test si le dispositif anti-robots est activé
	if ($antiRobotEnableF == 1) {	
		$antiRobot 					   = isset($_POST['antiRobotResponse']);
		$securedAntiRobotResponse      = htmlspecialchars($_POST['antiRobotResponse']);
	} else {
		$antiRobot 					   = true;
		$securedAntiRobotResponse	   = null;
		$_SESSION['antiRobotResponse'] = null;
	}

	// Test des données envoyées par le formulaire
	if (!empty($_POST['login']) && !empty($_POST['email1']) && !empty($_POST['email2']) && !empty($_POST['password1']) && !empty($_POST['password2']) && $antiRobot) {
		
		$securedLogin 	 	= htmlspecialchars($_POST['login']);
		$securedEmail1		= htmlspecialchars($_POST['email1']);
		$securedEmail2 		= htmlspecialchars($_POST['email2']);
		$securedPassword1	= htmlspecialchars($_POST['password1']);
		$securedPassword2 	= htmlspecialchars($_POST['password2']);
		
		//---------------------------
		// TEST DU LOGIN
		//---------------------------
		// Test de l'ecriture (REGEX)
		if (preg_match('#^'.$loginRegex.'$#', $securedLogin)) {
			
			// Connexion à la base de filtrage
			try {
				include('./functions/functions_db.php');
				$stmt           = $db->query('SELECT COUNT(*) FROM '.$dbTableFiltering.' WHERE type="login" AND value="'.$securedLogin.'"');
				$loginForbidden = $stmt->fetchColumn();
				$stmt->closeCursor();
			} catch (Exception $e) {
				viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
			}
			
			// Test d'autorisation du login
			if ($loginForbidden == 0) {
				
				// Connexion à la base des utilisateurs
				try {
					include('./functions/functions_db.php');
					$stmt       = $db->query('SELECT COUNT(*) FROM '.$dbTableUsers.' WHERE login="'.$securedLogin.'"');
					$loginExist = $stmt->fetchColumn();
					$stmt->closeCursor();
				} catch (Exception $e) {
					viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
				}
				
				// Test de disponibilite du login parmis les utilisateurs
				if ($loginExist != 0) {
					$registrationError[] = preg_replace('/\$1/', $securedLogin, $messages_translation['error']['registration']['login_exist']);
				}
				
			// Le login est interdit	
			} else {
				$registrationError[] = preg_replace('/\$1/', $securedLogin, $messages_translation['error']['registration']['login_prohibited']);
			}
			
		// Erreur d'ecriture
		} else {
			$registrationError[] = $messages_translation['error']['registration']['login_regex'];
		}

		//---------------------------
		// TEST DE L'ADRESSE EMAIL
		//---------------------------
		// Test de l'ecriture (REGEX)
		if (preg_match('#^'.$emailRegex.'$#', $securedEmail1)) {
			
			// Test de correspondance des emails
			if ($securedEmail1 == $securedEmail2) {
				
				// Connexion à la base de filtrage
				try {
					include('./functions/functions_db.php');
					$stmt = $db->query('SELECT COUNT(*) FROM '.$dbTableFiltering.' WHERE  type="email" AND value="'.$securedEmail1.'"');
					$emailForbidden = $stmt->fetchColumn();
					$stmt->closeCursor();
				} catch (Exception $e) {
					viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
				}
				
				// Test d'autorisation de l'adresse email
				if ($emailForbidden == 0) {
					
					if (!junkMail($securedEmail1)) {
					
						// Test si le multi compte est désactivé
						if ($multiAccountEnableF == 0) {
							
							// Connexion à la base des utilisateurs
							try {
								include('./functions/functions_db.php');
								$stmt = $db->query('SELECT COUNT(*) FROM '.$dbTableUsers.' WHERE email="'.$securedEmail1.'"');
								$emailExist = $stmt->fetchColumn();
								$stmt->closeCursor();
							} catch (Exception $e) {
								viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
							}
							
							// Test de disponibilite de l'adresse email parmis les utilisateurs
							if ($emailExist != 0) {
								$registrationError[] = preg_replace('/\$1/', $securedEmail1, $messages_translation['error']['registration']['email_exist']);
							}												
						}
					} else {
						$registrationError[] = $messages_translation['error']['registration']['email_junk'];
					}
				
				// L'adresse email est interdite
				} else {
					$registrationError[] = preg_replace('/\$1/', $securedEmail1, $messages_translation['error']['registration']['email_prohibited']);
				}			
			
			// Les email ne correspondent pas
			} else {
				$registrationError[] = $messages_translation['error']['registration']['email_confirm'];
			}
			
		// Erreur d'ecriture
		} else {
			$registrationError[] = $messages_translation['error']['registration']['email_regex'];
		}
		

		//---------------------------
		// TEST DU MOT DE PASSE
		//---------------------------
		// Test de l'ecriture (REGEX)
		if (preg_match('#^'.$passwordRegex.'$#', $securedPassword1)) {	
			
			// Test de correspondance
			if ($securedPassword1 != $securedPassword2) {
				$registrationError[] = $messages_translation['error']['registration']['password_confirm'];
			}
		
		// Erreur d'ecriture		
		} else {
			$registrationError[] = $messages_translation['error']['registration']['password_regex'];
		}
		
		
		//---------------------------
		// TEST ANTI ROBOT
		//---------------------------
		// Test si le controle anti robot est activé
		if ($antiRobotEnableF == 1) {
			
			// Test de la réponse
			if ($securedAntiRobotResponse != $_SESSION['antiRobotResponse']) {
				$registrationError[] = $messages_translation['error']['registration']['anti_robot_wrong'];
			}
		}
		
		//---------------------------
		// TEST TERMES D'UTILISATION
		//---------------------------
		// Test si les termes d'utilisation sont acceptés
		if (!isset($_POST['termsOfUse']) || ($_POST['termsOfUse'] != "accepted")) {
			$registrationError[] = $messages_translation['error']['registration']['terms_of_use_read'];
		}
		
		//---------------------------
		// AJOUT DU MEMBRE
		//---------------------------
		// Test si l'inscription est valide
		if (count($registrationError) == 0) {
			
			// Génération d'un identifiant
			$userId = randomHex();
			
			// Génération de la clef de validation
			$preKey = md5($securedLogin.$securedEmail1.microtime());
			$emailActivationKey = hash('sha256', $preKey);
			
			// Test si demande de validation par email
			if ($emailRequestEnableF == 1) {
				
				// Envoi de l'email
				$headers ='From: "inscription nobelios"<donotreply@nobelios.com>'."\n";
				$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
				$headers .='Content-Transfer-Encoding: 8bit';
				$message ='Un message de test http://nobelios.com/nobelios%20v3/email_validation.php?id='.$userId.'&amp;key='.$emailActivationKey;
				$subject = 'Inscription';

				if(mail($securedEmail1, $subject, $message, $headers))
				{
				  // echo 'Le message a été envoyé';
				} else {
				
				}
			}
		
			try {
				// Connexion à la base des utilisateurs
				include('./functions/functions_db.php');
				$req = $db->prepare('INSERT INTO '.$dbTableUsers.'(userId, login, email, password, registrationDate, adminActivated, emailActivated, emailActivationKey) VALUES(:userId, :login, :email, :password, :registrationDate, :adminActivated, :emailActivated, :emailActivationKey)');
				$req->execute(array(
						'userId'			 => $userId,
						'login' 			 => $securedLogin,
						'email' 			 => $securedEmail1,
						'password' 			 => $securedPassword1,
						'registrationDate'   => time(),
						'adminActivated'     => $adminRequestEnableF,
						'emailActivated'     => $emailRequestEnableF,
						'emailActivationKey' => $emailActivationKey
					));
			} catch (Exception $e) {
				viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
			}
			$newEntry=true; //Il s'agit d'une nouvelle entrée

		// Des erreurs ont été détectées l'inscription est annulée
		} else {
		
			// afficher les erreurs en liste
			$errorDiv = '<div style="width: 484px; min-height: 32px; border: 1px solid #ff8800; background-color: #ffe5c8; line-height: 20px; font-family: arial; font-size: 14px; padding: 5px 10px;">';
			
			foreach($registrationError as $value) {
				$errorDiv .= $value.'<br />';
			}
			
			$errorDiv .= '</div>
			<div style="height: 10px;"></div>';
		}
	}
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
		
		<!--
		<script type="text/javascript" src="./js/input_placeholder.js"></script>
		<script type="text/javascript">
			
			<!--
			//---------------------------
			// TEST DU LOGIN
			//---------------------------
			function checkLogin() {
				$('#login').css('border','1px solid red');
				$('#submit').attr('disabled', 'disabled');
				
				// Test si champ vide
				if ($('#login').val() != '') {
					
					// Création de l'objet pour l'expression régulière
					var expression = /^<?php echo $loginRegex; ?>$/g;
					var isValid = expression.test($('#login').val());
					// Test de l'ecriture (REGEX)
					if (isValid) {
						//$('#login').setCustomValidity('');
						$('#login').css('border','1px solid blue');
						$('#submit').removeAttr('disabled');

					// Ecriture incorrecte
					} else {
						//$('#login').setCustomValidity("<?php echo $messages_translation['error']['registration']['login_regex']; ?>");
					}
					
				// Le champ est vide
				} else {
					//login.setCustomValidity("<?php echo $messages_translation['error']['registration']['login_empty']; ?>");				
				}
			}
			
			
			//---------------------------
			// TEST DE L'EMAIL
			//---------------------------
			function checkEmail() {
				$('#email1').css('border','1px solid red');
				$('#submit').attr('disabled', 'disabled');
				// email2.setCustomValidity('');

				// Test si champ vide
				if ($('#email1').val() != '') {
					
					// Création de l'objet pour l'expression régulière
					var expression = /^<?php echo $emailRegex; ?>$/g;
					var isValid = expression.test($('#email1').val());
					// Test de l'ecriture (REGEX)
					if (isValid) {
						//$('#login').setCustomValidity('');
						$('#email1').css('border','1px solid blue');
						if ($('#email2').attr('disabled') == 'disabled') { $('#email2').removeAttr('disabled'); }
						
						// Effacement de l'erreur
						//email1.setCustomValidity('');
						
						// Test si email confirmé
						if ($('#email1').val() == $('#email2').val()) {
							$('#submit').removeAttr('disabled');
							$('#email2').css('border','1px solid blue');
						// Email non confirmé
						} else {
							$('#email2').css('border','1px solid red');
							//email2.setCustomValidity("<?php echo $messages_translation['error']['registration']['email_confirm']; ?>");
						}

					// Ecriture incorrecte
					} else {
						//$('#login').setCustomValidity("<?php echo $messages_translation['error']['registration']['login_regex']; ?>");
						$('#email2').attr('disabled', 'disabled');
					}
					
				// Le champ est vide
				} else {
					//login.setCustomValidity("<?php echo $messages_translation['error']['registration']['login_empty']; ?>");
					$('#email2').attr('disabled', 'disabled');					
				}
			}
			

			
			//---------------------------
			// TEST DU MOT DE PASSE
			//---------------------------
			function checkPasswords() {
			
				$('#password1').css('border','1px solid red');
				$('#submit').attr('disabled','disabled');
				// email2.setCustomValidity('');

				// Test si champ vide
				if ($('#password1').val() != '') {
					
					// Création de l'objet pour l'expression régulière
					var expression = /^<?php echo $passwordRegex; ?>$/g;
					var isValid = expression.test($('#password1').val());
					// Test de l'ecriture (REGEX)
					if (isValid) {
						$('#password1').css('border','1px solid blue');
						$('#password2').removeAttr('disabled');
						
						// Effacement de l'erreur
						//password1.setCustomValidity('');
						
						// Test si email confirmé
						if ($('#password1').val() == $('#password2').val()) {
							if ($('#password2').attr('disabled') == 'disabled') $('#password2').removeAttr('disabled');
							
							$('#submit').removeAttr('disabled');
							$('#password2').css('border','1px solid blue');
							//$('#password2').setCustomValidity('');
						// Email non confirmé
						} else {
							$('#password2').css('border','1px solid red');
							//password2.setCustomValidity("<?php echo $messages_translation['error']['registration']['password_confirm']; ?>");
						}

					// Ecriture incorrecte
					} else {
						$('#password2').attr('disabled','disabled');
						//password1.setCustomValidity("<?php echo $messages_translation['error']['registration']['password_regex']; ?>");
					}
					
				// Le champ est vide
				} else {
					$('#password2').attr('type', 'text');
					$('#password2').attr('disabled','disabled');
					//password1.setCustomValidity("<?php echo $messages_translation['error']['registration']['password_regex']; ?>");
				}
			}
			
			
			//---------------------------
			// TEST DE L'ANTIROBOT
			//---------------------------
			function checkAntiRobot() {
				// Si l'anti robot est actif
				if (<?php echo $antiRobotEnableF; ?> == 1) { // appel depuis php
					
					var antiRobotResponse = document.getElementById('antiRobotResponse');
					
					// Test si champ vide
					if (antiRobotResponse.value != '') {
						
						// Création de l'objet pour l'expression régulière
						expression = new RegExp("^<?php echo $antiRobotRegex; ?>$");
					
						// Test de l'ecriture (REGEX)
						if (expression.test(antiRobotResponse.value) == true) {
							antiRobotResponse.setCustomValidity('');
							$('#submit').disabled=false;
						// Ecriture incorrecte
						} else {
							antiRobotResponse.setCustomValidity("<?php echo $messages_translation['error']['registration']['anti_robot_regex']; ?>");
							$('#submit').disabled=true;
						}
						
					// Le champ est vide
					} else {
						antiRobotResponse.setCustomValidity("<?php echo $messages_translation['error']['registration']['anti_robot_empty']; ?>");
						$('#submit').disabled=true;
					}
				}
			}
			
			//---------------------------
			// TEST DES TERMES
			//---------------------------
			function checkTermsOfUse() {
				var termsOfUse = document.getElementById('termsOfUse');
				alert("TEST");
				// Test si la case est cochée
				if (termsOfUse.checked) {
					termsOfUse.setCustomValidity('');
					$('#submit').disabled=false;
				// La case n'est pas cochée
				} else {
					termsOfUse.setCustomValidity("<?php echo $messages_translation['error']['registration']['terms_of_use_read']; ?>");
					$('#submit').disabled=true;
				}
			}
			
			//---------------------------
			// PERMISSION DE VALIDER
			//---------------------------
			
			
			// login.customValidity
			// email1.customValidity
			// email2.customValidity
			// password1.customValidity
			// password2.customValidity
			// antiRobotResponse.customValidity
			
			if (1==1) {
				$('#submit').disabled=false;
			} else {
				$('#submit').disabled=true;
			}
						
			//-->
		</script>
		
		<!-- Feuilles de style !-->
		<link rel="stylesheet" href="./theme/lightblue/css/general.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/intro.css" type="text/css" /> <!-- Gestion des champs de formulaire et des légendes !-->
		<link rel="stylesheet" href="./theme/lightblue/css/form.css" type="text/css" />
	</head>
	
	<body>

		<!--  Header !-->
		<div id="miniHeader">
			<div class="center">
				<div class="logo"><a class="logoLink" href="./index.php" title="<?php echo $messages_translation['help']['registration']['logo_link']; ?>"></a></div>
			</div>
		</div>
		
		<!--  Body !-->
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
					
				<div class="center">
					<div id="alertBox">
						<div class="logo"></div>
						<div class="text">					
							<h2><?php echo $messages_translation['title']['registration']['confirmation_request']; ?></h2>
							<p><?php echo $messages_translation['message']['registration']['confirmation_request']; ?></p>
						</div>
					</div>
				</div>
		
			<!-- FORMULAIRE D'INSCRIPTION !-->		
			<?php } elseif ($registrationEnableF == 1) { ?>
			
				<div class="center">
					<div id="inscription">
						<form method="post" action="./inscription.php">
							<h2><?php echo $messages_translation['title']['registration']['form_title'];?></h2>
							<div class="formHeightSpacer"></div>
							<?php echo $errorDiv; ?>
							<div class="formColumn">
								
								<!-- login !-->
								<input 
									class="inscriptionInputWidth"
									type="text"
									id="login" 
									oninput="checkLogin()" 
									name="login" 
									maxlength="40"
									placeholder="<?php echo $messages_translation['form']['registration']['login_legend']; ?>"
									pattern="<?php echo $loginRegex; ?>"
									autocomplete="off"
								/>
									
								<div class="formHeightSpacer"></div>
								
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
								
								<div class="formHeightSpacer"></div>
								
								<!-- confirmation email !-->
								<input 
									class="inscriptionInputWidth" 
									type="email"
									id="email2" 
									oninput="checkEmail()" 
									name="email2" 
									maxlength="40"
									placeholder="<?php echo $messages_translation['form']['registration']['email_confirm_legend']; ?>"
									pattern="<?php echo $emailRegex; ?>"
									autocomplete="off"
								/>
								
								<div class="formHeightSpacer"></div>
								
								<!-- mot de passe !-->						
								<input 
									class="inscriptionInputWidth"
									type="password"
									id="password1" 
									oninput="checkPasswords()" 
									name="password1"
									maxlength="40"									
									placeholder="<?php echo $messages_translation['form']['registration']['password_legend']; ?>"
									pattern="<?php echo $passwordRegex; ?>"
									autocomplete="off"
								/>
							
								<div class="formHeightSpacer"></div>
								
								<!-- confirmation mot de passe !-->
								<input
									class="inscriptionInputWidth"
									type="password"
									id="password2" 
									oninput="checkPasswords()" 
									name="password2"
									maxlength="40"									
									placeholder="<?php echo $messages_translation['form']['registration']['password_confirm_legend']; ?>"
									pattern="<?php echo $passwordRegex; ?>"
									autocomplete="off"
								/>

							   
								<?php if ($antiRobotEnableF == 1) { ?>
									<div class="formHeightSpacer"></div>
									
									<!-- anti-robot !-->
									<div style="float: left; height: 32px; line-height: 32px;">
										<?php 
											echo $messages_translation['form']['registration']['anti_robot_legend'];
											antiRobotQuestion();
										?>
									</div>
									<div style="float: right;">
										<input
											class="inscriptionInputAntiRobotWidth"
											type="text"
											id="antiRobotResponse" 
											oninput="checkAntiRobot()" 
											name="antiRobotResponse"
											maxlength="3"
											pattern="<?php echo $antiRobotRegex; ?>"
											autocomplete="off"
										/>
									</div>
								<?php } ?>
								
								<div style="clear: left;"></div>
							</div>
							<div class="logoColumn"></div>
							<div style="clear: left"></div>
							<div class="formHeightSpacer"></div>
							
							<!-- termes d'utilisation !-->
							<textarea class="inscriptionTextareaTermsOfUse" readonly="readonly"><?php echo $termsOfUse; ?></textarea>
							
							<div class="formHeightSpacer"></div>
							
							<!-- checkbox termes d'utilisation !-->
							<input
								type="checkbox" 
								name="termsOfUse" 
								id="termsOfUse" 
								onclick="checkTermsOfUse()" 
								value="accepted"
							/>
							
							<?php echo $messages_translation['form']['registration']['terms_of_use_legend']; ?>
							
							<div class="formHeightSpacer"></div>
							
							<!-- envoyer !-->
							<input 
								type="submit" 
								id="submit" 
								value="<?php echo $messages_translation['form']['registration']['submit_legend']; ?>" 
							/>
							
							<div class="formHeightSpacer"></div>
						</form>
					</div>
				</div>
				
				<!--[if lt IE 10]>
					<script type="text/javascript" >
						Placeholder.init({
							classFocus: "normal",
							classBlur:  "placeholder",
							wait: true
						});
					</script>
				<![endif]-->
			
			<!--  INSCRIPTIONS DESACTIVEES !-->		
			<?php } else { ?>
			
				<div class="center">
					<div id="alertBox">
						<div class="logo"></div>
						<div class="text">	
							<h2><?php echo $messages_translation['title']['registration']['registration_disabled']; ?></h2>
							<p><?php echo $messages_translation['message']['registration']['registration_disabled']; ?></p>
						</div>
					</div>
				</div>
				
			<?php } ?>

		</div>
		
		<div id="footer">
			<div class="center">
				<div class="creativeCommonsLogo"></div>
				<div class="html5Css3Logo"></div>
				<div style="clear:both;"></div>
			</div>
		</div>
		
    </body>
</html>
