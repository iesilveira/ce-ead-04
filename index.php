<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );

	include('header.inc.php');

	$error = (isset($_GET['id'])) ? $_GET['id'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<title>
			LOGIN :: LIVRARIA PROMOVE
		</title>
		<link rel="shortcut icon" href="book.png">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
	<body>
	<br><br><br><br><br><br><br>
		<?php
		if ($error == '1')
		{
		echo "<div class='alert alert-danger'>FAVOR EFETUAR <b><i>LOGIN</i></b></div>";
		} 
		else if($error == '2'){

		echo "<div class='alert alert-danger'>USUÁRIO OU SENHA INCORRETOS</div>";
		}
		else if($error == '3'){
			
		echo "<div class='alert alert-success'>CADASTRO REALIZADO COM SUCESSO, FAVOR EFETUAR LOGIN!</div>";
		}
		?>
		<h1>
			Seja bem-vindo à Livraria Promove!
		</h1>
		<br>
		<p>
			Para sua comodiadade, efetue o <b><i>login</i></b>:
		</p>
		<br><br>
		<form name='form1' method='POST' action='login.php'>
			<table align='center'>
				<tr>
					<td> <b>Usuário:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
					<td> <input type='text' name='usuario' required> </td>
				</tr>
				<tr>
					<td> <b>Senha: </b></td>
					<td> <input type='password' name='senha'> </td>
				</tr>
			</table>
			<br>
		<p>
				<label><input type='checkbox' name='checkAdm' value='validaAdmin'> Efetuar <i>login</i> como <b>Administrador</b><label>
		</p>
		<br>		
		<p>
			<input class="btn btn-success" type='submit' name='validar' value='LOGIN'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="cadastro.php"><button class="btn btn-primary" type='button'>CADASTRE-SE</button></a>
		</p>
		</form>
		<br>
	</body>
</html>
<?php
	include('footer.inc.php');
?>