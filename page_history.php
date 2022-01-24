<?php

// historique des articles

// Récupération des version de la page pointée par l'id
// On sais déjà que l'id de la page existe en bdd et en fichier

// Initialisation des variables
$version_list = null;

// Connexion à la base des utilisateurs
try {
	include("./functions/functions_db.php");
	
	$stmt = $db->prepare('SELECT * FROM pages_history WHERE pageId=:id');
	$stmt->execute(array('id' => $id));	
	
	while ($data = $stmt->fetch()) {
		$version_list .= '
			<div class="version">
				<div class="date_wrapper_time">
					<div class="day">'.date("d", $data['versionDate']).'</div>
					<div class="year">'.date("o", $data['versionDate']).'</div>
					<div class="month">'.$language_month[date("n", $data['creationDate'])].'</div>
					<div class="time">'.date("H\hi", $data['versionDate']).'</div>
				</div>

				<div class="menu">
					<a href="main_page.php?cat=4&amp;id='.$data['pageId'].'&amp;option=history&amp;ver='.$data['versionDate'].'" style="background-image: url(./theme/lightblue/images/icon_option_view_big.png);">consulter</a>
					<a href="main_page.php?cat=4&amp;id='.$data['pageId'].'&amp;option=select&amp;ver='.$data['versionDate'].'" style="background-image: url(./theme/lightblue/images/icon_option_select_big.png);">selectionner</a>
					<a href="main_page.php?cat=4&amp;id='.$data['pageId'].'&amp;option=edit&amp;ver='.$data['versionDate'].'" style="background-image: url(./theme/lightblue/images/icon_option_edit_big.png);">éditer</a>
					<a href="main_page.php?cat=4&amp;id='.$data['pageId'].'&amp;option=delete&amp;ver='.$data['versionDate'].'" style="background-image: url(./theme/lightblue/images/icon_option_delete_big.png);">supprimer</a>
				</div>
				
				<div class="info">
					<p>MODIFICATION - VERIFIE</p>
					<p>Poids: 15ko - Editeur: nobelios - Vérificateur: nobelios</p>
					<p>Actions: ajout image, suppression image, modification du texte</p>
				</div>
			</div>';
	}
	
	$stmt->closeCursor();
	
} catch (Exception $e) {
	viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
}

?>

<!-- CODE HTML !-->

<!-- Titre de l'option !-->
<div style="background-repeat: no-repeat; background-position: 10px 50%; background-image: url(theme/lightblue/images/icon_history_big.png); background-color: #b9b9b9; height: 60px; line-height: 60px; margin-bottom: 10px; padding-left: 70px; color: white; font-size: 1.2em;">
	HISTORIQUE DE L'ARTICLE
</div>

<!-- Séparateur !-->
<hr />

<!-- Affichage de la liste des version !-->
<?php echo $version_list; ?>

<!-- Séparateur !-->
<hr />