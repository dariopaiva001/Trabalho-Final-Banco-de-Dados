<?php
include 'conexao.php';

// Verificar se o ID foi enviado
if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = intval($_GET['id']);

//consulta 5
$sql = "SELECT * FROM form WHERE id = $id";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Candidato não encontrado!");
}

$dados = mysqli_fetch_assoc($result);


$cursos = [
    1 => "Enfermagem",
    2 => "Informática",
    3 => "Desenvolvimento de Sistemas",
    4 => "Administração"
];


$tipos = [
    1 => "Mãe",
    2 => "Pai",
    3 => "Outro"
];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Candidato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h3 class="text-center">Editar Candidato</h3>
        </div>

        <div class="card-body">
            <form action="salvar_edicao.php" method="POST">

                <input type="hidden" name="id" value="<?= $dados['id'] ?>">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" required value="<?= $dados['nome'] ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Data de Nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control" required value="<?= $dados['data_nascimento'] ?>">
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Rua</label>
                        <input type="text" name="rua" class="form-control" required value="<?= $dados['rua'] ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Número</label>
                        <input type="text" name="numeroCasa" class="form-control" required value="<?= $dados['numeroCasa'] ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Bairro</label>
                        <input type="text" name="bairro" class="form-control" required value="<?= $dados['bairro'] ?>">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>CEP</label>
                        <input type="text" name="cep" class="form-control" required value="<?= $dados['cep'] ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Nome do Responsável</label>
                        <input type="text" name="nomeResponsavel" class="form-control" required value="<?= $dados['nomeResponsavel'] ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Tipo de Responsável</label>
                        <select name="tipoResponsavel" class="form-control">
                            <?php foreach ($tipos as $key => $value): ?>
                                <option value="<?= $key ?>" <?= $dados['tipoResponsavel'] == $key ? "selected" : "" ?>>
                                    <?= $value ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                </div>

                <div class="mb-3">
                    <label>Curso</label>
                    <select name="curso" class="form-control">
                        <?php foreach ($cursos as $key => $value): ?>
                            <option value="<?= $key ?>" <?= $dados['curso'] == $key ? "selected" : "" ?>>
                                <?= $value ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-success" type="submit">Salvar Alterações</button>
                    <a href="lista_candidatos.php" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
