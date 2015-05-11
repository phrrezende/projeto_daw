<?php 
include("./modelos/cabecalho.php");
?>
				<form method="post" action="login.php" >
				<fieldset>
				<legend>Entre com usuário e senha.</legend>
					<div>
					<label for="usuario">Usuário</label>
					<input type="text" name="login" value="<?php if(isset($usuario)) echo $usuario ?>" />
					</div>
					<div>
					<label for="senha"> Senha</label>
					<input type="password" name="senha" />
					</div>
					<div>
					Lembrar<input type="checkbox" name="lembrar" value="remember-me"> 
					</div>
			
					<div class="button">
					<input type="submit" name="acessar" value="Acessar" />	
					</div>
				</fieldset>
					</form>
<?php
include("./modelos/rodape.php");
?>