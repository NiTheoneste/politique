<?php

$DB_host = "localhost";
$DB_user = "Umukama";
$DB_pass = "Umukama153";
$DB_name = "politiquedb";


try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

?>