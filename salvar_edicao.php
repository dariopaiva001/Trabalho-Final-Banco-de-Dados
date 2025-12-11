<?php
include 'conexao.php';


$id = $_POST['id'];
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$rua = $_POST['rua'];
$numeroCasa = $_POST['numeroCasa'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$nomeResponsavel = $_POST['nomeResponsavel'];
$tipoResponsavel = $_POST['tipoResponsavel'];
$curso = $_POST['curso'];

//consulta 9

$sql = "UPDATE form SET 
    nome='$nome',
    data_nascimento='$data_nascimento',
    rua='$rua',
    numeroCasa='$numeroCasa',
    bairro='$bairro',
    cep='$cep',
    nomeResponsavel='$nomeResponsavel',
    tipoResponsavel='$tipoResponsavel',
    curso='$curso'
    WHERE id=$id";

if (mysqli_query($conexao, $sql)) {
    header("Location: lista_candidatos.php?edit=ok");
} else {
    echo "Erro ao salvar: " . mysqli_error($conexao);
}
?>
