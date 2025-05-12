<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $preco = $_POST['preco'];

  $item = [
    'id' => $id,
    'nome' => $nome,
    'preco' => $preco,
    'quantidade' => 1
  ];

  if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
  }

  // Se já existir, incrementa quantidade
  $existe = false;
  foreach ($_SESSION['carrinho'] as &$produto) {
    if ($produto['id'] == $id) {
      $produto['quantidade']++;
      $existe = true;
      break;
    }
  }

  if (!$existe) {
    $_SESSION['carrinho'][] = $item;
  }

  header("Location: cardapio.php");
  exit();
}
?>
