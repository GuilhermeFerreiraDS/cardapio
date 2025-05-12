<?php 
  $servidor = "localhost";
  $usuario = "root";
  $senha = "";
  $banco = "cardapio";

  $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
  if (!$conexao) {
    die("Erro ao conectar: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM pratos";
  $resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Cardápio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #642c10;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #5a200b;
      color: #f7b731;
      padding: 16px;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      position: sticky;
      top: 0;
      z-index: 10;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .back-button, .cart-button {
      background: none;
      border: none;
      font-size: 24px;
      color: #f7b731;
      cursor: pointer;
      position: relative;
    }

    .cart-count {
      position: absolute;
      top: -6px;
      right: -6px;
      background: red;
      color: white;
      font-size: 12px;
      padding: 2px 6px;
      border-radius: 50%;
    }

    .container {
      padding: 16px;
      max-width: 800px;
      margin: 0 auto;
    }

    .search-box input {
      width: 100%;
      padding: 12px 16px;
      border-radius: 20px;
      border: none;
      font-size: 16px;
      box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .card {
      display: flex;
      justify-content: space-between;
      background-color: #fff;
      padding: 16px;
      border-radius: 16px;
      margin-bottom: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      flex-wrap: wrap;
      gap: 12px;
    }

    .info {
      flex: 1 1 200px;
    }

    .info h3 {
      margin: 0 0 4px;
      font-size: 18px;
      color: #4b1d0c;
    }

    .info p {
      margin: 0 0 10px;
      color: #666;
      font-size: 14px;
    }

    .precos {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .preco {
      background: #fff3e0;
      padding: 6px 10px;
      border-radius: 10px;
      font-size: 13px;
      border: 1px solid #f0d2a0;
      cursor: pointer;
    }

    .preco:hover {
      background: #f7b731;
      color: white;
    }

    .imagem img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 12px;
      border: 2px solid #fff;
    }

    @media (max-width: 600px) {
      .card {
        flex-direction: row;
        align-items: center;
      }

      .info {
        order: 1;
        flex: 1;
      }

      .imagem {
        order: 2;
      }

      .imagem img {
        width: 100px;
        height: auto;
      }
    }

    .modal-content {
      background-color: #fffaf2;
      margin: 5% auto;
      padding: 20px;
      border-radius: 16px;
      width: 90%;
      max-width: 500px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.2);
      animation: slideDown 0.3s ease forwards;
    }

    #cartList {
      padding: 0;
      margin: 0;
      list-style: none;
    }

    #cartList li {
      background: #fff;
      padding: 16px;
      border-radius: 12px;
      margin-bottom: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    #cartList li strong {
      font-size: 16px;
      color: #2c3e50;
    }

    #cartList li span {
      font-size: 14px;
      color: #555;
    }

    .item-actions {
      display: flex;
      justify-content: flex-start;
      gap: 12px;
    }

    .item-actions button {
      background-color: transparent;
      border: none;
      cursor: pointer;
      padding: 4px;
      transition: transform 0.2s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .item-actions button svg {
      width: 22px;
      height: 22px;
    }

    .item-actions button:hover {
      transform: scale(1.2);
    }

    .whatsapp-btn {
      background-color: #25D366;
      color: white;
      padding: 14px 22px;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: background-color 0.2s;
    }

    .whatsapp-btn:hover {
      background-color: #1ebe5d;
    }
  </style>
</head>

<body>

  <header>
    <div class="header-left">
      <button class="back-button" onclick="window.location.href='index.php'">&#8592;</button>
      BataHones Cardápio
    </div>
    <button class="cart-button" onclick="openCart()">
      🛒 <span class="cart-count" id="cartCount">0</span>
    </button>
  </header>

  <div class="container">
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Buscar item...">
    </div>

    <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
      <div class="card">
        <div class="info">
          <h3><?php echo $linha['nome']; ?></h3>
          <p><?php echo $linha['ingredientes']; ?></p>
          <div class="precos">
            <div class="preco" onclick="addToCart('<?php echo $linha['nome']; ?>', 'Pequeno', <?php echo $linha['preco_p']; ?>)">
              <span>PEQUENO</span><br><strong>R$ <?php echo number_format($linha['preco_p'], 2, ',', '.'); ?></strong>
            </div>
            <div class="preco" onclick="addToCart('<?php echo $linha['nome']; ?>', 'Médio', <?php echo $linha['preco_m']; ?>)">
              <span>MÉDIO</span><br><strong>R$ <?php echo number_format($linha['preco_m'], 2, ',', '.'); ?></strong>
            </div>
          </div>
        </div>
        <div class="imagem">
          <img src="mostrar_imagem.php?id=<?php echo $linha['id']; ?>" alt="Imagem do prato">
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- Modal do Carrinho -->
  <div id="cartModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeCart()">&times;</span>
      <h3>Itens no Carrinho</h3>
      <ul id="cartList"></ul>

      <div class="cart-actions">
        <button class="whatsapp-btn" onclick="enviarPedidoWhatsApp()">Finalizar Pedido no WhatsApp</button>
      </div>
    </div>
  </div>

  <script>
    let cart = [];

    function addToCart(nome, tamanho, preco) {
      cart.push({
        nome,
        tamanho,
        preco
      });
      updateCartUI();
    }

    function removeFromCart(index) {
      cart.splice(index, 1);
      updateCartUI();
    }

    function updateCartUI() {
      const cartList = document.getElementById("cartList");
      const cartCount = document.getElementById("cartCount");
      cartList.innerHTML = '';
      cart.forEach((item, index) => {
        const li = document.createElement("li");
        li.innerHTML = `
  <div>
    <strong>${item.nome}</strong> <span>- ${item.tamanho} - R$ ${item.preco.toFixed(2)}</span>
  </div>
  <div class="item-actions">
    <button onclick="addToCart('${item.nome}', '${item.tamanho}', ${item.preco})" title="Adicionar novamente">
      <svg viewBox="0 0 24 24" fill="#27ae60" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      </svg>
    </button>
    <button onclick="removeFromCart(${index})" title="Remover item">
      <svg viewBox="0 0 24 24" fill="#e74c3c" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 6l12 12M6 18L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </button>
  </div>
`;

        cartList.appendChild(li);
      });
      cartCount.textContent = cart.length;
    }

    function openCart() {
      document.getElementById("cartModal").style.display = "block";
    }

    function closeCart() {
      document.getElementById("cartModal").style.display = "none";
    }

    function enviarPedidoWhatsApp() {
      if (cart.length === 0) {
        alert("Seu carrinho está vazio.");
        return;
      }

      let mensagem = "Pedido:\n";
      cart.forEach(item => {
        mensagem += `• ${item.nome} - ${item.tamanho} - R$ ${item.preco.toFixed(2)}\n`;
      });

      const numero = "5515996684528";
      const url = `https://wa.me/${numero}?text=${encodeURIComponent(mensagem)}`;
      window.open(url, "_blank");
    }

    // Busca funcional
    document.getElementById("searchInput").addEventListener("input", function() {
      const termo = this.value.toLowerCase();
      const cards = document.querySelectorAll(".card");

      cards.forEach(card => {
        const nome = card.querySelector(".info h3").textContent.toLowerCase();
        const ingredientes = card.querySelector(".info p").textContent.toLowerCase();

        if (nome.includes(termo) || ingredientes.includes(termo)) {
          card.style.display = "flex";
        } else {
          card.style.display = "none";
        }
      });
    });
  </script>

</body>

</html>