<?php
session_start();
include 'conexao.php';
include 'menu_admin.php';

// consulta 10
$q = trim($_GET['q']);

$sql = "SELECT * FROM form WHERE nome LIKE ?";
$stmt = mysqli_prepare($conexao, $sql);
$search = "%$q%";
mysqli_stmt_bind_param($stmt, "s", $search);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

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
<title>Resultado da Pesquisa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
    <h2 class="mb-4">Resultados da pesquisa por: <strong><?= htmlspecialchars($q) ?></strong></h2>

    <?php if (mysqli_num_rows($result) > 0): ?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Curso</th>
                <th>Bairro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['nome']; ?></td>
                <td><?= $cursos[$row['curso']]; ?></td>
                <td><?= $row['bairro']; ?></td>
                <td>
                    <a href="editar.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="excluir.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php else: ?>
        <div class="alert alert-warning">Nenhum aluno encontrado!</div>
    <?php endif; ?>
</div>

</body>
</html>
