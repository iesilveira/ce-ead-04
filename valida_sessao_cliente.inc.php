<?php

	session_start();
  
	if(isset($_SESSION['usuario']) && isset($_SESSION["senha"])){
		require_once 'conecta_mysql.inc.php';
		$sql = "select nome from clientes where usuario='".$_SESSION['usuario']."' and senha='".$_SESSION['senha']."'";
		$result = $mysqli->query( $sql );
		$dados = $result->fetch_assoc();
		
		if($dados['nome'] == ''){
			header('location:index.php?id=1');
		}
	}
	else{
		header('location:index.php?id=1');
	}
?>