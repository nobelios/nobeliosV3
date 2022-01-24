<?php

// Formulaire de création de l'entête de la nouvelle page



?>

<!doctype html>
<html lang="fr" style="width: 100%; height: 100%;">
<head>
	<meta charset="utf-8" />
	<title>Titre</title>
	<link href="../theme/lightblue/css/form.css" rel="stylesheet" type="text/css" />
</head>

FORMULAIRES WEB POUR NOBELIOS

<!-- Boite principale contenant l'entête !-->
<body>
	<h1>ETAPE 1 - CR&Eacute;ATION DE L'ENT&Ecirc;TE DE LA PAGE</h1> <!-- Titre de l'étape !-->
	<form>
		
		<label for="page_title" style="display:block; float: left; border: 1px solid #666666; border-right: none; background-color: #f1f1f1; width: 100px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;">Titre</label>
		<input id="page_title" style="display:block; float: left; border: 1px solid #666666; border-left: none; background-color: white; width: 500px; height: 28px; line-height: 30px; margin: 0; padding-left: 10px;" type="text"></input>
		<div style="clear: left;"></div>
		
		<br />
		
		<label for="page_keyword" style="display:block; float: left; border: 1px solid #666666; border-right: none; background-color: #f1f1f1; width: 100px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;">Mots clés</label>
		<input id="page_keyword" style="display:block; float: left; border: 1px solid #666666; border-left: none; background-color: white; width: 500px; height: 28px; line-height: 30px; margin: 0; padding-left: 10px;" type="text"></input>
		<div style="clear: left;"></div>
		
		<br />
		
		<label for="page_content" style="display:block; border: 1px solid #666666; border-bottom: none; background-color: #f1f1f1; width: 600px; height: 30px; line-height: 30px; margin: 0; padding: 0 10px;">Texte</label>
		<textarea id="page_content" style="display:block; border: 1px solid #666666; border-top: none; background-color: white; width: 600px; height: 250px; margin: 0; padding: 10px; resize: none; overflow: auto;"></textarea>
		
		<br />
		
		<label for="page_content" style="display:block; float: left; border: 1px solid #666666; border-right: none; background-color: #f1f1f1; width: 100px; height: 150px; line-height: 30px; margin: 0; padding-left: 10px;">Texte</label>
		<textarea id="page_content" style="display:block; float: left; border: 1px solid #666666; border-left: none; background-color: white; width: 490px; height: 130px; margin: 0; padding: 10px; resize: none; overflow: auto;"></textarea>
		<div style="clear: left;"></div>
		
		<br />
		
		<div style="border: 1px solid #666666; width: 620px; min-height: 50px; max-height: 100px; overflow-y: auto; overflow-x: hidden;">
			<div style="display:block; float: left; border: none; background-color: #f1f1f1; width: 100px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;">Cout</div>
			<div style="display:block; float: left; border: none; background-color: white; width: 480px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;">
				<input name="radio_1" id="cost_0" type="radio" checked="checked" /><label for="cost_0">0</label>
				<input name="radio_1" id="cost_1" type="radio" /><label for="cost_1">1</label>
				<input name="radio_1" id="cost_2" type="radio" /><label for="cost_2">2</label>
				<input name="radio_1" id="cost_3" type="radio" /><label for="cost_3">3</label>
				<input name="radio_1" id="cost_4" type="radio" /><label for="cost_4">4</label>
				<input name="radio_1" id="cost_5" type="radio" /><label for="cost_5">5</label>
			</div>
			
			<div style="clear: left;"></div>
			
			<div style="display:block; float: left; border: none; background-color: #f1f1f1; width: 100px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;">Risque</div>
			<div style="display:block; float: left; border: none; background-color: white; width: 480px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;">
				<input name="radio_2" id="risk_0" type="radio" checked="checked" /><label for="risk_0">0</label>
				<input name="radio_2" id="risk_1" type="radio" /><label for="risk_1">1</label>
				<input name="radio_2" id="risk_2" type="radio" /><label for="risk_2">2</label>
				<input name="radio_2" id="risk_3" type="radio" /><label for="risk_3">3</label>
				<input name="radio_2" id="risk_4" type="radio" /><label for="risk_4">4</label>
				<input name="radio_2" id="risk_5" type="radio" /><label for="risk_5">5</label>
			</div>
			
			<div style="clear: left;"></div>
			
			<div style="display:block; float: left; border: none; background-color: #f1f1f1; width: 100px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;">Duree</div>
			<div style="display:block; float: left; border: none; background-color: white; width: 480px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;">
				<input name="radio_3" id="time_0" type="radio" checked="checked" /><label for="time_0">0</label>
				<input name="radio_3" id="time_1" type="radio" /><label for="time_1">1</label>
				<input name="radio_3" id="time_2" type="radio" /><label for="time_2">2</label>
				<input name="radio_3" id="time_3" type="radio" /><label for="time_3">3</label>
				<input name="radio_3" id="time_4" type="radio" /><label for="time_4">4</label>
				<input name="radio_3" id="time_5" type="radio" /><label for="time_5">5</label>
			</div>
			
			<div style="clear: left;" ></div>
		</div>
		
		<br />
		
		<input type="submit" style="display:block; border: 1px solid #666666; background-color: white; width: 200px; height: 30px; line-height: 30px; margin: 0; padding-left: 10px;" value="Envoyer" />
		
		<!-- zone de texte !-->
		<div style="background-color: #d4d4d4; width: 90%; padding: 10px; margin: 10px; border: 1px solid black;"
		
			<!-- champ du titre !-->
			Champ de texte
			<div class="inputText" style="width: 600px;">
				<input
					style="width: 580px;"
					type="text"
					name="title" 
					maxlength="100"
					oninput="checkTitle()" 
					placeholder="champ de texte"
					pattern=""
					autocomplete="off"
					required
				/>
			</div>
			
			<div style="height: 10px;"></div>
			
			Zone de texte
			<!-- champ de texte !-->
			<div class="textarea" style="width: 600px; 	height: 60px;">
				<textarea style="width: 580px; 	height: 40px;"></textarea>
			</div>
		
		</div>
		
		<div style="height: 10px;"></div>
		
		<!-- zone de texte !-->
		<div style="background-color: #d4d4d4; width: 90%; padding: 10px; margin: 10px; border: 1px solid black;">
			
			<!-- liste de catégories !-->
			<div class="checkbox_list">
				<div><input type="checkbox" id="chk_1" /><label for="chk_1">option 1</label></div>
				<div><input type="checkbox" id="chk_2" /><label for="chk_2">option 2</label></div>
				<div><input type="checkbox" id="chk_3" /><label for="chk_3">option 3</label></div>
				<div><input type="checkbox" id="chk_4" /><label for="chk_4">option 4</label></div>
				<div><input type="checkbox" id="chk_5" /><label for="chk_5">option 5</label></div>
				<div><input type="checkbox" id="chk_6" /><label for="chk_6">option 6</label></div>
			</div>
			
			<div style="height: 10px;"></div>
			
			<!-- case à cocher !-->
			<input type="checkbox" id="chk_7"><label for="chk_7" />case à cocher</label>
			
			<div style="height: 10px;"></div>
			
			<!-- liste déroulante !-->		
			<select>
				<option>option 1</option>
				<option>option 2</option>
				<option>option 3</option>
			</select>
			
			<div style="height: 10px;"></div>
			
			<!-- puces !-->
			<input type="radio" name="radio_1" id="radio_1" /><label for="radio_1">choix 1</label>
			<input type="radio" name="radio_1" id="radio_2" /><label for="radio_2">choix 2</label>
			<input type="radio" name="radio_1" id="radio_3" /><label for="radio_3">choix 3</label>
			
			<div style="height: 10px;"></div>
			
			<ul class="choices-thin">
				<li><input type="checkbox" name="check-4" id="check-4" /><label for="check-4">Choix 4</label></li>
			</ul>
			
		</div>
	
		<!-- boutons !-->
		<br /><br />


	</form>
</body>
</html>