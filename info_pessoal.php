<?php 
session_start();
include("./modelos/cabecalho.php");
require_once("./config/config_bd.php");

if(empty($_SESSION['logado']) && $_SESSION['logado']!=true){
	header("Location: ./acessoNegado.php");
}
$login=$_GET['login'];

$conexao= conn_mysql();

$sql="select * from participantes as p, cidades as c where login=? and p.cidade=c.idCidade";

$operacao=$conexao->prepare($sql);

$operacao->execute(array($login));

$resultado=$operacao->fetchAll(PDO::FETCH_ASSOC);

$count=count($resultado);



if($count==0){
	echo "<h1> Perfil de usuário não encontrado! </h1>";
}

else{
		foreach($resultado as $usuario){
			//$usuario['arquivoFoto']=utf8_encode($usuario['arquivoFoto']);
			//$usuario['nomeCidade']=utf8_encode($usuario['nomeCidade']);
		 echo "
			<h1> Perfil do Aluno </h1>
			<section>
			<figure id='img-pessoa'>
			<img  id='img-usuario' src='$usuario[arquivoFoto]' alt='$usuario[nomeCompleto]'  title='$usuario[nomeCompleto]' />
			   
			</figure>
			<p>
			<strong>$usuario[nomeCompleto]<br />
			$usuario[nomeCidade]<br />
			$usuario[email]</strong><br /><br />
			$usuario[descricao]
			</p>
		</section>";
		}
		

}
include("./modelos/rodape.php");

?>