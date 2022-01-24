<?php

// Fonctions de contrôles des pages

// Contrôle existance de la page dans la base de données
function pageExistInDB($pageId) {

	try {
		include("./functions/functions_db.php"); // Connexion à la base de donnees		
		$sql  = "SELECT COUNT(*)
				FROM pages_index 
				WHERE pageId=:pageId";
		$stmt = $db->prepare($sql);
		$stmt->execute(array('pageId' => $pageId));
		
		if ($stmt->fetchColumn()) {
			$stmt->closeCursor();
			return true;  // La page existe dans la base de données
		} else {
			$stmt->closeCursor();
			return false; // Aucune page n'a été trouvée dans la base de données
		}
	
	} catch(Exception  $e) {
		viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
		die(); // Arrêt du script
	}
}

// Contrôle existance de la version de page dans la base de données
function versionExistInDB($pageId, $versionDate) {

	try {
		include("./functions/functions_db.php"); // Connexion à la base de donnees		
		$sql  = "SELECT COUNT(*)
				FROM pages_history 
				WHERE pageId=:pageId
				AND versionDate=:versionDate";
		$stmt = $db->prepare($sql);
		$stmt->execute(array(
			'pageId' => $pageId,
			'versionDate' => $versionDate
		));
		
		if ($stmt->fetchColumn()) {
			$stmt->closeCursor();
			return true;  // La page existe dans la base de données
		} else {
			$stmt->closeCursor();
			return false; // Aucune page n'a été trouvée dans la base de données
		}
	
	} catch(Exception  $e) {
		viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
		die(); // Arrêt du script
	}
}

// Contrôle existance de la version de page dans la base de données
function pageExistInFile($pageId, $versionDate) {

	$path = './pages/'.$pageId;
	if (is_dir($path)) {
		$filename = $path.'/'.$versionDate.'.html';
		if (file_exists($filename)) {
			return true;
		} else {
			return false; // La page -version- n'existe pas
		}
	} else {
		return false; // Le dossier de la page n'existe pas
	}
}

function findPageVersion($pageId) {
	
	try {
		include("./functions/functions_db.php"); // Connexion à la base de donnees		
		$sql  = "SELECT pointedVersion 
				FROM pages_index
				WHERE pageId=:pageId";
		$stmt = $db->prepare($sql);
		$stmt->execute(array('pageId' => $pageId));
		$table = $stmt->fetch(0);
		$stmt->closeCursor();
		return $table['pointedVersion'];
	
	} catch(Exception  $e) {
		viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
		die(); // Arrêt du script
	}
}

// Find page errors
function pageError($id, $error=true) {
	if (pageExistInDB($id)) {
		$pageVersion = findPageVersion($id);
		if (versionExistInDB($id, $pageVersion)) {
			if (pageExistInFile($id, $pageVersion)) {
				return false;
			} else {
				if ($error) echo "Aucune page n'a été trouvé, ou la version n'est plus disponible";
				return true;
			}
		} else {
			if ($error) echo "la version n'existe pas dans la bdd.";
			return true;
		}
	} else {
		if ($error) echo "la page n'existe pas dans la bdd.";
		return true;
	}
}


?>