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

         
		<link href="css/normaliza.css" rel="stylesheet">
		 <link rel="stylesheet" href="css/estilo.css" />  
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			var ajax;
			
			function iniciaAjax(){
				if(window.XMLHttpRequest){
					ajax= new XMLHttpRequest();
					
				}
				else if(window.activeXObject){
					
					ajax= new ActiveXObject("Msxml2.XMLHTTP");
					if(!ajax){
						ajax= new ActiveXObject("Microsoft.XMLHTTP");
					}
				}
				else{
					alert("Seu navegador não possui suporte para esta aplicação!");
				}
				return ajax;
			}
			window.onload= function(){
				document.getElementById('estado').onchange=buscaCidade;
				
			};
			
			function buscaCidade(){
				ajax= iniciaAjax();
				
				if(ajax){
					ajax.onreadystatechange= function(){
						if(ajax.readyState==4){
							if(ajax.status==200){
								//carregar o select com as cidades
								var cidades=ajax.responseText;
								document.getElementById('cidade').innerHTML=cidades;
	
							}
							else{
								alert(ajax.statusText);
							}
						}
						
					}
				var estado= document.getElementById('estado').value;
				
				dados='estado='+estado;
				
				ajax.open('POST','buscaCidade.php',true);
				ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				ajax.send(dados);
					
				}
				
				
				
			}
		</script>
		

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