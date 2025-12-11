<?php
include 'conexao.php';
include 'menu_admin.php';

$message = "";


// --- quando clicar em popular ---
if (isset($_GET['pop'])) {

    date_default_timezone_set('America/Sao_Paulo');

    // Listas usadas para gerar dados
    $primeiros_nomes = ['Ana','Lara','Adeílson','Ellen','Adrielson','Guilherme','Bruno','Carla','Daniel','Eduarda','Fábio','Gabriela','Hugo','Isabela','João','Larissa','Marcos','Natália','Otávio','Patrícia','Rafael','Sofia','Tiago','Vitória','William'];
    $sobrenomes = ['Castro','Ferreira','Silva','Sales','Aragão','Gomes','Oliveira','Santos','Oliveira','Souza','Rodrigues','Ferreira','Alves','Pereira','Lima','Gomes','Costa','Ribeiro','Martins','Carvalho','Almeida'];
    $ruas = ['Rua das Flores','Avenida Principal','Rua da Matriz','Travessa das Acácias','Rua dos Pinheiros','Avenida Brasil','Rua do Comércio'];
    $bairros = ['Centro','Morada dos Ventos I','Morada dos Ventos II','Morada dos Ventos III','Patriarcas','Dois mil','Dom Fragoso','Venâncios','São Vicente','Planalto','Cidade Nova'];
    $cursos = [1,2,3,4];

    for ($i = 1; $i <= 100; $i++) {
        
        $nome_aleatorio = $primeiros_nomes[array_rand($primeiros_nomes)] . " " . $sobrenomes[array_rand($sobrenomes)];
        $resp_aleatorio = $primeiros_nomes[array_rand($primeiros_nomes)] . " " . $sobrenomes[array_rand($sobrenomes)];

        $timestamp_aleatorio = mt_rand(strtotime("2004-01-01"), strtotime("2010-12-31"));
        $data_nasc = date("Y-m-d",$timestamp_aleatorio);

        $rua = $ruas[array_rand($ruas)];
        $numero = rand(10,1500);
        $bairro = $bairros[array_rand($bairros)];
        $cep = rand(10000,99999) . "-" . rand(100,999);
        $tipo_resp = rand(1,6);
        $curso_escolhido = $cursos[array_rand($cursos)];

        $sql = "INSERT INTO form 
            (nome, data_nascimento, rua, numeroCasa, bairro, cep, nomeResponsavel, tipoResponsavel, curso)
            VALUES 
            ('$nome_aleatorio','$data_nasc','$rua','$numero','$bairro','$cep','$resp_aleatorio','$tipo_resp','$curso_escolhido')";

        $conexao->query($sql);
    }

    $message = "<b>100 alunos populados com sucesso!</b>";
}

//
// --- quando clicar em despopular ---
//
if (isset($_GET['despop'])) {

    // apaga os 100 últimos registros (que foram populados)
    $sqlDel = "DELETE FROM form ORDER BY id DESC LIMIT 100";
    mysqli_query($conexao, $sqlDel);

    // reseta o auto_increment
    mysqli_query($conexao, "ALTER TABLE form AUTO_INCREMENT = 1");

    $message = "<b>100 alunos apagados e IDs reiniciados!</b>";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Banco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">

                <div class="card shadow-lg">
                    <div class="card-body p-5 text-center">

                        <h1 class="fs-4 card-title fw-bold mb-4">Popular / Despopular</h1>

                        <a href="popular.php?pop=1" class="btn btn-primary btn-lg w-100 mb-2">
                            Popular Banco (100 alunos)
                        </a>

                        <a href="popular.php?despop=1" class="btn btn-danger btn-lg w-100">
                            Despopular (remover os 100 últimos)
                        </a>

                        <?php if ($message != ""): ?>
                        <div class="alert alert-info mt-3">
                            <?= $message ?>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="text-center mt-3 text-muted">
                    © 2025 — Manoel
                </div>

            </div>
        </div>
    </div>
</section>
</body>
</html>
