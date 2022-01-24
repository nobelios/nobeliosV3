<?php

//-----------------------------------------------------------------
//	Connexion
//-----------------------------------------------------------------

// Donnees de connexion a la db
$dbName = 'db439771162';
$dsn = 'mysql:host=db439771162.db.1and1.com;dbname=' . $dbName;
$user = 'dbo439771162';
$password = 'x34zt907';
$db=null;

$db = new PDO('mysql:host=db439771162.db.1and1.com;dbname=db439771162', 'dbo439771162', 'x34zt907');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>