<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );

	require_once 'valida_sessao_admin.inc.php';
	include('header.inc.php');

	$retorno = (isset($_GET['id'])) ? $_GET['id'] : '';
?>
<!DOCTYPE HTML>
<html lang="pt-br">
   <head>
		<meta charset="utf-8" />
		<title>
			ADMIN :: LIVRARIA PROMOVE
		</title>
		<link rel="shortcut icon" href="book.png">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
	<br><br><br><br><br><br><br><br>
			<?php
				if ($retorno == '1')
				{
				  echo "<div class='alert alert-success'> CADASTRO REALIZADO COM SUCESSO!</div>";
				}
			?>
		<br><br><br>
        <h1>Administração</h1>
		<br><br><br>
		<p>
			<a href="livros.php"><button class="btn btn-primary" type='button'>Cadastrar novos Livros</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="saida.php"><button class="btn btn-danger" type='button'>Sair do sistema</button></a>
		</p>
	</body>
</html>
<?php
    include('footer.inc.php');
 ?>