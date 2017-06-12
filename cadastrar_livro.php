<?php 

  require_once 'valida_sessao_admin.inc.php';
  require_once 'config_upload.inc.php';
  require_once 'conecta_mysql.inc.php';
  
  $categoria = $_POST['categoria'];
  $titulo =  $_POST['titulo'];
  $autor  = $_POST['autor'];
  $preco = $_POST['preco'];
  $quantidade  = $_POST['quantidade'];
  $nomeArquivo = $_FILES['arquivo']['name'];
  $tamanho_arquivo = $_FILES['arquivo']['size'];
  $tempArquivo = $_FILES['arquivo']['tmp_name'];
  
  $extArquivo = strrchr($nomeArquivo, '.');
  
	if(!in_array($extArquivo, $extensoes_validas)){
        header('location:livros.php?id=1');
	} 
	else{
    $sql = "SELECT a.AUTO_INCREMENT FROM information_schema.tables a WHERE a.table_name = 'livros'";
    $result = $mysqli->query( $sql );
    $dados = $result->fetch_assoc();
    $nomeFinal = $dados['AUTO_INCREMENT'] . $extArquivo;
   
    move_uploaded_file($tempArquivo, "$diretorio/$nomeFinal");
    
    $sql = "INSERT INTO livros(categoria, titulo, autor, preco, imagem, qtde) VALUES ('$categoria', '$titulo', '$autor', '$preco', '$diretorio$nomeFinal', '$quantidade' )";
    $mysqli->query( $sql );
    header('location:admin.php?id=1'); 
  }
?>