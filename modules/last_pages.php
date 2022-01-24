<?php


// Récupération des données de la page
try {
	include("./functions/functions_db.php"); // Connexion à la base de donnees		
	$sql  = "SELECT *
			FROM users
			INNER JOIN pages_index
			ON pages_index.author = users.userId
			ORDER BY creationDate DESC";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	
	$data = $stmt->fetch(0);
	
	$data['pageId'];
	$data['title'];
	$data['creationDate'];
	$data['image'];
	//$data['gauges'];
	$data['author'];
	$data[''];
	
	// Conditions d'affichage à intégrer dans la requette de la BDD
	$data['pointedVersion'];
	$data['publicationState'];
	$data['hidden'];
	$data['special'];
	
	$stmt->closeCursor();
	
	// Récupération des jauges
	$stmt = $db->query('SELECT * FROM gauges');
	$gaugeList = array();
	
	while ($data2 = $stmt->fetch()) {
		$gaugeList[$data2['gaugeId']] = $data2['name'];
	}
	
	$stmt->closeCursor();

} catch(Exception  $e) {
	viewCatchedError($e->getMessage(), $e->getCode(), $e->getLine(), $e->getFile());
	die(); // Arrêt du script
}

?>


<div class="module_100">
	<div class="boxContent">
		<h1>actualité</h1>
	</div>
	<div class="module_66">
		<div class="boxContent">
			<!--
			__ recherche time(jour, mois, annee)
			__ recherche titre
			__ recherche id pour lien
			__ recherche auteur
			__ recherche tag
			__ recherche abstract + image
			!-->
		
			<div style="float: left; color: #444444;" class="date_wrapper">
				<div class="day"><?php echo date("d", $data['creationDate']); ?></div>
				<div class="year"><?php echo date("o", $data['creationDate']); ?></div>
				<div class="month"><?php echo $language_month[date("n", $data['creationDate'])]; ?></div>
			</div>
			
			<div class="article_header">
				<h2><a href="?article&amp;id=<?php echo $data['pageId'];?>"><?php echo $data['title'];?></a></h2>
				<p>
					<a href="?user$amp;id=<?php echo $data['author'];?>"><?php echo $data['author'];?></a><br />
					chimie organique, colorants azoiques, colorants jaunes
				</p>	
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="content">
				<!--<h3>Abstract</h3>!-->
				<p style="text-align: justify; font-size: 12px;"> 	
					<img style="float: left; margin-right: 10px; max-height: 200px;" src="./ressources/images/SDC11047.jpg"/>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, 
					adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, 
					euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet 
					erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus 
					volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu 
					enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices 
					posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam 
					sodales hendrerit.Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. 
					Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae 
					ligula. Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam. Integer quis metus 
					vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
				</p>
			</div>
		</div>
		
	</div>
	
	<div class="module_34">
		<div class="boxContent">
			
			 <!--
			__ recherche time(jour, mois, annee)
			__ recherche titre
			__ recherche id pour lien
			__ recherche image back_mini_list
			!-->
			
			<?php
			// Lister les pages
			
			
			
			?>

			<div class="content">
				<div class="date_wrapper">	
					<div class="day">15</div>
					<div class="year">2014</div>
					<div class="month"><?php echo $language_month[02]; ?></div>
				</div>
				<h3 style="margin: -70px 0 0 85px;">Titre de l'article</h3>
			</div>	
			<div class="content">
				<div class="date_wrapper">	
					<div class="day">15</div>
					<div class="year">2014</div>
					<div class="month"><?php echo $language_month[02]; ?></div>
				</div>
				<h3 style="margin: -70px 0 0 85px;">Titre de l'article</h3>
			</div>	
			<div class="content">
				<div class="date_wrapper">	
					<div class="day">15</div>
					<div class="year">2014</div>
					<div class="month"><?php echo $language_month[02]; ?></div>
				</div>
				<h3 style="margin: -70px 0 0 85px;">Titre de l'article</h3>
			</div>	
			<div class="content">
				<div class="date_wrapper">	
					<div class="day">15</div>
					<div class="year">2014</div>
					<div class="month"><?php echo $language_month[02]; ?></div>
				</div>
				<h3 style="margin: -70px 0 0 85px;">Titre de l'article</h3>
			</div>	
			<div class="content">
				<div class="date_wrapper">	
					<div class="day">15</div>
					<div class="year">2014</div>
					<div class="month"><?php echo $language_month[02]; ?></div>
				</div>
				<h3 style="margin: -70px 0 0 85px;">Titre de l'article</h3>
			</div>			

			
			<!--
			<div class="content">
				<div style="background-color: white; opacity: 0.6; height: 80px; width: 85px; position: absolute; margin: -5px 0 0 -5px;"></div>
				<div class="date_wrapper" style="color: #444444;">
					<div class="day">15</div>
					<div class="year">2014</div>
					<div class="month"><?php //echo $language_month[02]; ?></div>
				</div>
			</div>
			!-->
			
		</div>
	</div>
</div>