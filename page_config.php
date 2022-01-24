<?php

// SYSTEME D'EDITION DES PAGES : PAGE GENERALE



?>

<!-- TITRE !-->
<div style="background-repeat: no-repeat; background-position: 10px 50%; background-image: url(theme/lightblue/images/icon_config_big.png); background-color: #b9b9b9; height: 60px; line-height: 60px; margin-bottom: 10px; padding-left: 70px; color: white; font-size: 1.2em;">
	CONFIGURATION DE L'ARTICLE
</div>

<!-- Séparateur !-->
<hr />

<div style="width:480px; float: left;">
	<div style="margin-bottom: 5px; width: 100%;">
		<div style="background-repeat: no-repeat; background-position: 10px 50%; height: 34px; line-height: 34px; background-image: url(theme/lightblue/images/icon_lock.png); padding-left: 40px; border-bottom: 2px solid #b9b9b9; margin-bottom: 15px;">
			Verrouillage
		</div>
		<div style="padding: 0px;">
			
			<div class="formCaption">Edition de l'article</div>
			<div class="chkOption">
				<input id="chk_lock_1" name="summary" type="checkbox"/>
				<label for="chk_lock_1"></label>
				<div class="slider">
					<div class="slideOn">unlock</div>
					<div class="btSlide"></div>
					<div class="slideOff">lock</div>
				</div>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Suppression de l'article</div>
			<div class="chkOption">
				<input id="chk_lock_2" name="summary" type="checkbox"/>
				<label for="chk_lock_2"></label>
				<div class="slider">
					<div class="slideOn">unlock</div>
					<div class="btSlide"></div>
					<div class="slideOff">lock</div>
				</div>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Selection d'une version</div>
			<div class="chkOption">
				<input id="chk_lock_3" name="summary" type="checkbox"/>
				<label for="chk_lock_3"></label>
				<div class="slider">
					<div class="slideOn">unlock</div>
					<div class="btSlide"></div>
					<div class="slideOff">lock</div>
				</div>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Réglage des paramètres de visibilité</div>
			<div class="chkOption">
				<input id="chk_lock_4" name="summary" type="checkbox"/>
				<label for="chk_lock_4"></label>
				<div class="slider">
					<div class="slideOn">unlock</div>
					<div class="btSlide"></div>
					<div class="slideOff">lock</div>
				</div>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Réglage des paramètres d'encryptage</div>
			<div class="chkOption">
				<input id="chk_lock_5" name="summary" type="checkbox"/>
				<label for="chk_lock_5"></label>
				<div class="slider">
					<div class="slideOn">unlock</div>
					<div class="btSlide"></div>
					<div class="slideOff">lock</div>
				</div>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Réglage des paramètres d'accès</div>
			<div class="chkOption">
				<input id="chk_lock_6" name="summary" type="checkbox"/>
				<label for="chk_lock_6"></label>
				<div class="slider">
					<div class="slideOn">unlock</div>
					<div class="btSlide"></div>
					<div class="slideOff">lock</div>
				</div>
			</div>
			
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Verrouillage opérateur système</div>
			<div class="chkOption">
				<input id="chk_lock_7" name="summary" type="checkbox"/>
				<label for="chk_lock_7"></label>
				<div class="slider">
					<div class="slideOn">unlock</div>
					<div class="btSlide"></div>
					<div class="slideOff">lock</div>
				</div>
			</div>

			<div style="clear: both;"></div>
			
		</div>
	</div>
	
	<div style="margin-bottom: 5px; width: 100%;">
		<div style="background-repeat: no-repeat; background-position: 10px 50%; height: 34px; line-height: 34px; background-image: url(theme/lightblue/images/icon_access.png); padding-left: 40px; border-bottom: 2px solid #b9b9b9; margin-bottom: 15px;">
			Paramètres d'accès
		</div>
		<div style="padding: 0px;">
			
			<div class="formCaption">Accès par mot de passe</div>
			<div class="chkOption">
				<input id="chk_password_1" name="summary" type="checkbox"/>
				<label for="chk_password_1"></label>
				<div class="slider">
					<div class="slideOn">oui</div>
					<div class="btSlide"></div>
					<div class="slideOff">non</div>
				</div>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Mot de passe</div>
			<div class="inputText"><input type="text"/></div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Confirmation du mot de passe</div>
			<div class="inputText"><input type="text"/></div>
			
			<div style="clear: both;"></div>
			
		</div>
	</div>
	
