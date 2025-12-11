<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="painel_admin.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dados_alunos.php">Dados - Alunos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lista_candidatos.php">Candidatos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="popular.php">Popular Banco</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Sair</a>
        </li>
      </ul>

      <!-- 🔍 BARRA DE PESQUISA -->
      <form class="d-flex ms-3" method="GET" action="pesquisa.php">
        <input class="form-control me-2" type="search" name="q" placeholder="Pesquisar aluno..." required>
        <button class="btn btn-outline-light" type="submit">Buscar</button>
      </form>

    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
