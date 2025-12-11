<?php
include 'conexao.php';

$id = $_GET['id'];
//consulta 6
$sql = "DELETE FROM form WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: dados_alunos.php");
exit;