</div>
<div style="width:480px; float: right;">
	<div style="margin-bottom: 5px; width: 100%;">
		<div style="background-repeat: no-repeat; background-position: 10px 50%; height: 34px; line-height: 34px; background-image: url(theme/lightblue/images/icon_hidden.png); padding-left: 40px; border-bottom: 2px solid #b9b9b9; margin-bottom: 15px;">
			Paramètres de visibilité
		</div>
		<div style="padding: 0px;">
			
			<div class="formCaption">Zones spécifiques dissimulées</div>
			<div class="chkOption">
				<input id="chk_display_1" name="summary" type="checkbox"/>
				<label for="chk_display_1"></label>
				<div class="slider">
					<div class="slideOn">oui</div>
					<div class="btSlide"></div>
					<div class="slideOff">non</div>
				</div>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Article entièrement dissimulé</div>
			<div class="chkOption">
				<input id="chk_display_2" name="summary" type="checkbox"/>
				<label for="chk_display_2"></label>
				<div class="slider">
					<div class="slideOn">oui</div>
					<div class="btSlide"></div>
					<div class="slideOff">non</div>
				</div>
			</div>
			
			<div style="clear: both;"></div>
			
			<div class="formCaption">Invisible pour les groupes</div>
			<div style="float: right; margin-left: 3px; border: 1px solid #b9b9b9; background-color: white;"><a href="" style="display: block; height: 24px; width: 24px; cursor: pointer; background-image: url(theme/lightblue/images/icon_add_form.png); background-repeat: no-repeat; background-position: 50% 50%;"></a></div>
			<div class="inputText"><input type="text"/></div>

			<div style="clear: both;"></div>
			
			<div class="formCaption">Visible pour les groupes</div>
			<div style="float: right; margin-left: 3px; border: 1px solid #b9b9b9; background-color: white;"><a href="" style="display: block; height: 24px; width: 24px; cursor: pointer; background-image: url(theme/lightblue/images/icon_add_form.png); background-repeat: no-repeat; background-position: 50% 50%;"></a></div>
			<div class="inputText"><input type="text"/></div>

			<div style="clear: both;"></div>
			
		</div>
	</div>

	<div style="margin-bottom: 5px; width: 100%;">
		<div style="background-repeat: no-repeat; background-position: 10px 50%; height: 34px; line-height: 34px; background-image: url(theme/lightblue/images/icon_encryption.png); padding-left: 40px; border-bottom: 2px solid #b9b9b9; margin-bottom: 15px;">
			Paramètres d'encryptage
		</div>
		<div style="padding: 0px;">
			
			<div class="formCaption">Encrypter l'article</div>
			<div class="chkOption">
				<input id="chk_encryption_1" name="summary" type="checkbox"/>
				<label for="chk_encryption_1"></label>
				<div class="slider">
					<div class="slideOn">oui</div>
					<div class="btSlide"></div>
					<div class="slideOff">non</div>
				</div>
			</div>

			<div style="clear: both;"></div>
			
		</div>
	</div>

	<div style="margin-bottom: 5px; width: 100%;">
		<div style="background-repeat: no-repeat; background-position: 10px 50%; height: 34px; line-height: 34px; background-image: url(theme/lightblue/images/icon_work.png); padding-left: 40px; border-bottom: 2px solid #b9b9b9; margin-bottom: 15px;">
			Etat
		</div>
		<div style="padding: 0px;">
			<div class="formCaption">Article terminé</div>
			<div class="chkOption">
				<input id="chk_state_1" name="summary" type="checkbox"/>
				<label for="chk_state_1"></label>
				<div class="slider">
					<div class="slideOn">oui</div>
					<div class="btSlide"></div>
					<div class="slideOff">non</div>
				</div>
			</div>
					
			<div style="clear: both;"></div>
		</div>
	</div>

	<div style="height: 0px; border-top: 2px solid #b9b9b9; width: 100%; float: left; text-align: right; padding-top: 15px;">
		<input style="display: inline-block; height: 30px; width: 100px;" type="submit" value="Enregistrer"/>
	</div>

	<div style="clear: both;"></div>
</div>

<div style="clear: both;"></div>

<!-- Séparateur !-->
<hr />