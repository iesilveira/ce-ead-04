<?php
	require_once 'conecta_mysql.inc.php';
	$nome = $_POST['usuario'];
	$senha = $_POST['senha'];
	$confirma = (isset($_POST['checkAdm'])) ? $_POST['checkAdm']: '';
  
	if ($confirma == 'validaAdmin'){
		$sql = "select codigo, nome from admins where usuario='$nome' and senha='$senha'";
		$redirecionar = 'admin.php';
	}
	else {
		$sql = "select codigo, nome from clientes where usuario='$nome' and senha='$senha'";
		$redirecionar = 'loja.php';
	}
	
	$result = $mysqli->query( $sql );
	$dados = $result->fetch_assoc();

	if($dados['nome'] ==""){
		header('location:index.php?id=2');
	}
	else{
		echo 'Login efetudo com sucesso!'.$redirecionar;
		session_start();
		$_SESSION['usuario'] = $nome;
		$_SESSION['senha'] = $senha;
    $_SESSION['codigo'] = $dados['codigo'];
		$_SESSION['nome'] = $dados['nome'];
		header('location:'.$redirecionar);
	}
?>