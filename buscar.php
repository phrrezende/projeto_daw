<?php
session_start();
include_once("./modelos/cabecalho.php");
require_once("./config/config_bd.php");
	if(empty($_SESSION['logado']) && $_SESSION['logado']!=true){
		header("Location: ./acessoNegado.php");
	}
?>
	
<?php

try
{

	// se não foi passado 1 parâmetro via POST, desvia para a mensagem de erro
	// "previne" acesso direto à página	
	if(count($_POST)!=1){
		include("./erroPesquisa.php");
		die();
	}
	else{
	    // instancia objeto PDO, conectando no mysql
		$conexao = conn_mysql();
		
		//captura valores do vetor POST
		//utf8_encode para manter consistência da codificação utf8 nas páginas e no banco
		$nomeBusca = utf8_encode(htmlspecialchars($_POST['buscar']));
				
		// instrução SQL básica (sem restrição de nome)
		$SQLSelect = 'SELECT * FROM participantes ';

		//se existe um nome para busca... 
		if(strlen($nomeBusca)>0){
		    $nomeBusca = '%'.$nomeBusca.'%';		
			$SQLSelect = $SQLSelect.'WHERE nomeCompleto like ?';	//anexa a restrição à sentença SQL
		}
		
		//prepara a execução da sentença
		$operacao = $conexao->prepare($SQLSelect);					  
				
		//executa a sentença SQL com o valor passado por parâmetro
		$pesquisar = $operacao->execute(array($nomeBusca));
		
		//captura TODOS os resultados obtidos
		$resultados = $operacao->fetchAll();
		
		// fecha a conexão (os resultados já estão capturados)
		$conexao = null;
		
		// se há resultados, os escreve em uma tabela
		if (count($resultados)>0){	
			
			echo "<h1>Perfis Encontrados</h1>";
			echo '<table>';	
			//echo '<thead><tr><th colspan="3">Contatos encontrados</th></tr></thead>';
			echo '<tr id=rotulo ><th>Nome</th><th>e-mail</th><th>Login</th><th>Foto</th></tr>';
			
			foreach($resultados as $usuario){		//para cada elemento do vetor de resultados...
			$usuario['arquivoFoto']=utf8_encode($usuario['arquivoFoto']);
				//em cada 'linha' do vetor de resultados existem elementos com os mesmos nomes dos campos recuperados do SGBD
				echo "<tr><td><a href='info_pessoal.php?login=".$usuario['login']."'>".$usuario['nomeCompleto']."</a</a></td>";
				echo "<td>".$usuario['email']."</td>";
				echo "<td>".$usuario['login']."</td>";
				echo "<td><a href='info_pessoal.php?login=".$usuario['login']."'>
					<img  id='img-tabela' src='".$usuario['arquivoFoto']." '/></a></td></tr>";
				
			}
			
			echo '</table>';
		}
		else{
			echo"<h1>Não foram encontrados contatos com os dados fornecidos</h1>";
		}
		
		
		echo"<hr>";	
		require("./modelos/rodape.php");
    }
}
catch (PDOException $e)
{
    // caso ocorra uma exceção, a exibe na tela
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}
?>
<?php

?>
