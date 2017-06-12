<?php
	error_reporting(0);
	ini_set(“display_errors”, 0 );
 include('header.inc.php');
 require_once 'conecta_mysql.inc.php';
 require_once 'valida_sessao_cliente.inc.php';
 
 session_start();
 
 $nome = $_SESSION['nome'];
 $filtro = (isset($_POST['filtro'])) 
                ? $_POST['filtro'] 
                : '';
 $pesquisa =  (isset($_POST['pesquisa'])) 
                   ? $_POST['pesquisa'] 
                   : '';
$filtroURL = (isset($_GET['cat'])) 
                   ? $_GET['cat'] 
                   : '';
                   
$totalCarrinho = 0.00;
 
  if (isset($_SESSION['carrinho'])) {
    for($i = 0; $i < sizeof($_SESSION['carrinho']); $i++) {
        $qtde   = $_SESSION['carrinho'][$i]['qtde'];
        $preco  = $_SESSION['carrinho'][$i]['precoUnit'];
        $totalCarrinho += $qtde * $preco;
    }
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
    <meta charset="utf-8" />
    <title>
      LOJA :: LIVRARIA PROMOVE
    </title>
    <link rel="shortcut icon" href="book.png">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
	<body>
  <br><br><br>
   <div style='background-color: gray; opacity: 0.5; heigth: 100px; width: 780px;'>
   </div>
   <br>
  <?php
	  echo "<p>Seja bem-vindo, <b><i>". utf8_encode($nome)
	  ."</i></b>! Se você não for <b><i>". utf8_encode($nome)
	  ."</i></b>, clique <a href='saida.php'><button class='btn btn-danger' type='button' style='padding: 1px; width: 50px;'>AQUI</button></a> para sair do sistema e logar como outro usuário.</p><br><br>";
  ?>
   
	<p>Total da compra até o momento:
    <input size='10px' type='text'  value='R$ <?php echo number_format($totalCarrinho, 2, ',', '.');?>'readonly>
    <a href='carrinho.php'><img src='cart.png' id='cart' title='Carrinho de compras'style='max-width: 35px;'></a>
    </p>
	<br>
    <form name='form1' method='POST' action='loja.php'>
		<select name='filtro'> 
          <option SELECTED value='autor'>AUTOR</option>
          <option value='titulo'>TÍTULO</option>
        </select>
        <input type='text' size='100px' name='pesquisa'>
        <input class='btn btn-primary' type='submit' name='enviar' value='Pesquisar'> 
    </form>
	
   <p>
    <b> Categorias disponíveis: </b>
    <?php 
							$sql = "SELECT codigo, categoria FROM categorias";
							$result = $mysqli->query( $sql );
							for($i=0; $i < $mysqli->affected_rows; $i++)
							{
							  $dados = $result->fetch_assoc();
							  echo "<a href='loja.php?cat=".utf8_encode($dados['codigo'])."'><button class='btn btn-info' type='button'>".utf8_encode($dados['categoria'])."</button></a>&nbsp;&nbsp;";
                
							}              
      ?>
   </p>   
   <hr>
   
   <?php
    
    if($filtro <> ""){
      
      $sql = "SELECT codigo, `imagem`, `titulo`, `autor`, `preco`, `qtde` FROM `livros` where `".$filtro."` like '%".$pesquisa."%'";
      
    } else if ($filtroURL <> ""){
      
      $sql = "SELECT  codigo, `imagem`, `titulo`, `autor`, `preco`, `qtde` FROM `livros` where `categoria` like '%".$filtroURL."%'";
      
    } else{
      
      $sql = 'SELECT codigo, imagem, titulo, autor, preco, qtde FROM livros';
      
    }
    
    $result = $mysqli->query( $sql );
    for($i=0; $i < $mysqli->affected_rows; $i++)
      {
        $dados = $result->fetch_assoc();
        echo "<table align='center' style='display: inline-table; margin-top: 1cm; margin-left: 1cm; margin-right: 1cm;'> 
                <tr>
                  <td align='center'>
                    <img src='".$dados['imagem']."' alt='".utf8_encode($dados['titulo'])."' title='".utf8_encode($dados['titulo'])."' width='130px'  height='193px'><br><br>
                </tr>
              <tr>
              <td align='center'>"
                .'<span class="titulos"><b> Titulo: </span></b>'.utf8_encode($dados['titulo']).' <br>'
                .'<span class="titulos"><b> Autor: </span></b>'.utf8_encode($dados['autor']).' <br>'
                .'<span class="titulos"><b> Preço:</b> R$</span>'.$dados['preco'].' <br>'
                .'<span class="titulos"><b> Estoque: </span></b>'.$dados['qtde'].' <br>
                <form name="form2" method="POST"action="comprar.php"><br>
                  <input type="number" style= "width:70px; text-align:center;" name="qtdComprada" min="1" value="1">
                  <input type="hidden" name="codigo" value="'.$dados['codigo'].'">
                  <input type="hidden" name="titulo" value="'.$dados['titulo'].'">
                  <input type="hidden" name="autor" value="'.$dados['autor'].'">
                  <input type="hidden" name="precoUnit" value="'.$dados['preco'].'">
                  <input type="hidden" name="total" value="'.$totalCarrinho.'"><br><br>
                  <input type="submit" class="btn btn-success" name="enviar2" value="Comprar">
                </form>
              </td>
              </tr>
              </table>';
      }
   
   include('footer.inc.php');
   
  ?>   
  <br><br><br><br> 
</body>