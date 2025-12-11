<?php
session_start();
include 'conexao.php';
include 'menu_admin.php';

//consulta 1

$busca = "";
if (isset($_GET['q'])) {
    $busca = trim($_GET['q']);
    $sql = "SELECT * FROM form WHERE nome LIKE ? ORDER BY id ASC";
    $stmt = mysqli_prepare($conexao, $sql);
    $valor = "%$busca%";
    mysqli_stmt_bind_param($stmt, "s", $valor);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    //consulta 2
    $sql = "SELECT * FROM form ORDER BY id ASC";
    $result = mysqli_query($conexao, $sql);
}


$cursos = [
    1 => "Enfermagem",
    2 => "Informática",
    3 => "Desenvolvimento de Sistemas",
    4 => "Administração"
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lista de Candidatos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container my-4">

    <h2 class="mb-4 text-center">Lista Completa de Candidatos</h2>

    <!-- 🔍 BARRA DE PESQUISA -->
    <form method="GET" class="input-group mb-4">
        <input type="text" name="q" class="form-control" placeholder="Pesquisar candidato pelo nome..."
               value="<?= htmlspecialchars($busca); ?>">
        <button class="btn btn-primary">Buscar</button>
    </form>

    <!-- TABELA -->
    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome do Candidato</th>
                <th>Curso</th>
                <th>Bairro</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['nome']); ?></td>
                    <td><?= $cursos[$row['curso']]; ?></td>
                    <td><?= htmlspecialchars($row['bairro']); ?></td>
                    <td>
                        <a href="editar.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Editar</a>

                        <a href="excluir.php?id=<?= $row['id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Deseja realmente excluir este candidato?')">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>

        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center text-danger">
                    Nenhum candidato encontrado!
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

</body>
</html>
