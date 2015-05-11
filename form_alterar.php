<?php 
session_start();
include("./modelos/cabecalho.php");
require("./config/config_bd.php");
	if(empty($_SESSION['logado'])){
		header("Location: acessoNegado.php");
	}
$dadosUsuario=$_SESSION['login'];


$conexao= conn_mysql();
$sqlCidades="Select * from cidades order by nomeCidade";
$operacao=$conexao->prepare($sqlCidades);
$operacao->execute();
$cidades=$operacao->fetchAll(PDO::FETCH_ASSOC);
$count=count($cidades);
?>

<img id="imagemUser" src="<?php echo $dadosUsuario->arquivoFoto; ?>" alt="<?php echo $dadosUsuario->nomeCompleto; ?>" /><h2> Alterar Meus Dados</h2>

<form action="alterar.php" method="post"  enctype="multipart/form-data"/>
<fieldset>
    <legend>Informe seus dados</legend>
	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" >
<div>
    <label for="nome">Nome Completo:</label>
    <input type="text" name="nome"  value="<?php echo $dadosUsuario->nomeCompleto; ?>" required/>
</div>
<div>
    <label for="login">Login:</label>
    <input type="text" name="login" value="<?php echo $dadosUsuario->login; ?>" required />
</div>
<div>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" placeholder="Digite uma nova senha" required />
</div>
	<div>
		<label for="cidade">Cidade:</label>
		<select id="cidade" name="cidade" required>
			<?php 
				foreach($cidades as $cidade){
					$cidade['nomeCidade']=utf8_encode($cidade['nomeCidade']);
					?>
					<option value='<?php echo $cidade["idCidade"]; ?>' <?php if($cidade['idCidade']==$dadosUsuario->cidade) echo 'selected';?>><?php echo $cidade['nomeCidade']; ?></option>";
				<?php
				}
			?>
		</select>
	</div>

<div>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $dadosUsuario->email; ?>" required/>
</div>
<div>
    <label for="descricao">Descrição:</label>
    <textarea name="descricao" required><?php echo $dadosUsuario->descricao; ?></textarea>
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