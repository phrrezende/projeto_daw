<?php 
include("./modelos/cabecalho.php");
include("config/config_bd.php");

$conexao= conn_mysql();

$consulta="select * from participantes";

$operacao=$conexao->prepare($consulta);

$operacao->execute();

$resultado=$operacao->fetchAll(PDO::FETCH_ASSOC);

$count=count($resultado);


?>
    <section>
    <ul>
            <?php
				foreach($resultado as $usuario){
					$usuario['arquivoFoto']=utf8_encode($usuario['arquivoFoto']);
					echo "
					<li>
						<a href='info_pessoal.php?login=$usuario[login]'>
						<figure id=tumbnails>
						<img src='$usuario[arquivoFoto]' alt='$usuario[nomeCompleto]' title='$usuario[nomeCompleto]' />
						<figcaption>$usuario[nomeCompleto]</figcaption>
						</figure>
						</a>
					</li>";
				}
			
			?>
				
    </ul>
    </section>
 <?php 
 include("./modelos/rodape.php");
 ?>