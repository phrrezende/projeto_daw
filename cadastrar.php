<?php 
session_start();
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
	

	
	$permissoes=array("gif", "jpeg", "jpg", "png", "image/gif", "image/jpeg", "image/jpg", "image/png");
	$temp = explode(".", basename($_FILES["foto"]["name"]));//Cria vetor com os elementos nome e extensão
	$extensao = end($temp);//Captura o ultimo elemento, a extensão
	
	if((in_array($extensao,$permissoes)) && ($_FILES['foto']['size']<$_POST['MAX_FILE_SIZE'])){
		
		if($_FILES['foto']['error']>0){
			
			echo "<h1> Erro no envio do arquivo, código: ".$_FILES['foto']['error']." .</h1>";
		}
		else{
			$dirUploads = "uploads/";
			$nomeUsuario = utf8_decode($nome)."/";	  
			
			if(!file_exists ( $dirUploads ))
			mkdir($dirUploads, 0500);  //permissao de leitura e execucao
			
			$caminhoUpload = $dirUploads.$nomeUsuario;
			if(!file_exists ( $caminhoUpload ))
			mkdir($caminhoUpload, 0700);  //permissoes de escrita, leitura e execucao
			
			$pathCompleto = $caminhoUpload.basename($_FILES["foto"]["name"]);
			if(move_uploaded_file($_FILES["foto"]["tmp_name"], $pathCompleto)){
		
				$conexao= conn_mysql();
				
				$consulta="select * from participantes where login=?";
				
				$operacao=$conexao->prepare($consulta);
				
				$operacao->execute(array($login));
				
				$resultado=$operacao->fetch(PDO::FETCH_OBJ);

				if($resultado !=FALSE){
					echo "<h1>Login Já cadastrado, por favor tente outro!</h1>\n";
				}
				else{
				
					$sql= "insert into participantes(login,senha,nomeCompleto,arquivoFoto,cidade,email,descricao)
                    values(?,?,?,?,?,?,?)";
                    
                    $operacao= $conexao->prepare($sql);
                    $inserir= $operacao->execute(array($login,$senha,$nome,htmlspecialchars_decode($pathCompleto),
					
					$cidade,$email,$descricao));
                    
					$conexao=null;
					if ($inserir){
						echo "<h1>Cadastro efetuado com sucesso.</h1>\n";
						echo "<p class=\"lead\"><a href=\"./form_cadastrar.php\">Inserir outro contato</a></p>\n";
					}
					else {
						echo "<h1>Erro na operação.</h1>\n";
						$arr = ($operacao->errorInfo());		//mensagem de erro retornada pelo SGBD
						echo "<p>$arr[2]</p>";							//deve ser melhor tratado em um caso real
					}
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

include("modelos/rodape.php");
?>