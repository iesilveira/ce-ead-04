<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	
	include('header.inc.php');
  
	$retorno = (isset($_GET['id'])) ? $_GET['id'] : '';
?>
<!DOCTYPE HTML>
	<head>
		<meta charset="utf-8" />
		<title>
			CADASTRO DE CLIENTES :: LIVRARIA PROMOVE
		</title>
		<link rel="shortcut icon" href="book.png">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
    <body>
	<br><br><br><br><br>
		<form name='form1' method='POST' action='valida_cadastro.php'>
		
			<h1>Cadastro de novo cliente</h1>
			<br><br>

			<?php
				if($retorno == '2'){
				echo "<div class='alert alert-danger'>USUÁRIO JÁ CADASTRADO!</div>";
				}
				else if($retorno == '3'){
				echo "<div class='alert alert-danger'>AS SENHAS INFORMADAS SÃO DIVERGENTES!</div>";
				}
			?>
			<p>
				<table align='center'>
					<tr>
						<td> <b>Nome Completo: </b></td>
						<td> <input type='text' name='nome' size='60px' required> </td>
					</tr>
					<tr>
						<td> <b>E-mail para contato: </b> </td>
						<td> <input type='email' name='email' size='60px'> </td>
					</tr>
					<tr>
						<td> <b>Usuário (Máximo de 15 caracteres): </b> </td>
						<td> <input type='text' name='usuario' maxlength="15" required> </td>
					</tr>
					<tr>
						<td> <b>Senha (Máximo de 15 caracteres): </b> </td>
						<td> <input type='password' name='senha'  maxlength="15" required> </td>
					</tr>
					<tr>
						<td> <b>Repita sua senha: </b> </td>
						<td> <input type='password' name='senha2'  maxlength="15" required> </td>
					</tr>
					<tr>
						<td> <b>Endereço completo: </b> </td>
						<td> <input type='text' name='endereco' size='60px' required> </td>
					</tr>
					<tr>
						<td> <b>Cidade/Estado: </b> </td>
						<td> <input type='text' name='cidade' size='60px' required> </td>
					</tr>
				</table>
			</p>
			<br>
			<p>
				<input class="btn btn-success" type='submit' name='cadastrar' value='Cadastrar novo cliente'>
			</p>
		</form>
		</div>
    </body>
<?php
	include('footer.inc.php');
?>