<?php 
include("./modelos/cabecalho.php");
require("./config/config_bd.php");

$conexao= conn_mysql();
$sqlCidades="Select * from cidades order by nomeCidade";
$operacao=$conexao->prepare($sqlCidades);
$operacao->execute();
$cidades=$operacao->fetchAll(PDO::FETCH_ASSOC);
$count=count($cidades);

$sqlEstados="Select * from estados  order by nomeEstado";
$operacao=$conexao->prepare($sqlEstados);
$operacao->execute();
$estados=$operacao->fetchAll(PDO::FETCH_ASSOC);
$count= count($estados);
?>

<h2> Cadastro </h2>
<form action="cadastrar.php" method="post"  enctype="multipart/form-data"/>
<fieldset>
    <legend>Informe seus dados</legend>
	<input type="hidden" name="MAX_FILE_SIZE" value="50000000" >
<div>
    <label for="nome">Nome Completo:</label>
    <input type="text" name="nome" required/>
</div>
<div>
    <label for="login">Login:</label>
    <input type="text" name="login" required />
</div>
<div>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" required />
</div>
<div>
    <label for="cidade">Cidade:</label>
	<select id="cidade" name="cidade" required>
	<?php 
	foreach($cidades as $cidade){
		$cidade['nomeCidade']=utf8_encode($cidade['nomeCidade']);
		echo "<option value='$cidade[idCidade]'>$cidade[nomeCidade]</option>";
	}
	?>
	</select>
</div>
<div>
    <label for="email">Email:</label>
    <input type="email" name="email" required/>
</div>
<div>
    <label for="descricao">Descrição:</label>
    <textarea name="descricao" required></textarea>
</div>
<div>
    <label for="foto">Foto:</label>
    <input type="file" name="foto" id="foto" placeholder="Escolha uma foto"/>
</div>
 <div class="button">
    <button type="submit">Enviar</button>
</div>
</fieldset>
</form>
<?php 
include("./modelos/rodape.php");
?>