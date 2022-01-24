<?php

// Retourne la valeur false en cas d'echec true en cas de reussite

// Fil d'ariane (mie de pain)
function breadcrumb($nodeStart, $id=NULL) {
	
	// si pas de node start ou si node start pas relatif a id, alors reprendre un des nodestart indiqu au plus haut 
	
	// sinon node start ok alors tracer depuis node start indiqué
	
	try {
		include("./functions/functions_db.php");
		$stmt = $db->prepare('SELECT * FROM menu WHERE categoryId=:categoryId AND hidden=0');
		$stmt->execute(array('categoryId' => $nodeStart));
		
		while ($data = $stmt->fetch()) {
			breadcrumb($data['node']);
			$stmt2 = $db->prepare('SELECT * FROM menu WHERE node=:node AND hidden=0');
			$stmt2->execute(array('node' => $data['node']));
			if ($data['node'] > 0) {
				echo "<li>
					<ul class='menu'>";
						while ($data2 = $stmt2->fetch()) {
							echo '<li><a href="">'.$data2['name'].'</a></li>';
						}
					echo "</ul>
					<a href='?cat=".$data['categoryId']."'>".$data['name']."</a><span></span>
				</li>";
			}
		}
		
		$stmt->closeCursor();
		
	} catch (Exception $e) {
		viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
		die(); // Arrêt du script
	}
	
	if ($id!=NULL) {
		
		if (!pageError($id, false)) {
			
			try {
				include("./functions/functions_db.php"); // Connexion à la base de donnees		
				$sql  = "SELECT title 
						FROM pages_index
						WHERE pageId=:pageId";
				$stmt = $db->prepare($sql);
				$stmt->execute(array('pageId' => $id));
				$data = $stmt->fetch(0);
				$stmt->closeCursor();
			
			} catch(Exception  $e) {
				viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
				die(); // Arrêt du script
			}
			
			echo "<li><a>".$data['title']."</a><span></span></li>";
		}
	}

	
}

?>

<!-- Affichage du fil d'ariane en html !-->
<!--
<div id="breadcrumb">
	<ul>
		<?php breadcrumb($cat, $id); ?>
	</ul>
</div>
!-->