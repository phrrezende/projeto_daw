<?php 
session_start();
$dadosUsuario=$_SESSION['login'];
include("modelos/cabecalho.php");
require_once("config/config_bd.php");
	
	$nome=htmlspecialchars($_POST['nome']);
	$login=htmlspecialchars($_POST['login']);
	$senha=htmlspecialchars($_POST['senha']);
	$senha=md5($senha);
	$cidade=htmlspecialchars($_POST['cidade']);
	$email=htmlspecialchars($_POST['email']);
	$descricao=htmlspecialchars($_POST['descricao']);
	//$foto=htmlspecialchars($_POST['foto']);
	
	
	$permissoes=array("gif", "jpeg", "jpg", "png","JPG", "image/gif", "image/jpeg", "image/jpg", "image/png");
	$temp = explode(".", basename($_FILES["foto"]["name"]));//Cria vetor com os elementos nome e extensão
	$extensao = end($temp);//Captura o ultimo elemento, a extensão
	
	
		if(empty($_FILES["foto"]["name"])){
			$pathCompleto=$dadosUsuario->arquivoFoto;
			$pathCompleto=htmlspecialchars_decode($pathCompleto);
		}
		else{
			
			if((in_array($extensao,$permissoes)) && ($_FILES['foto']['size']<$_POST['MAX_FILE_SIZE'])){
				
					if($_FILES['foto']['error']>0){
						
						echo "<h1> Erro no envio do arquivo, código: ".$_FILES['foto']['error']." .</h1>";
					}
					else{
						$dirUploads = "uploads/";
						$nomeUsuario = $_POST["nome"]."/";	  
						
						if(!file_exists ( $dirUploads ))
						mkdir($dirUploads, 0500);  //permissao de leitura e execucao
						
						$caminhoUpload = $dirUploads.$nomeUsuario;
						if(!file_exists ( $caminhoUpload ))
						mkdir($caminhoUpload, 0700);  //permissoes de escrita, leitura e execucao
						
						$pathCompleto = $caminhoUpload.basename($_FILES["foto"]["name"]);
						move_uploaded_file($_FILES['foto']['tmp_name'], $pathCompleto);
						$pathCompleto=htmlspecialchars_decode($pathCompleto);
					}
				}
				else{
					echo "<h1>Arquivo inválido!	</h1>";
				}
			}
		
	$conexao= conn_mysql();
	$sql= "update participantes set login=?,senha=?,nomeCompleto=?,arquivoFoto=?,cidade=?,email=?,descricao=?
	where login='$dadosUsuario->login'";

	
	$operacao= $conexao->prepare($sql);
	$update= $operacao->execute(array($login,$senha,$nome,$pathCompleto,$cidade,$email,$descricao));
	$resultado=$operacao->rowCount();
	$conexao=null;
	

	if($resultado>0){
		$_SESSION= array();
		session_destroy();
		echo "<h1>Registro Alterado com Sucesso.</h1>\n";
		echo "<p class=\"lead\"><a href=\"./form_login.php\">Por favor, realize o acesso novamente!</a></p>\n";
		if(ini_get("session.use_cookies")){
			$params= session_get_cookie_params();
			setcookie(session_name(),'',time()-42000,
			$params["path"],$params["domain"],
			$params["secure"], $params["httonly"]);
		}
		
	}
	else {
		echo "<h1>Erro na operação.</h1>\n";
		$arr = ($operacao->errorInfo());		//mensagem de erro retornada pelo SGBD
		echo "<p>$arr[2]</p>";							//deve ser melhor tratado em um caso real
		echo "<p><a href=\"./inserir.php\">Retornar</a></p>\n";
	}

	
	/*
	if((in_array($extensao,$permissoes)) && ($_FILES['foto']['size']<$_POST['MAX_FILE_SIZE'])){
		
		if($_FILES['foto']['error']>0){
			
			echo "<h1> Erro no envio do arquivo, código: ".$_FILES['foto']['error']." .</h1>";
		}
		else{
			$dirUploads = "uploads/";
			$nomeUsuario = $_POST["nome"]."/";	  
			
			if(!file_exists ( $dirUploads ))
			mkdir($dirUploads, 0500);  //permissao de leitura e execucao
			
			$caminhoUpload = $dirUploads.$nomeUsuario;
			if(!file_exists ( $caminhoUpload ))
			mkdir($caminhoUpload, 0700);  //permissoes de escrita, leitura e execucao
			
			$pathCompleto = $caminhoUpload.basename($_FILES["foto"]["name"]);
			if(move_uploaded_file($_FILES["foto"]["tmp_name"], $pathCompleto)){
		
					$conexao= conn_mysql();
					$sql= "update participantes set login=?,senha=?,nomeCompleto=?,arquivoFoto=?,cidade=?,email=?,descricao=?
					where login='$dadosUsuario->login'";
					
					$operacao= $conexao->prepare($sql);
					$update= $operacao->execute(array($login,$senha,$nome,htmlspecialchars_decode($pathCompleto),$cidade,$email,$descricao));
					$resultado=$operacao->rowCount();

					
					$conexao=null;
					
					if ($resultado>0){
						$_SESSION= array();
						session_destroy();
						if(ini_get("session.use_cookies")){
							$params= session_get_cookie_params();
							setcookie(session_name(),'',time()-42000,
							$params["path"],$params["domain"],
							$params["secure"], $params["httonly"]);
						}
						echo "<h1>Registro Alterado com Sucesso.</h1>\n";
						echo "<p class=\"lead\"><a href=\"./form_login.php\">Por favor, realize o acesso novamente!</a></p>\n";
					}
					else {
						echo "<h1>Erro na operação.</h1>\n";
						$arr = ($operacao->errorInfo());		//mensagem de erro retornada pelo SGBD
						echo "<p>$arr[2]</p>";							//deve ser melhor tratado em um caso real
						echo "<p><a href=\"./inserir.php\">Retornar</a></p>\n";
					}
				
			}
			else{
			echo "<h1>Problemas ao armazenar o arquivo. Tente novamente.<h1>";
			}
		}
		
		
	}
	
	else{
	echo "<h1>Arquivo inválido!	</h1>";
	}
*/
include("modelos/rodape.php");
?>