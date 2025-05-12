<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "cardapio";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
  die("Erro ao conectar: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "SELECT img FROM pratos WHERE id = $id";
  $resultado = mysqli_query($conexao, $sql);

  if ($linha = mysqli_fetch_assoc($resultado)) {
    header("Content-Type: image/jpeg"); // ou image/png, conforme o tipo real da imagem
    echo $linha['img'];
  }
}
?>
