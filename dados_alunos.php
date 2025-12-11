<?php
session_start();
include 'conexao.php';
include 'menu_admin.php';

//consulta 3
$sqlCursos = "SELECT curso, COUNT(*) AS total FROM form GROUP BY curso";
$resultCursos = mysqli_query($conexao, $sqlCursos);

$cursosNomes = [
  1 => "Enfermagem",
  2 => "Informática",
  3 => "Desenvolvimento de Sistemas",
  4 => "Administração"
];

$cursoLabels = [];
$cursoValores = [];

while ($row = mysqli_fetch_assoc($resultCursos)) {
    $cursoLabels[] = $cursosNomes[$row['curso']];
    $cursoValores[] = $row['total'];
}

//consulta 4
$sqlBairros = "SELECT bairro, COUNT(*) AS total FROM form GROUP BY bairro ORDER BY total DESC";
$resultBairros = mysqli_query($conexao, $sqlBairros);

$bairroLabels = [];
$bairroValores = [];

while ($row = mysqli_fetch_assoc($resultBairros)) {
    $bairroLabels[] = $row['bairro'];
    $bairroValores[] = $row['total'];
}


$maxIndex = array_keys($cursoValores, max($cursoValores))[0];


$totalCandidatos = array_sum($cursoValores);
$cursoPercentuais = [];
foreach ($cursoValores as $valor) {
    $cursoPercentuais[] = round(($valor / $totalCandidatos) * 100, 2);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gráficos</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="row text-center mb-4">
        <h2 class="fw-bold">Relatórios dos Candidatos</h2>
    </div>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-header text-center fw-bold">
                    Candidatos por Curso
                </div>
                <div class="card-body">
                    <canvas id="graficoCurso"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-header text-center fw-bold">
                    Bairros com mais candidatos
                </div>
                <div class="card-body">
                    <canvas id="graficoBairro"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-header text-center fw-bold">
                    Porcentagem por Curso
                </div>
                <div class="card-body">
                    <canvas id="graficoPercentual"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
const cursoLabels = <?= json_encode($cursoLabels); ?>;
const cursoValores = <?= json_encode($cursoValores); ?>;
const cursoPercentuais = <?= json_encode($cursoPercentuais); ?>;

const bairroLabels = <?= json_encode($bairroLabels); ?>;
const bairroValores = <?= json_encode($bairroValores); ?>;

const maiorCursoIndex = <?= $maxIndex ?>;

const cores = [
  '#ff0000c7', '#5900ffff', '#1cc206ff', '#3282ebff',
  '#59a14f', '#edc949', '#af7aa1', '#006effff'
];

let coresDestaque = [...cores];
coresDestaque[maiorCursoIndex] = "#9303ccff"; // Destaca o maior em preto

// Gráfico 1 - Pizza
new Chart(document.getElementById('graficoCurso'), {
    type: 'pie',
    data: {
        labels: cursoLabels,
        datasets: [{
            data: cursoValores,
            backgroundColor: coresDestaque
        }]
    }
});

// Gráfico 2 - Barra
new Chart(document.getElementById('graficoBairro'), {
    type: 'bar',
    data: {
        labels: bairroLabels,
        datasets: [{
            label: 'Quantidade',
            data: bairroValores,
            backgroundColor: '#adadadff'
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});

// Gráfico 3 - Pizza percentual
new Chart(document.getElementById('graficoPercentual'), {
    type: 'pie',
    data: {
        labels: cursoLabels,
        datasets: [{
            data: cursoPercentuais,
            backgroundColor: cores
        }]
    },
    options: {
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.raw + '%';
                    }
                }
            }
        }
    }
});
</script>

</body>
</html>
