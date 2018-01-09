<?php

require_once('config.php');

abstract class Manager
{
	protected function dbConnect()
	{
		try
	    {
	    	$options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false];
	        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, $options);
	        
	        return $db;
	    }
	    catch(PDOException $e)
	    {
	        exit('Erreur : '.$e->getMessage());
	    }
	}
}