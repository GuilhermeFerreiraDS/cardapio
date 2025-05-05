<?php
// Conexão com banco de dados
$conn = new mysqli("localhost", "root", "", "cardapio");
$result = $conn->query("SELECT * FROM pratos");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cardápio - BataHones</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #742f1c;
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
    }

    .header {
      background-color: #5b2314;
      padding: 1rem 3.5rem 1rem 1rem;
      color: #f8c33a;
      font-weight: bold;
      font-size: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header .back-arrow {
      color: #fff;
      font-size: 1.5rem;
      text-decoration: none;
    }

    .header .cart-btn {
      color: #fff;
      font-size: 1.5rem;
      position: relative;
    }

    .header .cart-count {
      position: absolute;
      top: -8px;
      right: -10px;
      background-color: red;
      color: white;
      border-radius: 50%;
      font-size: 0.75rem;
      padding: 2px 6px;
    }

    .search-bar {
      background-color: #fff;
      border-radius: 8px;
      padding: 0.5rem 1rem;
      margin: 1rem 0;
    }

    .card-item {
      background-color: #fff;
      border-radius: 12px;
      padding: 1rem;
      margin-bottom: 1rem;
      color: #333;
      display: flex;
      justify-content: space-between;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .card-item img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px;
      margin-left: 1rem;
    }

    .item-info {
      flex-grow: 1;
    }

    .item-info h5 {
      font-weight: bold;
      font-size: 1.1rem;
      margin-bottom: 0.3rem;
    }

    .item-info p {
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
    }

    .item-info .preco {
      font-weight: bold;
      color: #742f1c;
    }

    @media (max-width: 576px) {
      .card-item {
        flex-direction: column;
        text-align: center;
        align-items: center;
      }

      .card-item img {
        margin: 1rem 0 0;
      }
    }

    .btn-add {
      background-color: #f8c33a;
      color: #742f1c;
      font-weight: bold;
      border: none;
      margin-top: 0.5rem;
    }

    .offcanvas-body ul {
      padding-left: 1rem;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <a href="index.php" class="back-arrow"><i class="fas fa-arrow-left"></i></a>
    BataHones Cardápio
    <a href="#" class="cart-btn" data-bs-toggle="offcanvas" data-bs-target="#carrinhoOffcanvas">
      <i class="fas fa-shopping-cart"></i>
      <span class="cart-count" id="cart-count">0</span>
    </a>
  </div>

  <div class="container mt-2">
    <div class="search-bar">
      <input type="text" id="searchInput" class="form-control" placeholder="Buscar item...">
    </div>

    <div id="itensContainer">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card-item" data-nome="<?= strtolower($row['nome']) ?>">
          <div class="item-info">
            <h5><?= $row['nome'] ?></h5>
            <p><?= $row['ingredientes'] ?></p>
            <div class="preco">R$ <?= number_format($row['preco'], 2, ',', '.') ?></div>
            <button class="btn btn-add btn-sm" onclick="adicionarCarrinho('<?= $row['nome'] ?>', <?= $row['preco'] ?>)">Adicionar</button>
          </div>
          <img src="data:image/jpeg;base64,<?= base64_encode($row['img']) ?>" alt="<?= $row['nome'] ?>">
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Carrinho -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="carrinhoOffcanvas" aria-labelledby="carrinhoLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="carrinhoLabel">Carrinho</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body">
      <ul id="carrinhoItens" class="list-unstyled"></ul>
      <hr>
      <strong>Total: R$ <span id="total">0,00</span></strong>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const carrinho = [];
    const carrinhoLista = document.getElementById("carrinhoItens");
    const totalEl = document.getElementById("total");
    const cartCount = document.getElementById("cart-count");

    function adicionarCarrinho(nome, preco) {
      carrinho.push({ nome, preco });
      renderCarrinho();
    }

    function renderCarrinho() {
      carrinhoLista.innerHTML = "";
      let total = 0;
      carrinho.forEach(item => {
        const li = document.createElement("li");
        li.textContent = `${item.nome} - R$ ${item.preco.toFixed(2).replace('.', ',')}`;
        carrinhoLista.appendChild(li);
        total += item.preco;
      });
      totalEl.textContent = total.toFixed(2).replace('.', ',');
      cartCount.textContent = carrinho.length;
    }

    document.getElementById("searchInput").addEventListener("input", function () {
      const termo = this.value.toLowerCase();
      document.querySelectorAll(".card-item").forEach(item => {
        const nome = item.getAttribute("data-nome");
        item.style.display = nome.includes(termo) ? "flex" : "none";
      });
    });
  </script>

</body>
</html>
