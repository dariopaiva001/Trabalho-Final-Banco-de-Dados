<?php
session_start();
include 'conexao.php';

// Corrigindo a validação dos campos (verifica cada campo separadamente)
if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
    $_SESSION['mensagem'] = "Preencha todos os campos!";
    header('Location: telacadastro.php');
    exit();
}

// Sanitização
$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha = trim($_POST['senha']); // ainda sem escapar, porque será usado hash no PHP

// Verifica se já existe um usuário com esse email
$sql = "SELECT count(*) as total FROM users WHERE user_email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['total'] > 0) {
    $_SESSION['mensagem'] = "E-mail já cadastrado!";
    header('Location: telacadastro.php');
    exit();
}

// Hash da senha no PHP (mais seguro que MD5 do SQL)
$senha_hash = md5($senha);

// Inserir o novo usuário
$sqlInserir = "INSERT INTO users(user_name, user_email, user_password) VALUES ('$nome', '$email', '$senha_hash')";

if (mysqli_query($conexao, $sqlInserir)) {
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça Login";
    header('Location: index.php');
    exit();
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
    header('Location: telacadastro.php');
    exit();
}
?>
