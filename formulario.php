<?php
session_start();
include 'conexao.php';
//verificar se os campos estão vazios
if(empty($_POST['nome']) || empty($_POST['data_nascimento']) || empty($_POST['rua']) || empty($_POST['numeroCasa']) || empty($_POST['bairro']) || empty($_POST['cep']) || empty($_POST['nomeResponsavel']) || empty($_POST['tipoResponsavel']) || empty($_POST['curso'])){
    $_SESSION['mensagem'] = "Preencha todos os campos!";
    header('Location: telaformulario.php');
    exit();
}
//Sanitização
$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
$rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
$numeroCasa = mysqli_real_escape_string($conexao, trim($_POST['numeroCasa']));
$bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
$cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$nomeResponsavel = mysqli_real_escape_string($conexao, trim($_POST['nomeResponsavel']));
$tipoResponsavel = mysqli_real_escape_string($conexao, trim($_POST['tipoResponsavel']));
$curso = mysqli_real_escape_string($conexao, trim($_POST['curso']));

//Inserir o novo usuário
$sqlInserir = "INSERT INTO form(nome, data_nascimento, rua, numeroCasa, bairro, cep, nomeResponsavel, tipoResponsavel, curso) VALUES ('$nome', '$data_nascimento', '$rua', '$numeroCasa', '$bairro', '$cep', '$nomeResponsavel', '$tipoResponsavel', '$curso')";

if(mysqli_query($conexao, $sqlInserir)){
    $_SESSION['mensagem'] = "Candidato cadastrado com sucesso!";
    header('Location: telaformulario.php');
    exit();
}else{
    $_SESSION['mensagem'] = "Erro ao cadastrar" . mysqli_error($conexao);
    header('Location: telaformulario.php');
    exit();
}
?>