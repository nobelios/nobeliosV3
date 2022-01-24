<?php

// SYSTEME D'EDITION DES PAGES : PAGE GENERALE



?>

<!-- TITRE !-->
<div style="background-repeat: no-repeat; background-position: 10px 50%; background-image: url(theme/lightblue/images/icon_edit_big.png); background-color: #b9b9b9; height: 60px; line-height: 60px; margin-bottom: 10px; padding-left: 70px; color: white; font-size: 1.2em;">
	EDITION DE L'ARTICLE
</div>

<!-- Séparateur !-->
<hr />

<!-- Contenu !-->
<div style="margin-bottom: 5px; width: 100%;">
	<div style="background-repeat: no-repeat; background-position: 10px 50%; height: 34px; line-height: 34px; background-image: url(theme/lightblue/images/icon_lock.png); padding-left: 40px; border-bottom: 2px solid #b9b9b9; margin-bottom: 15px;">
		Données
	</div>
	
	<div style="width: 480px; float: left;">
	
		<div style="clear: both;"></div>
		
		<div class="formCaption" style="width: 150px;">Titre de la page</div>
		<div class="inputText" style="width: 300px;"><input type="text"/></div>
		
		<div style="clear: both;"></div>
		<div class="formCaption" style="width: 150px;">Mots clés</div>
		<div style="float: right; margin-left: 3px; border: 1px solid #b9b9b9; background-color: white;"><a href="" style="display: block; height: 24px; width: 24px; cursor: pointer; background-image: url(theme/lightblue/images/icon_add_form.png); background-repeat: no-repeat; background-position: 50% 50%;"></a></div>
		<div class="inputText" style="width: 271px;"><input type="text"/></div>

	</div>
	
	<div style="width: 480px; height: 75px; background-size: cover; background-position: 50% 100%; background-image: url(ressources/title_images/FD1FA202AF9E1ACA.jpg) ;float: right; border: 1px solid #b9b9b9; background-color: #ffffff;position: relative; z-index: 1;">
		<label class="img" for="background">Modifier l'arrière plan</label><input type="file" id="background" style="display: none;"/> 
	</div>

	<div style="clear: both;"></div>
	
	<div style="background-repeat: no-repeat; background-position: 10px 50%; height: 34px; line-height: 34px; background-image: url(theme/lightblue/images/icon_lock.png); padding-left: 40px; border-bottom: 2px solid #b9b9b9; margin-bottom: 15px; -webkit-box-sizing:	border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
		Contenu
	</div>
	
	
	<div style="clear: both;"></div>
	
	<!-- div principale !-->
	<div class="h_mainboard">
		
		<input id="display_switch" type="checkbox" />
		
		<!-- contrôles !-->
		<div class="board">
			<div class="menu">
				<!-- boutons !-->
				<div class="btn">
					<label for="btn_A">A</label>
				</div>
				<div class="btn">
					<label for="btn_B">B</label>
				</div>
				<div class="btn">
					<label for="btn_C">C</label>
				</div>
				<div class="btn">
					<label for="btn_D">D</label>
				</div>
				<div class="btn">
					<label for="btn_E">E</label>
				</div>
				<div class="btn">
					<label for="btn_F">F</label>
				</div>
				<input id="btn_A" type="checkbox" />
				<!-- options des boutons !-->
				<div class="view">options</div>
			</div>
		</div>	
		
		<!-- afficher/cacher !-->
		<div class="display_switch">
			<label for="display_switch"></label>
		</div>
		
		<!-- zone de texte !-->
		<div class="textarea">
			<div style="width: 100%; height: 100%; padding: 5px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
				<textarea style="width: 100%; height: 100%; display: hidden; background: none; border: none; resize:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"></textarea>
			</div>
		</div>
	
	</div>
	
</div>

<!-- Séparateur !-->
<hr />