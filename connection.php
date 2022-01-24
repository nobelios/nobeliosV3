<?php

	// Noms des tables
	$errorDiv='';
	$connectionStart = false;
	$dbTableUsers = 'users';

	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$emailProtected = htmlspecialchars($_POST['email']);
		$passwordProtected = htmlspecialchars($_POST['password']);
		
		try {
			include_once('./functions/functions_db.php');
			$stmt = $db->query('SELECT COUNT(*) FROM ' . $dbTableUsers . ' WHERE email="' . $emailProtected . '" AND password="' . $passwordProtected . '"');
			$userExist = $stmt->fetchColumn();
			$stmt->closeCursor();
			
		} catch (Exception $e) {
			echo 'Erreur : '.$e->getMessage().'<br />';
			echo 'N° : '.$e->getCode();
		}

		if ($userExist > 0) {
			// Redirection de l'utilisateur
			// Mise en cache des identifiants.
			session_start();
			$_SESSION['userId']="nobelios";
			$connectionStart = true;
		} else {	
			// afficher l'erreur d'identifiant ou mdp
			$errorDiv = '<div style="width: 280px; height: 32px; border: 1px solid #ff8800; background-color: #ffe5c8; line-height: 32px; font-family: arial; font-size: 14px; padding: 0px 10px;">Adresse Email ou mot de passe incorrect</div>
			<div class="formHeightSpacer"></div>';
		}
	}
	
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
    </head>
	
    <body style="margin: 0px; padding: 0px; background-color: #025ea9;">
		<div style="background-color: #025ea9; background-image: url(./theme/lightblue/images/header_details.jpg); height: 180px; border-bottom: 1px solid black;">
			<div style="width: 1024px; margin: auto;">
				<div style="float: left;">
					<div style="height: 120px; width: 400px; background-image: url(./theme/lightblue/images/nobelios_logo_text_details.png); margin: 30px 0px;"></div>
				</div>
				<div style="clear: left;"></div>
			</div>
		</div>
		<div style="background-color: #f7f7f7; border-bottom: 1px solid black;">
			<div style="width: 1024px; margin: auto; ">
				<div style="padding: 50px; width: 680px; height: 300px; margin: auto;">
					<div style="background-image: url(./theme/lightblue/images/nobelios_logo_details.png); float: left; width: 300px; height: 100%;"></div>
					<div style="float: left; width: 330px; height:100px; margin-left:50px; margin-top:50px;">
						<form method="post" action="./index.php">
							<?php echo $errorDiv; ?>
							
							<!-- mot de passe !-->
							<input 
								class="connectionInputWidth" 
								type="text" 
								required="required" 
								aria-required="true" 
								placeholder="Email" 
								name="email" 
							/>
							
							<div class="formHeightSpacer"></div>
							
							<input type="password" style="width: 280px; height: 30px; padding: 0px; margin: 0px; font-family: arial; font-size: 14px; padding: 0px 10px;" required="required" aria-required="true" placeholder="Mot de passe" name="password" />
							<div class="formHeightSpacer"></div>
							<input type="submit" value="Connexion" style="width: 100px; height: 30px; padding: 0px; margin-left: -1px; font-family: arial; font-size: 14px"/>
							<div class="formHeightSpacer"></div>
							<div style="height: 36px;">
								<div style="background-image: url(./theme/lightblue/images/icon_sendpassword_details.png); float: left; height: 36px; width: 50px;"></div>
								<div style="float: left; height: 36px; line-height: 36px; font-family: arial; font-size: 13px; padding-left: 10px;">Vous avez oublié votre mot de passe ?</div>
							</div>
							<div style="clear:left;"></div>
							<div style="height: 36px;">	
								<div style="background-image: url(./theme/lightblue/images/icon_inscription_details.png); float: left; height: 36px; width: 50px;"></div>
								<div style="float: left; height: 36px; line-height: 36px; font-family: arial; font-size: 13px; padding-left: 10px;"><a href="./inscription.php">Vous n'êtes pas encore inscrit ?</a></div>
							</div>
							<div style="clear:left;"></div>
						</form>
					</div>
					<div style="clear: left;">
					</div>
				</div>
			</div>
		</div>
		
		<div style="background-color: #025ea9; height: 100px;">
			<div style="width: 1024px; margin: auto;">
				<div style="height: 20px;"></div>
				<div style="height: 48px; width: 204px; float: left; background-image: url(./theme/lightblue/images/icon_cc_footer.png);"></div>
				<div style="width: 10px; height: 42px; float: left;"></div>
				<div style="height: 48px; width: 42px; float: left; background-image: url(./theme/lightblue/images/icon_cc_by_fr_footer.png);"></div>
				<div style="width: 10px; height: 42px; float: left;"></div>
				<div style="height: 48px; width: 42px; float: left; background-image: url(./theme/lightblue/images/icon_cc_s_footer.png);"></div>
				<div style="width: 10px; height: 42px; float: left;"></div>
				<div style="height: 48px; width: 42px; float: left; background-image: url(./theme/lightblue/images/icon_cc_eq_footer.png);"></div>
				<div style="clear:left;"></div>
			</div>
		</div>
    </body>
</html>