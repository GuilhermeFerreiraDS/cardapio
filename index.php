<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BATAHONES</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f5eddf;
      font-family: 'Georgia', serif;
      color: #3c2b1c;
      text-align: center;
      padding-bottom: 3rem;
    }

    .menu-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: none;
      border: none;
      font-size: 1.8rem;
      color: #3c2b1c;
      z-index: 1051;
    }

    .brand-icon {
      font-size: 1.5rem;
      margin-top: 2rem;
    }

    .brand-title {
      font-size: 3rem;
      font-weight: bold;
      line-height: 1.2;
    }

    .potato-img {
      width: 180px;
      height: auto;
      margin: 1.5rem auto;
      border: 3px solid #3c2b1c;
      border-radius: 50%;
      padding: 0.5rem;
    }

    .highlight-text {
      font-size: 1.5rem;
    }

    .btn-custom {
      margin-top: 1.5rem;
      margin-bottom: 2.5rem;
      border: 1px solid #3c2b1c;
      background-color: transparent;
      color: #3c2b1c;
      padding: 0.5rem 1.25rem;
      border-radius: 8px;
      font-weight: bold;
    }

    .btn-custom:hover {
      background-color: #3c2b1c;
      color: #fff;
    }

    .offcanvas {
      background-color: #f5eddf;
      color: #3c2b1c;
    }

    .offcanvas-body {
      text-align: left;
    }

    .offcanvas-body a {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1rem;
      font-weight: bold;
      text-decoration: none;
      color: #3c2b1c;
      font-size: 1.2rem;
    }

    .card:hover {
      transform: scale(1.03);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card img {
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }

    .card-body {
      padding: 1rem 1.25rem;
    }

    .card-footer {
      padding: 0.75rem 1.25rem;
    }

    @media (max-width: 768px) {
      .card img {
        height: 160px;
      }

      .card-title {
        font-size: 1.1rem;
      }

      .card-text small {
        font-size: 0.9rem;
      }

      .card-footer strong {
        font-size: 1rem;
      }
    }

    @media (max-width: 576px) {
      .offcanvas-end {
        width: 100% !important;
      }
    }
  </style>
</head>

<body>

  <!-- Botão de Menu -->
  <button id="menuBtn" class="menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
    aria-controls="offcanvasMenu">
    ☰
  </button>

  <!-- Menu Lateral -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasMenuLabel">BATAHONES</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body">
      <a href="#"><i class="bi bi-info-circle"></i> SOBRE</a>
      <a href="cardapio.php"><i class="bi bi-list"></i> CARDÁPIO</a>
      <a href="#"><i class="bi bi-envelope"></i> CONTATO</a>
    </div>
  </div>

  <!-- Conteúdo Principal -->
  <div class="container">
    <div class="brand-icon">✦</div>
    <div class="brand-title">BATAHONES</div>
    <img src="img/b1ab11c8-dd1e-44e2-adb3-d425b5d31335.jpeg" alt="Batata Recheada" class="potato-img">
    <p class="highlight-text">
      BataHones: aqui o sabor<br>não tem preocupação!
    </p>
    <button class="btn btn-custom" onclick="window.location.href='cardapio.php'">Ver Cardápio</button>
  </div>

  <!-- Cardápio do Dia -->
  <div class="container-fluid bg-white py-5" style="min-height: 100vh;">
    <div class="container">
      <h2 class="brand-title mb-5" style="font-size: 2.5rem;">Cardápio do Dia</h2>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <!-- Card 1 -->
        <div class="col">
          <div class="card h-100 border-0 shadow rounded-4">
            <img src="img/296e0e51-4e56-4301-bcf2-7d9149fb8445.jpeg" alt="Batata Cheddar Bacon">
            <div class="card-body">
              <h6 class="text-uppercase text-muted">Batata Cheddar</h6>
              <h5 class="card-title fw-bold">Batata Cheddar Bacon</h5>
              <p class="card-text">
                <small>Batata, cheddar cremoso, bacon crocante, cebolinha.</small>
              </p>
            </div>
            <div class="card-footer bg-white border-0 text-end">
              <strong class="text-dark fs-5">R$ 24,90</strong>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col">
          <div class="card h-100 border-0 shadow rounded-4">
            <img src="img/296e0e51-4e56-4301-bcf2-7d9149fb8445.jpeg" alt="Batata Frango Catupiry">
            <div class="card-body">
              <h6 class="text-uppercase text-muted">Batata Frango</h6>
              <h5 class="card-title fw-bold">Batata Frango Catupiry</h5>
              <p class="card-text">
                <small>Batata, frango desfiado, catupiry original, batata palha.</small>
              </p>
            </div>
            <div class="card-footer bg-white border-0 text-end">
              <strong class="text-dark fs-5">R$ 26,90</strong>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
          <div class="card h-100 border-0 shadow rounded-4">
            <img src="img/296e0e51-4e56-4301-bcf2-7d9149fb8445.jpeg" alt="Batata Vegana">
            <div class="card-body">
              <h6 class="text-uppercase text-muted">Batata Vegana</h6>
              <h5 class="card-title fw-bold">Batata Vegana</h5>
              <p class="card-text">
                <small>Batata, legumes salteados, creme de tofu, ervas finas.</small>
              </p>
            </div>
            <div class="card-footer bg-white border-0 text-end">
              <strong class="text-dark fs-5">R$ 22,90</strong>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const offcanvasMenu = document.getElementById('offcanvasMenu');
    const menuBtn = document.getElementById('menuBtn');

    offcanvasMenu.addEventListener('show.bs.offcanvas', () => {
      menuBtn.classList.add('d-none');
    });

    offcanvasMenu.addEventListener('hidden.bs.offcanvas', () => {
      menuBtn.classList.remove('d-none');
    });
  </script>
</body>

</html>
