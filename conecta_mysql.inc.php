<?php
	$servidor  = 'localhost';
	$banco = 'loja';
	$usuario_bd = 'root';
	$senha_bd = '';
	$mysqli = new mysqli($servidor, $usuario_bd, $senha_bd, $banco);
	$mysqli->set_charset('utf-8');
?>