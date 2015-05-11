<?php 
require("./config/config_bd.php");

$idEstado=$_POST['estado'];
$conexao= conn_mysql();
$sqlCidades="select * from cidades where idEstado=?";
$operacao=$conexao->prepare($sqlCidades);
$operacao->execute(array($idEstado));
$cidades=$operacao->fetchAll(PDO::FETCH_ASSOC);
?>


<?php 
foreach($cidades as $cidade){
	$cidade['nomeCidade']=utf8_encode($cidade['nomeCidade']);
	
	echo "<option value='$cidade[idCidade]'>$cidade[nomeCidade]</option>";
}

?>

