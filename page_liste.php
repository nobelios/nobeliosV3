<?php


// Variables , peu itules
// $dbTableMenu		 = 'menu';
// $dbTablePagesIndex	 = 'pages_index';

// Récupération des catégories
function listPages() {
	if (!empty($_GET['cat'])) {
		
		// Protection des variables
		$securedCategory = htmlspecialchars($_GET['cat']);
		
		// Test si la catégorie existe
		try {
			include("./functions/functions_db.php");
			$stmt = $db->prepare('SELECT COUNT(*) FROM menu WHERE categoryId=:categoryId AND hidden=0');
			$stmt->execute(array('categoryId' => $securedCategory));
			$categoryExist = $stmt->fetchColumn();
			$stmt->closeCursor();
		} catch (Exception $e) {
			viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
		}
		
		// La catégorie existe
		if ($categoryExist != 0) {
			
			//echo "la catégorie existe ! - ligne 25";
			
			// Recherche des pages
			
			// Ajouter tri et organisation
			// - Tri selon colonne
			// - asc - desc
			
			
			
			// Squelete de la table jointe
			// SELECT pages_index.title, pages_index.gauges, pages_index.creationDate, pages_index.author, users.login
			// FROM users
			// INNER JOIN pages_index
			// ON pages_index.author = users.userId
			
			
			
			try {
				include("./functions/functions_db.php");
				// Récupération des jauges
				$stmt = $db->query('SELECT * FROM gauges');
				$gaugeList = array();
				
				while ($data = $stmt->fetch()) {
					$gaugeList[$data['gaugeId']] = $data['name'];
				}
				
				// Liaison des tables en interne
				$stmt = $db->prepare('
				SELECT pages_index.title, pages_index.pageId, pages_index.thumb, pages_index.gauges, pages_index.creationDate, pages_index.author, users.login
				FROM users
				INNER JOIN pages_index
				ON pages_index.author = users.userId
				WHERE categoryId 
				REGEXP :securedCategory 
				AND hidden=0');
				
				$exp = '(^|_)'.$securedCategory.'($|_)'; // rien ou tiret avant le nombre rien ou tiret après le nombre
				$stmt->bindValue('securedCategory', $exp, PDO::PARAM_STR);
				$stmt->execute();
				
				$resultCounter = 0;
				
				while ($data = $stmt->fetch()) {
					
					if (!pageError($data['pageId'], false)) {
					
						echo '<div class="pageListBig">
							<div class="thumb" style="background-image: url(./ressources/thumb/'.$data['thumb'].'.jpg);"></div>
							<div class="text">
								<h2>'.$data['title'].'</h2>';
								
								// Récupération des jauges
								if ($data['gauges'] != NULL) { 												// Test si on trouve une gauge
									$gaugeIdTable = explode("_", $data['gauges']);							// On place les jauges dans un tableau
									foreach ($gaugeIdTable as $gaugeId) {									// Lister le tableau
										$gaugeValue = explode("=", $gaugeId);								// Séparation de l'id de la jauge et de sa valeur
										// Affichage des jauges
										echo '<div class="level"><div class="legend">'.$gaugeList[$gaugeValue[0]].'</div><div class="gauge" style="background-position: 0px -'. $gaugeValue[1]*14 .'px"></div></div>';
									}
								}
								
								if ($data['login'] != NULL) {
									echo '<p>Le '.date("d.m.y", $data['creationDate']).' par '.$data['login'].'</p>';
								} else {
									echo '<p>Le '.date("d.m.y", $data['creationDate']).'</p>';
								}
								
							echo '</div>
							<a href="./page_menu.php?cat='.$securedCategory.'&amp;id='.$data['pageId'].'" style="display: block; position: relative; height: 100%; width: 100%;"></a>
						</div>';
						$resultCounter++;
						
					}
				}
				
				$stmt->closeCursor();
				
				if ($resultCounter == 0) {
					echo "il n'y a aucun résultat";
				}
				
			} catch (Exception $e) {
				viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
			}
			
			
		// La catégorie n'existe pas
		} else {
			//echo "la catégorie n'existe pas ! - ligne 28";
		}	
		
	} else {
	}
}


// Connexion à la base de données pour récupération

?>

<div style="width: 100%;">
	<?php listPages(); ?>
</div>