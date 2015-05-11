<?php 
	function conn_mysql(){
		$servidor= "br-cdbr-azure-south-a.cloudapp.net";
		$porta=3306;
		$banco="nuvemwoAxTH9bDmK";
		$usuario="bc45853ca2d1a6";
		$senha="c43a9608";
		
		$conn = new PDO("mysql:host=$servidor;
		port=$porta;
		dbname=$banco",$usuario,$senha);
		
		return $conn;
		
		
	}


?>