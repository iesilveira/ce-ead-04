<?php
	session_start();
		$_SESSION['usuario'] = '';
		$_SESSION['senha'] = '';
		$_SESSION['nome'] = '';
		$_SESSION = array();
	session_destroy();
	
	header('location:index.php');
?>