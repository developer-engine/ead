<?php
	$con;
	$username = 'admin_ead'; 
	$password = 'sistema2020'; 
	$host = '85.10.205.173:3306'; 
	$dbname = 'sistema_ead'; 


	$options = array(
	            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ); 

	try 
	{ 
	    $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
	} 
	catch(PDOException $ex) 
	{ 
	    die("Failed to connect to the database: " . $ex->getMessage()); 
	} 


	/*			    array(

            )*/	

?>