<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
	require_once 'conecta_mysql.inc.php';
	require_once 'valida_sessao_cliente.inc.php';
 
  session_start();
   
  $codigo = $_POST['codigo'];
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $preco  = $_POST['precoUnit'];
  $qtde   = $_POST['qtdComprada'];
  $itens  = 0;
   
  if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
   
  }
  else {
    $itens = sizeof($_SESSION['carrinho']);
  }
   
  $achou = FALSE;
   
  for($i = 0; $i < sizeof($_SESSION['carrinho']); $i++) {
     
    if ($_SESSION['carrinho'][$i]['codigo'] == $codigo) {
       
      $_SESSION['carrinho'][$i]['qtde'] += $qtde;
      $achou = TRUE;
      break;
    }
  }
   
  if (!$achou) {  
    $_SESSION['carrinho'][$itens]['codigo'] = $codigo;
    $_SESSION['carrinho'][$itens]['titulo'] = utf8_encode($titulo);
    $_SESSION['carrinho'][$itens]['autor'] = utf8_encode($autor);
    $_SESSION['carrinho'][$itens]['qtde']   = $qtde;
    $_SESSION['carrinho'][$itens]['precoUnit']  = $preco;
  }
   
  header('location:loja.php');
?>