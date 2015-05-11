<?php 
if(isset($_COOKIE['usuario'])){
$usuario=$_COOKIE['usuario'];
}

	
?>
<!DOCTYPE html >
<html lang="pt-br" >
    <head>
        <meta charset="utf-8" />
        <title>YearBook - Especialização em Desenvolvimento Web- PUC MG</title>

        <link rel="stylesheet" href="css/estilo.css" />
		<link href="css/normaliza.css" rel="stylesheet">

    </head>
	<body>
		<header>
					<nav>
					<ul>
						<li><a href="form_login.php">Acessar</a></li>
						<li><a href="form_cadastrar.php">Cadastrar</a></li>
						<li><a href="form_alterar.php">Meus Dados</a></li>
						<li><a href="logoff.php">Logoff</a></li>
					
					</ul>
					<a href="index.php"><img src="imgs/home.png" /></a>
					<form id="form-buscar" action="buscar.php" method="post" >
						<label id="lbl-buscar" for="buscar">Nome:</label>
						<input id="txt-buscar" type="text" name="buscar" />
						<input id="btn-buscar" type="submit" value="Buscar" />
					</form>
				</nav>
				
			
			<h1>Yearbook 2014 -PUC Minas Gerais<br />  Especialização em Desenvolvimento de Aplicações Web </h1>
		</header>