<?php

//-----------------------------------------------------------------
// TABLE DE LANGUE (FR)
//-----------------------------------------------------------------
// Message pour les inscriptions
$messages_translation = array();

// ERREURS
// --------------------------------------------------------------------
// Login
$messages_translation['error']['registration']['login_empty'] 			 = "Le champ login doit être rempli.";
$messages_translation['error']['registration']['login_regex'] 			 = "Le login contient des erreurs d'écriture. Il doit être composé de 3 à 16 caractères alphanumériques, les points et les traits d'union sont autorisés.";
$messages_translation['error']['registration']['login_exist'] 			 = "Le login $1 est déjà utilisé.";
$messages_translation['error']['registration']['login_prohibited'] 		 = "Le login $1 est interdit.";
// Email
$messages_translation['error']['registration']['email_empty'] 			 = "Le champ email doit être rempli.";
$messages_translation['error']['registration']['email_regex'] 			 = "L'adresse email contient des erreurs d'écriture. Elle doit se présenter sous la forme nom@nomdedomaine.domaine et être composée de caractères alphanumériques. Les points, les traits d'union et les tirets bas (underscore) sont autorisés.";
$messages_translation['error']['registration']['email_exist'] 			 = "L'adresse $1 est déjà utilisée.";
$messages_translation['error']['registration']['email_prohibited'] 		 = "L'adresse $1 est interdite.";
$messages_translation['error']['registration']['email_junk'] 			 = "Les adresses email jetables ne sont pas autorisées sur ce site.";
$messages_translation['error']['registration']['email_confirm'] 		 = "Les adresses email sont différentes.";
// Password	
$messages_translation['error']['registration']['password_empty'] 		 = "Le champ login doit être rempli.";
$messages_translation['error']['registration']['password_regex'] 		 = "Le mot de passe contient des erreurs d'écriture. Il doit être composé de 8 à 16 caractères alphanumériques. Les points, les traits d'union, les arobases, et les tirets bas (underscore) sont autorisés.";
$messages_translation['error']['registration']['password_confirm'] 		 = "Les mots de passe sont différents.";
// Anti-Robot
$messages_translation['error']['registration']['anti_robot_empty'] 		 = "Vous devez répondre à la question.";
$messages_translation['error']['registration']['anti_robot_regex'] 		 = "La réponse à la question doit être rédigée en chiffres, les valeurs négatives sont acceptées.";
$messages_translation['error']['registration']['anti_robot_wrong'] 		 = "La réponse à la question est incorrecte.";
// Termes d'utilisation
$messages_translation['error']['registration']['terms_of_use_read'] 	 = "Vous devez lire et accepter les termes d'utilisation du site.";
// --------------------------------------------------------------------
// FORMULAIRE
// --------------------------------------------------------------------
$messages_translation['form']['registration']['login_legend'] 			 = "Nom d'utilisateur";
$messages_translation['form']['registration']['email_legend'] 		 	 = "Adresse email";
$messages_translation['form']['registration']['email_confirm_legend'] 	 = "Confirmer email";
$messages_translation['form']['registration']['password_legend'] 		 = "Mot de passe";
$messages_translation['form']['registration']['password_confirm_legend'] = "Confirmer mot de passe";
$messages_translation['form']['registration']['anti_robot_legend'] 		 = "Calculer : ";
$messages_translation['form']['registration']['terms_of_use_legend'] 	 = "J'ai lu et j'accepte les termes d'utilisation du site !";
$messages_translation['form']['registration']['submit_legend'] 			 = "Envoyer";
// --------------------------------------------------------------------
// TITRES
// --------------------------------------------------------------------
$messages_translation['title']['registration']['form_title']			 = "Inscription";
$messages_translation['title']['registration']['already_connected']		 = "Redirection en cours";
$messages_translation['title']['registration']['registration_completed'] = "Inscription terminée";
$messages_translation['title']['registration']['confirmation_request']   = "Demande de confirmation";
$messages_translation['title']['registration']['registration_disabled']  = "Inscriptions désactivées";
// connection
$messages_translation['title']['connection']['email_must_be_validated']	 = "Attente de confirmation";
$messages_translation['title']['connection']['admin_must_approve']       = "Inscription en cours d'approbation";

// --------------------------------------------------------------------
// MESSAGE
// --------------------------------------------------------------------
$messages_translation['message']['registration']['already_connected'] 	   = "Vous êtes déjà connecté, vous allez être redirigé vers l'accueil du site d'ici quelques secondes.";
$messages_translation['message']['registration']['registration_completed'] = "Vous voilà à présent membre de nobelios.com, vous pouvez désormais vous connecter en utilisant le <a href=\"./index.php\">formulaire de connexion</a>.";
$messages_translation['message']['registration']['confirmation_request']   = "Un email vous a été adressé avec un lien de confirmation, vous devez cliquer sur ce dernier afin de valider votre inscription. Envoyer une nouvelle confirmation.";
$messages_translation['message']['registration']['registration_disabled']  = "Les inscriptions étant momentanéments désactivées, nous vous prions de bien vouloir nous en excuser.";
// connection
$messages_translation['message']['connection']['admin_must_approve']  	   = "Votre inscription est en cours d'approbation par l'administration, un email vous informera du refus ou de l'acceptation de cette dernière.";
$messages_translation['message']['connection']['email_must_be_validated']  = "L'administration exige que vous validiez votre adresse email afin de pouvoir vous connecter au site. Un lien de confirmation vous a été envoyé par email à l'adresse indiquée au moment de votre inscription.";

// --------------------------------------------------------------------
// LIENS
// --------------------------------------------------------------------
$messages_translation['link']['connection']['new_validation_email']        = "Envoyer un nouvel email de validation";
$messages_translation['link']['connection']['return']        			   = "Retour";
$messages_translation['link']['connection']['lose_password']  			   = "Vous avez oublié votre mot de passe ?";
$messages_translation['link']['connection']['inscription']  			   = "Vous n'êtes pas encore inscrit ?";

// --------------------------------------------------------------------
// AIDES
// --------------------------------------------------------------------
$messages_translation['help']['registration']['logo_link']			       = "Aller sur la page d'accueil.";


?>