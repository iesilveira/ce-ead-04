<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	
	require_once 'valida_sessao_admin.inc.php';
    require_once 'conecta_mysql.inc.php';
	
	$retorno = (isset($_GET['id'])) ? $_GET['id'] : '';
 
  include('header.inc.php');
?>
<!DOCTYPE HTML>
<html>
   <head>
		<meta charset= 'utf-8'>
		<title>
			CADASTRO DE LIVROS :: LIVRARIA PROMOVE
		</title>
		<link rel="shortcut icon" href="book.png">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
    <br><br><br><br><br>
	<?php
		if($retorno == '1'){
			echo "<div class='alert alert-danger'> ERRO AO EFETUAR CADASTRO DO LIVRO, VERIFIQUE A IMAGEM SELECEIONADA!</div>";
		}
	?>
	
		<h1>Cadastro de Livros</h1>
		<br><br>
		<form name='form1' method='POST' action='cadastrar_livro.php' enctype='multipart/form-data'>
			<p>
				<table align='center'>
					<tr>
						<td> <b>Título: </b></td>
						<td> <input type='text' name='titulo' size='60px' required> </td>
					</tr>
					<tr>
						<td> <b>Autor: </b> </td>
						<td> <input type='text' name='autor' size='60px' required> </td>
					</tr>
					<tr>
						<td> <b>Preço(R$): </b> </td>
						<td> <input type='text' name='preco' required> </td>
					</tr>
					<tr>
						<td> <b>Categoria: </b> </td>
						<td> 	
							<select name='categoria' required> 
								<?php 
									$sql = "SELECT codigo, categoria FROM categorias";
									$result = $mysqli->query( $sql );
									for($i=0; $i < $mysqli->affected_rows; $i++)
									{
									  $dados = $result->fetch_assoc();
									  echo "<option value='".$dados['codigo']."'>".utf8_encode($dados['categoria'])."</option>";
									}              
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td> <b>Imagem: </b> </td>
						<td>
						<div>
							<label class='btn btn-primary btn-file' id='labelfile'> Adicionar imagem 
							<input type='file' class='file' name='arquivo' style="display: none"></label>
						</div>
						</td>
					</tr>
					<tr>
						<td> <b>Quantidade: </b> </td>
						<td> <input type='number' name='quantidade' min='0' size='5px' required> </td>
					</tr>
				</table>
			</p>
			<br>
			<p>
				<input class="btn btn-success" type='submit' name='cadastrar'  value='Cadastrar'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="saida.php"><button class="btn btn-danger" type='button'>Sair do sistema</button></a>
		</p>
	</form>		
</body>
<?php
    include('footer.inc.php');
?>