<?php

class Conexao  
{
	private $HOST="localhost";
	private $BANCO="bdnoticias";
	private $USER="root";
	private $PASS="";
	private static $instance;

	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			try {
				self::$instance = new PDO('mysql:host=localhost;dbname=bdnoticias','root','');				
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		return self::$instance;
	}
	public static function prepare($sql)
	{
		return self::getInstance()->prepare($sql);
	}
}
	
?>