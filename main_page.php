<!-- CODE PHP !-->

<?php

//-----------------------------------------------
// PAGE PRINCIPALE
// par Geoffrey hautecouverture
// Version mise à jour le 01/09/2013
//-----------------------------------------------

//Table de conversion des mois en Français - A DEPLACER
$language_month = array();
$language_month[1] 	= "JANVIER";
$language_month[2] 	= "FEVRIER";
$language_month[3] 	= "MARS";
$language_month[4] 	= "AVRIL";
$language_month[5] 	= "MAI";
$language_month[6] 	= "JUIN";
$language_month[7]	= "JUILLET";
$language_month[8] 	= "AOUT";
$language_month[9] 	= "SEPTEMBRE";
$language_month[10] = "OCTOBRE";
$language_month[11] = "NOVEMBRE";
$language_month[12] = "DECEMBRE";

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


<!-- CODE HTML !-->

<!doctype html>

<html lang="fr">
	
	<head>
		<meta charset="utf-8" />
		
		<!-- Feuilles de style !-->
		<link href="theme/lightblue/css/dashboard/main.css"         rel="stylesheet" type="text/css" />
		<link href="theme/lightblue/css/general.css" 		        rel="stylesheet" type="text/css" />
		<link href="theme/lightblue/css/breadcrumb.css" 	        rel="stylesheet" type="text/css" />
		<link href="theme/lightblue/css/page_display.css" 	        rel="stylesheet" type="text/css" />
		<link href="theme/lightblue/css/dashboard/menu.css"         rel="stylesheet" type="text/css" />
		<link href="theme/lightblue/css/date.css" 			        rel="stylesheet" type="text/css" />
		<link href="theme/lightblue/css/page.css" 			        rel="stylesheet" type="text/css" />
		<link href="theme/lightblue/css/history_list.css" 	        rel="stylesheet" type="text/css" />
		<link href="theme/lightblue/css/module/last_articles.css" 	rel="stylesheet" type="text/css" />
			
		<title>Panneau de controle</title>
	</head>
	
	<body>
		
		<!-- Contenant ajustable -pour la largeur du site- !-->
		<div id="main_wrapper">	
			
			<!-- ENTETE DE PAGE !-->
			<header>
				<div id="header_wrapper">
					<a class="logo" href="http://nobelios.com"></a>
					
					<!-- MENU UTILISATEUR !-->
					<!--<nav>
						<ul>
							
							<li id="user_btn">
								<img class="avatar" src="theme/lightblue/images/avatar.jpg" alt="" />
								Nobelios
							</li>
							
							<li>
								<ul id="user_menu">
									<li><a href=""><img src="theme/lightblue/images/dashboard_icon.png" alt="" />Tableau de bord</a></li>
									<li><a href=""><img src="theme/lightblue/images/fav_icon.png" alt="" />Favoris</a></li>
									<li><a href=""><img src="theme/lightblue/images/mail_icon.png" alt="" />Messages</a></li>
									<li><a href=""><img src="theme/lightblue/images/parameters_icon.png" alt="" />Paramètres</a></li>
									<li class="separator"></li>
									<li><a href=""><img src="theme/lightblue/images/connection_icon.png" alt="" />Déconnexion</a></li>
								</ul>
							</li>
						</ul>		
					</nav>
					!-->
				</div>
			</header>
			
			<!-- CORP DE LA PAGE !-->
			<div id="body_wrapper">
			
				<!-- FIL D'ARRIANE !-->
				<div id="breadcrumb">

					<ul>
						<li><a href="?cat=1"><img src="theme/lightblue/images/home_icon.png" alt="" title="Accueil" /></a><span class="end"></span></li>
						
						<?php
						
							include_once('./fil_ariane.php');
							breadcrumb($_GET['cat'], $_GET['id']);
						
						?>
					
						<!--
							
							
							/*
							Tracking
							
							1 - récupération id page par get
							2 - récupération category id "pages_index"
							3 - récupération du node le plus élevé
							4 - boucle cheminer node jusqu'à 0 (home)
							
							5 - créer liste à chaque node
							*/
							
							?>

						!-->
					
					</ul>
				</div>
				
				
				<!-- MODULE CONNEXE !-->
			<!--	
				<a href="http://www.nobelios.com/v3/main_page.php?id=FD1FA202AF9E1928">Lien</a>
			!-->				
				
				
				<!-- [END] BLOC ACCUEIL !-->
				
				<!-- [START] partie individuelle !-->
				
				
				<section id="page">

					<?php 
					
					if (isset($_GET['user'])) {
						echo "consulter ficher utilisateur";
					} elseif (isset($_GET['article'])) {
						include("./page_reader.php");
					} else {
						include("./modules/last_pages.php");
					}
					
					
					?>
					
				</section>			
					<!-- LISTER LES ARTICLES AVEC TITRE SEULEMENT !-->
										
					<!-- AFFICHAGE EN GRAND DU RESUME DE LA PAGE !-->
					
					
					<!-- DEPART NEWS !-->


					<!-- FIN NEWS !-->
					
					<!--
					<div class="module_33">
						<div class="boxContent">
							<h1>forum</h1>
						</div>
						<div class="boxContent">
							<div style="height: 200px; background-color: #EAEAEA;"></div>
						</div>
					</div>
					
					<div class="module_33">
						<div class="boxContent">
							<h1>membres</h1>
						</div>
						<div class="boxContent">
							<div style="height: 200px; background-color: #EAEAEA;"></div>
						</div>
					</div>
					
					<div class="module_34">
						<div class="boxContent">
							<h1>outils</h1>
						</div>
						<div class="boxContent">
							<div style="height: 200px; background-color: #EAEAEA;"></div>
						</div>
					</div>
					!-->
					<div style="clear: both;"></div>
					
					
					
					
				
				
				
				
				
				
				<!-- [END] fin partie individuelle !-->
				
			</div>
			
			<!-- PIED DE PAGE !-->
			<footer>
				<div style="width: 1000px; margin: auto;">
					<div style="height: 48px; width: 204px; float: left; background-image: url(theme/lightblue/images/icon_cc_footer.png);"></div>
					<div style="width: 10px; height: 42px; float: left;"></div>
					<div style="height: 48px; width: 42px; float: left; background-image: url(theme/lightblue/images/icon_cc_by_fr_footer.png);"></div>
					<div style="width: 10px; height: 42px; float: left;"></div>
					<div style="height: 48px; width: 42px; float: left; background-image: url(theme/lightblue/images/icon_cc_s_footer.png);"></div>
					<div style="width: 10px; height: 42px; float: left;"></div>
					<div style="height: 48px; width: 42px; float: left; background-image: url(theme/lightblue/images/icon_cc_eq_footer.png);"></div>
					<div style="clear:left;"></div>
					<div style="height: 10px;"></div>
				</div>
			</footer>
			
		</div>
		
	</body>
	
</html>

