<?php
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('BD', 'login');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, database: BD) or die('Não foi possível conectar ao banco');

?>