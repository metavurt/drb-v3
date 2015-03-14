<?php
function getDB() {
	$dbhost="localhost";
	$dbport="8889";
	$dbuser="root";
	$dbpass="krZ45#ur@66";
	$dbname="weo3";
	//$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbConnection = new PDO("mysql:host=$dbhost;port=$dbport;dbname=$dbname", $dbuser, $dbpass);
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
?>