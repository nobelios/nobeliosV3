<?php

// ***************************************************
// Deconnexion de l'utilisateur
// ***************************************************

//-----------------------------------------------------------------
// Affichage du titre de la page
//-----------------------------------------------------------------

echo '<div class="titleBox">
	<div class="titleBoxLeft"></div>
	<div class="titleBoxBody">
		<div class="titleIcon"></div>
		<div class="titleText">' . $messageLanguage['logoutNewPageTitle'] . '</div>
	</div>
	<div class="titleBoxRight"></div>
	<div class="titleBoxKillFloat"></div>
</div>';

//-----------------------------------------------------------------
// Choix de l'action effectuer
//-----------------------------------------------------------------

include_once ("./system/login/logout_action.php");

?>
