<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
 include('header.inc.php');
 require_once 'conecta_mysql.inc.php';
 require_once 'valida_sessao_cliente.inc.php';
 
 $data = date("Y/m/d");
 $pagamento = $_POST['pagamento'];
 $cliente = $_SESSION['codigo'];
 $subTotal = $_POST['total'];
 
 if (!isset($_SESSION['carrinho'])) {
   
    header('location:carrinho.php');
    exit();
  }
 
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<title>
			PEDIDO :: LIVRARIA PROMOVE
		</title>
		<link rel="shortcut icon" href="book.png">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
  
	<body>
  <br><br><br><br>
  
  
  <?php
  
    //Número do proximo pedido
    $sql = "SELECT a.AUTO_INCREMENT FROM information_schema.tables a WHERE a.table_name = 'pedidos'";
    $result = $mysqli->query( $sql );
    $dados = $result->fetch_assoc();
    $pedido = $dados['AUTO_INCREMENT'];
    
     $sql = "INSERT INTO pedidos(cliente, datapedido, valorpedido, pagamento) VALUES ('$cliente', '$data', '$subTotal', '$pagamento')";
          $mysqli->query( $sql );
      
     
     for($i = 0; $i < sizeof($_SESSION['carrinho']); $i++) {
            
          $codigo = $_SESSION['carrinho'][$i]['codigo'];
          $qtde = $_SESSION['carrinho'][$i]['qtde'];
        
          $sql = "INSERT INTO itens(pedido, livro, qtde) VALUES ('$pedido', '$codigo', '$qtde')";
          $mysqli->query( $sql );
          
          $sql = "UPDATE livros SET qtde= qtde-".$qtde." WHERE codigo=$codigo";
          $mysqli->query( $sql );
      }
      
	  unset($_SESSION['carrinho']);
  ?>
  <br><br><br><br>
  <h1> <b> Compra efetuada com sucesso </b> </h1>
  <br><br>
  
  <?php echo "<h2>Anote o número do seu pedido: <span style='color: red; background-color: white; font-style: bold;'>$pedido</span> </h2>";?>
 
  <br><br>
  
  <a href='loja.php'><button class='btn btn-primary' type='button'> Voltar à loja </button></a>
  
  <?php
  
    include('footer.inc.php');
  
  ?>