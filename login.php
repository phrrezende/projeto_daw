<?php 
session_start();
//Criando o cookie
	if (!empty($_POST['lembrar'])){
		$validade= time()+ 60*60*24*250;
		setcookie("usuario",$_POST['login'],$validade);
	}

	require_once("config/config_bd.php");
	
	$login=htmlspecialchars($_POST['login']);
	$senha=htmlspecialchars($_POST['senha']);
	$senha=md5($senha);

	$conexao= conn_mysql();
	
	$sql= "Select * from participantes where login=? and senha=?";
	
	$operacao= $conexao->prepare($sql);
	
	$pesquisar= $operacao->execute(array($login,$senha));
	
	$resultado=$operacao->fetch(PDO::FETCH_OBJ);
	$conexao=null;

	if ($resultado !=FALSE){

		foreach($_POST as $chave=>$valor){
			$_SESSION[$chave]=$valor;
		}
		$_SESSION['logado']=true;
		$_SESSION['login']=$resultado;
		
		header("Location: ./index.php");
	}
	else{
	header("Location: ./erroLogin.php");

	}
	
?>