<?php 

	require_once 'conecta_mysql.inc.php';

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$senha2 = $_POST['senha2'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$endereco = $_POST['endereco'];
	$cidade = $_POST['cidade'];

	if($senha == $senha2){
		$sql = "select email, usuario from clientes where email='".$email."' or usuario = '".$usuario."'";
		$result = $mysqli->query( $sql );
		$dados = $result->fetch_assoc();

		if($dados['email'] == $email || $dados['usuario'] == $usuario){
			header('location:cadastro.php?id=2');
		} 
		else {
			$sql = "INSERT INTO clientes(usuario, senha, nome, email, endereco, cidade) VALUES ('$usuario', '$senha', '$nome', '$email', '$endereco', '$cidade')";
			$mysqli->query( $sql );
			header('location:index.php?id=3');
		}
	} 
	else {
		header('location:cadastro.php?id=3');
	}
?>