<?php

//-----------------------------------------------------------------
// INCLUSIONS UNIQUES
//-----------------------------------------------------------------
include_once("./functions/functions_debug.php"); 			// Messages erreurs base de donnees
include_once("./login/session_control.php");				// Permet le contrôle des utilisateurs (pour savoir si l'utilisateur est déjà connecté)
include_once("./functions/functions_anti_robot.php");		// Module de protection contre le spam robot
include_once("./functions/functions_key_generator.php");    // Générateur de clefs et de codes (pour les clefs de validation)
include_once("./language/french.php");						// Affichage des messages en français
include_once("./functions/functions_pages_control.php");    // Verification au sujet de l'existance des pages

// Si affichage par catégorie
if (isset($_GET['cat']) && ($_GET['cat'] > 0) && ($_GET['cat'] < 100)) {
	$cat=htmlspecialchars($_GET['cat']);
} else {
	$cat=0;
}

if (isset($_GET['id'])) {
	$id=htmlspecialchars($_GET['id']);
} else {
	$id=0;
}

// Listing des menus au point de cardinalité n contenant les points n+1
function menuNodeListing($nodeStart) {
	// Connexion à la base des utilisateurs
	try {
		include("./functions/functions_db.php");
		
		$stmt = $db->prepare('SELECT * FROM menu WHERE id=:id AND hidden=0');
		$stmt->execute(array('id' => $nodeStart));
		
		while ($data = $stmt->fetch()) {
			echo '<div class="clearFloat"></div>
				<div class="title">
					<h2>'.$data['name'].'</h2>
				</div>';
		}
		
		$stmt->closeCursor();
		
		$stmt = $db->prepare('SELECT * FROM menu WHERE node=:node AND hidden=0 ORDER BY rank ASC');
		$stmt->execute(array('node' => $nodeStart));
		
		while ($data = $stmt->fetch()) {
			echo '<div class="section">
						<div class="thumb" style="background-image: url(./theme/lightblue/images/'.$data['thumb'].');"></div>
						<div class="text">
							<h2>'.$data['name'].'</h2>
							<p></p>
						</div>
						<a href="./pages_menu.php?cat='.$data['id'].'" style="position: absolute; width: 334px; height: 100px; margin: -10px 0 0 -10px;"></a>
					</div>';
		}
		
		$stmt->closeCursor();
		
	} catch (Exception $e) {
		viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
	}
}

	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>[*]Title</title>
		<!-- Feuilles de style !-->
		<link rel="stylesheet" href="./theme/lightblue/css/general.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/intro.css" type="text/css" /> <!-- Gestion des champs de formulaire et des légendes !-->
		<link rel="stylesheet" href="./theme/lightblue/css/form.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/connection.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/breadcrumb.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/page_display.css" type="text/css" />
	</head>
	
    <body style="margin: 0px; padding: 0px; background-color: #025ea9;">
	
		<!--  Header !-->
		<div id="miniHeader">
			<div class="center">
				<div class="logo"></div>
			</div>
		</div>
		
		<!-- Body !-->
		<div id="content">
		
			<div style="width: 1024px; margin: auto;">
			
				<?php if (isset($_GET['id'])) { ?>
				
					<?php if (!pageError($id)) { ?>
					
						<?php
							include_once("fil_ariane.php");
							include_once("page_reader.php");
						?>
					
					<?php } ?>
					
				<?php } else { ?>
				
					<?php include_once("fil_ariane.php"); ?>
					
					<?php
						$view = "menu";
						if ($view == "menu") {
							include_once("menu.php");
							include_once("page_liste.php");
						} else {
							include_once("lire_page.php");
						}
					?>
				
				<?php } ?>
			</div>
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