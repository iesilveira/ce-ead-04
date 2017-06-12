<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
  require_once 'conecta_mysql.inc.php';
  require_once 'valida_sessao_cliente.inc.php';
  include('header.inc.php');
  
  
  session_start();
  
  
  if(isset($_GET['id'])){
    
    unset($_SESSION['carrinho']);
    
    header('location:carrinho.php');
    
  }
?>
<!DOCTYPE HTML>
<html lang="pt-br">
   <head>
		<meta charset="utf-8">
		<title>
			CARRINHO :: LIVRARIA PROMOVE
		</title>
		<link rel="shortcut icon" href="book.png">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="estilo.css">
    </head>
    <body>
			
		<br><br><br><br>
        <h1>Carrinho de compras</h1>
		<br>
    <p>
    <a href='loja.php'><button class='btn btn-primary' type='button'>Continuar Comprando</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href='carrinho.php?id=l'><button class='btn btn-danger' type='button'>Limpar Carrinho</button></a>
    </p>
    <br>
    <?php
    
     $subTotal = 0.00;
     
      if (isset($_SESSION['carrinho'])) {            
             
            echo "<table class='table' style='background-color: gray;'>
                   <tr>
                     <th style='text-align:center'>Código</th>
                     <th style='text-align:center'>Titulo</th>
                     <th style='text-align:center'>Autor</th>
                     <th style='text-align:center'>Quantidade</th>
                     <th style='text-align:center'>Preço Unitário</th>
                     <th style='text-align:center'>Total</th>
                   </tr>";
             
            for($i = 0; $i < sizeof($_SESSION['carrinho']); $i++) {
               
              $codigo = $_SESSION['carrinho'][$i]['codigo'];
              $titulo = $_SESSION['carrinho'][$i]['titulo'];
              $autor = $_SESSION['carrinho'][$i]['autor'];
              $qtde = $_SESSION['carrinho'][$i]['qtde'];
              $preco = $_SESSION['carrinho'][$i]['precoUnit'];
              $subTotal += $qtde * $preco;
                             
              echo "<tr>
                      <td style='text-align:center'>".$codigo."</td>
                      <td style='text-align:center'>".utf8_encode($titulo)."</td>
                      <td style='text-align:center'>".utf8_encode($autor)."</td>
                      <td style='text-align:center'>".$qtde."</td>
                      <td style='text-align:center'>".$preco."</td>
                      <td style='text-align:center'>" . number_format($qtde * $preco, 2, ',', '.') . 
                      "</td>
                    </tr>";
                    
            }
                echo" <tr>
                          <td style='text-align:center; font-size: 20px;' colspan='6'><b> Subtotal: ".number_format($subTotal, 2, ',', '.') ."</b>
                      </tr>
                    </table>";      
          } else {
            
            echo "<h3> <b><i>Carrinho de compras Vazio</i></b> </h3>";
          }
          
    ?>
     
    <form name='form' method='POST' action='pedido.php'>
      
      <p> Selecione a forma de pagamento: 
      
      <select name='pagamento'> 
    
        <?php
            $sql = 'SELECT codigo, tipo FROM pagamentos';
							$result = $mysqli->query( $sql );
							for($i=0; $i < $mysqli->affected_rows; $i++)
							{
							  $dados = $result->fetch_assoc();
							  echo "<option value='".$dados['codigo']."'>". utf8_encode($dados['tipo']). "</option>";
                
							}  
        ?>
      </select>
      </p>
      <br>
      <input type="hidden" name="total" value="<?php echo $subTotal?> ">
      <input class="btn btn-success"type='submit' name='enviar' value='Concluir pedido'>
    </form>
 
 
 
    <?php
      include('footer.inc.php');
    ?>
	</body>
</html>
