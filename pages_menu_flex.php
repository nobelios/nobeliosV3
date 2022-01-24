<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>[*]Title</title>
		<!-- Feuilles de style !-->
		<link rel="stylesheet" href="./theme/lightblue/css/general.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/intro.css" type="text/css" /> <!-- Gestion des champs de formulaire et des légendes !-->
		<link rel="stylesheet" href="./theme/lightblue/css/form.css" type="text/css" />
		<link rel="stylesheet" href="./theme/lightblue/css/connection.css" type="text/css" />
	</head>
	
    <body style="margin: 0px; padding: 0px; background-color: #025ea9;">
		
		<!--  Header !-->
		<div id="miniHeader">
			<div class="center">
				<div class="logo"></div>
			</div>
		</div>
		
		<!-- Body !-->
		<div id="content">
		
			<!-- Fil d'ariane !-->
			<?php include_once(breadcrunch($table); ?>
			
			<!-- Menu fix !-->
			<div class="menu">
			
				<div class="title">
					<div class="thumb" style="background-image: url(./theme/lightblue/images/icon_inorga.png);"></div>
					<div class="text">
						<h2>Nobelios</h2>
					</div>
				</div>
				
				<div class="section">
					<div class="thumb" style="background-image: url(./theme/lightblue/images/icon_site_forum.png);"></div>
					<div class="text">
						<h2>Forum</h2>
						<p></p>	
					</div>
				</div>
				
				<div class="section">
					<div class="thumb" style="background-image: url(./theme/lightblue/images/icon_site_news.png);"></div>
					<div class="text">
						<h2>News</h2>
						<p></p>	
					</div>
				</div>
				
				<div class="section" style="margin-right: 0px;">
					<div class="thumb" style="background-image: url(./theme/lightblue/images/icon_site_rules.png);"></div>
					<div class="text">
						<h2>Règlement</h2>
						<p></p>	
					</div>
				</div>
				
				<div class="clearFloat"></div>
			
			</div>
			
			<!-- Menu flex !-->
			<?php 
			
			
			
			?>
			
		</div>
		
		<!-- PIED DE PAGE !-->
		<div id="footer">
			<div class="center">
				<div class="creativeCommonsLogo"></div>
				<div class="html5Css3Logo"></div>
				<div style="clear:both;"></div>
			</div>
		</div>
    </body>
</html>