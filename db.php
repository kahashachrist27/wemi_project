<?php

require_once "config/constants.php";

$servername = HOST;
$username = USER;
$password = PASSWORD;
$db = DATABASE_NAME;

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);
$con->set_charset("utf8mb4");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


try
	{
		$pdo_options[ PDO:: ATTR_ERRMODE] = PDO:: ERRMODE_EXCEPTION;
		$bdd = new PDO( 'mysql: host='.$servername.'; dbname='.$db , $username , $password ,
		array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8')) ;
		$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		/*$pdo_options[ PDO:: ATTR_ERRMODE] = PDO:: ERRMODE_EXCEPTION;
		$bdd = new PDO( 'mysql: host=localhost; dbname=shop' , 'root' , '' , 
		$pdo_options) ;*/
		//var_dump($bdd);
		
	}
	catch ( PDOException $e)
	{
		die( ' Erreur : '. $e->getMessage() ) ;
		//var_dump($e);
	}


?>