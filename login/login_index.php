<?php

// ***************************************************
// Connexion de l'utilisateur
// ***************************************************

//-----------------------------------------------------------------
// Affichage du titre de la page
//-----------------------------------------------------------------

echo '<div class="titleBox">
	<div class="titleBoxLeft"></div>
	<div class="titleBoxBody">
		<div class="titleIcon"></div>
		<div class="titleText">' . $messageLanguage['loginNewPageTitle'] . '</div>
	</div>
	<div class="titleBoxRight"></div>
	<div class="titleBoxKillFloat"></div>
</div>';

//-----------------------------------------------------------------
// Choix de l'action a effectuer
//-----------------------------------------------------------------

include_once ("./system/login/login_action.php");

?>