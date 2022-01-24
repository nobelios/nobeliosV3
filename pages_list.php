<?php

$trad_i[''][''] = "";


$categoryList = array();

$categoryList[0][0] = "chimie";
$categoryList[0][1] = "inorganique";
$categoryList[0][2] = "organique";
$categoryList[0][3] = "donnees";
$categoryList[0][4] = "analyses";

$categoryList[1][0] = "electronique";
$categoryList[1][1] = "circuits et montages";
$categoryList[1][2] = "theory et cours"; 

// Si affichage par catégorie
if (isset($_GET['cat'])) {
	$getArrayPosition = explode(":", $_GET['cat']);
	// Test si la catégorie existe
	if (isset($categoryList[$getArrayPosition[0]][$getArrayPosition[1]])) {
		$elements[0]="Accueil";
		$category = $categoryList[$getArrayPosition[0]][0]; // Catégorie
		$elements[1]= $category;
		if ($getArrayPosition[1] != 0) {
			$subCategory = $categoryList[$getArrayPosition[0]][$getArrayPosition[1]];	// Sous catégorie
			$elements[2]= $subCategory;
		}
	} else {
		echo "erreur";
	}
}

// Fil d'ariane (mie de pain)
function breadcrumb($array) {
	foreach ($array as $key => $value) {
		// Première cellule
		if ($key==0) {
			echo "<ul><li class='begin'><a class='begin'>".$value."</a><span></span></li>";
		// Intercellules
		} elseif ($key<count($array)-1) {
			echo "<li><a>".$value."</a><span></span></li>";
		// Dernière cellule
		} else {
			echo "<li class='end'><a>".$value."</a><span class='end'></span></li></ul>";
		}	
	}
	unset($value); // Desctruction de la dernières valeur retournée; 
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
		
			<!-- linker (ariane navigation) !-->
			<div class="linker">
				<div class="container">
					<div class="linkerback">
						<?php breadcrumb($elements); ?>
					</div>
				</div>
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