
<?php

// Récupération des données de la page
try {
	include("./functions/functions_db.php"); // Connexion à la base de donnees		
	$sql  = "SELECT *
			FROM users
			INNER JOIN pages_index
			ON pages_index.author = users.userId
			WHERE pageId=:pageId";
	$stmt = $db->prepare($sql);
	$stmt->execute(array('pageId' => $id));
	
	$data = $stmt->fetch(0);
	
	$data['title'];
	$titleImage = $data['image'];
	$data['gauges'];
	$data['author'];
	$data['creationDate'];
	$data['pointedVersion'];
	$data['creationDate'];
	$data['publicationState'];
	$viewHidden=$data['hidden'];
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

$path = './ressources/title_images';
$titleImage = $path.'/'.$titleImage;
if (!file_exists($titleImage)) $titleImage = './theme/lightblue/images/no_thumbnail.png';
else $titleImage;

// FONCTION DE CREATION DE SOMMAIRE
function makeSummary($link) {
	
	if (!$fp = fopen($link,"r")) {
		echo "Echec de l'ouverture du fichier";
		exit;
	}

	else {
	
		echo '<div id="summary" class="ac-container">
			<input id="ac-1" name="summary" type="checkbox" />
			<label for="ac-1">SOMMAIRE</label>
			<section class="ac-small">
				<ol>';
			
		while (!feof($fp)) { // toutes les lignes
			$page .= fgets($fp, 4096); // lecture du contenu de la ligne
		}
		
		preg_match_all(
			"|<(h[2-4]{1})>(.*)</h[2-4]{1}>|U",
			$page,
			$out,
			PREG_PATTERN_ORDER
		);
		
		$id_count = null;
		$return = 2;
		$last_key = null;
		
		foreach($out[2] as $key=>$value) {
			$id_count++;
			
			if ($out[1][$key] == "h2") {
				if ($out[1][$key+1] != "h2") {
					echo '<li><a href="#' . $id_count . '">'.$value.'</a>';
					if ($out[1][$key+1] != null) {
						echo '<ol>';
					}
				} else {
					echo '<li><a href="#' . $id_count . '">'.$value.'</a></li>';
				}
			} elseif ($out[1][$key] == "h3") {
				if ($out[1][$key+1] == "h4") {
					echo '<li><a href="#' . $id_count . '">'.$value.'</a><ol>';
				} else {
					echo '<li><a href="#' . $id_count . '">'.$value.'</a></li>';
					if ($out[1][$key+1] == "h2") {
						echo '</ol></li>';
					}		
				}	
			} else {
				if ($out[1][$key+1] == "h4") {
					echo '<li><a href="#' . $id_count . '">'.$value.'</a></li>';
				} elseif ($out[1][$key+1] == "h3") {
					echo '<li><a href="#' . $id_count . '">'.$value.'</a></li></ol></li>';	
				} else {
					echo '<li><a href="#' . $id_count . '">'.$value.'</a></li></ol></li></ol></li>';
				}
			}
		}
		
		echo '</ol>
				</section>
			</div>
		</div>';
	}
}

// Remplacement des titres

function autoId($match) {
	global $id_count;
	$id_count++;
	return "<".$match[2]." id=". $id_count .'>';
}

function titre_remplace($link) {
	if (!$fp = fopen($link,"r")) {
		echo "Echec de l'ouverture du fichier";
		exit;
	} else {
		while (!feof($fp)) { // toutes les lignes
			$page .= fgets($fp, 4096); // lecture du contenu de la ligne
		}
		$page = preg_replace_callback('|(.*)<(h[2-4]{1})>(.*)|U', 'autoId', $page);
		
		function hello() {
			echo "hello";
		}
	}
	return $page;
}

?>


<?php if($data['hidden']==0 || $viewHidden==1) { ?>

	<?php 
	if(isset($_GET['action'])) {
		
		if ($_GET['action'] == 'history') {
			include_once("page_history.php");
		} elseif ($_GET['action'] == 'config') {
			include_once("page_config.php");
		} elseif ($_GET['action'] == 'edit') {
			include_once("page_editor.php");
		} elseif ($_GET['action'] == 'delete') {
			include_once("page_delete.php");
		} elseif ($_GET['action'] == 'print') {	
			include_once("page_print.php");
		} elseif ($_GET['action'] == 'pdf') {	
			include_once("page_pdf.php");
		} else {
			echo "ACTION INCONNUE !";
		}
	
	} else { 
	?>
	
	<!--
	
	<div class="pageViewHeader">
		<div class="thumb" style="background-image: url(<?php echo $thumbnail; ?>);"></div>
		<div class="text">
			<h2><?php echo $data['title']; ?></h2>
			<?php
				// Récupération des jauges
				if ($data['gauges'] != NULL) { 												// Test si on trouve une gauge
					$gaugeIdTable = explode("_", $data['gauges']);							// On place les jauges dans un tableau
					foreach ($gaugeIdTable as $gaugeId) {									// Lister le tableau
						$gaugeValue = explode("=", $gaugeId);								// Séparation de l'id de la jauge et de sa valeur
						// Affichage des jauges
						echo '<div class="level"><div class="legend">'.$gaugeList[$gaugeValue[0]].'</div><div class="gauge" style="background-position: 0px -'. $gaugeValue[1]*14 .'px"></div></div>';
					}
				}
			?>
			<br />
			<p>
				Mots-clés:  
				<?php $table = explode("_", $data['keywords']); 
					foreach($table as $value) {
						echo '<a href="?kwd='.$value.'">'.$value.'</a>, ';
					}
				?><br />
				Page créer le <?php echo date("d.m.y", $data['creationDate']); ?> à <?php date("hh\hmm", $data['creationDate']); ?>  par <?php echo $data['login']; ?><br />
			</p>
		</div>
	</div>
	
	!-->
		
	<div class="header">
		<div class="date_wrapper">
			<div class="day"><?php echo date("d", $data['creationDate']); ?></div>
			<div class="year"><?php echo date("o", $data['creationDate']); ?></div>
			<div class="month"><?php echo $language_month[date("n", $data['creationDate'])]; ?></div>
		</div>
		<div class="text"><h2><?php echo $data['title']; ?></h2></div>
		
		<!-- MENU UTILITAIRE !-->
		<div class="menu">
			<a href="main_page.php?id=<?php echo $id; ?>&amp;action=history" style="background-image: url(theme/lightblue/images/historic_icon.png)"></a>
			<a href="main_page.php?id=<?php echo $id; ?>&amp;action=print" style="background-image: url(theme/lightblue/images/print_icon.png)"></a>
			<a href="main_page.php?id=<?php echo $id; ?>&amp;action=pdf" style="background-image: url(theme/lightblue/images/pdf_icon.png)"></a>	
			<a href="main_page.php?id=<?php echo $id; ?>&amp;action=config" style="background-image: url(theme/lightblue/images/config_icon_menu.png)"></a>			
		</div>
		
		<div class="page_thumb" style="background-image: url(<?php echo $titleImage; ?>);"></div>
		
		<!-- MENU RESEAU SOCIAUX ET FORUM a placer en css !-->
		
		<div style="position: relative; left: 10px; top: -45px; z-index: 2; height:	34px; width: 400px;">	
			<a href=""><img src="theme/lightblue/images/facebook_icon.png" alt="" /></a>
			<a href=""><img src="theme/lightblue/images/twitter_icon.png" alt="" /></a>
			<a href=""><img src="theme/lightblue/images/google_plus_icon.png" alt="" /></a>
			<a href=""><img src="theme/lightblue/images/comment_icon.png" alt="" /></a>
		</div>
		
	</div>
		
	<div id="reader">

		<?php 
			makeSummary('./pages/'.$id.'/'.findPageVersion($id).'.html'); 
		?>
		
		<div id="page_content">
			<?php
				echo titre_remplace('./pages/'.$id.'/'.findPageVersion($id).'.html');
			?>
		</div>
	</div>
	
	<?php } ?>
	
<?php } else { ?>
	
	La page est cachée
	<!-- option 2 faire croire que la page n'existe tout simplement pas !-->

<?php } ?>
