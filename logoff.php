<?php 
session_start();
include("modelos/cabecalho.php");
	$_SESSION= array();
	session_destroy();
	
	//Verificar se existem cookies para a sessão
	if(ini_get("session.use_cookies")){
	$params= session_get_cookie_params();
	setcookie(session_name(),'',time()-42000,
	$params["path"],$params["domain"],
	$params["secure"]);
	}
	
	if(empty($_SESSION)){
	echo "<h1>Logoff realizado com sucesso!.</h1>\n";
	}
	else{
	echo "<h1>Erro ao realizar o logoff!</h1>\n";
	}
	include("modelos/rodape.php");

?>