<?php
session_start();
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
$email = filter_input(INPUT_GET, 'email');
$nome = filter_input(INPUT_GET, 'nome');
$senha = md5(filter_input(INPUT_GET, 'senha'));

$sql = "SELECT count(*) FROM user WHERE email = '$email'";
$pdo = Conexao::getInstance();
$consulta = $pdo->query($sql);
$linha = $consulta->fetch(PDO::FETCH_BOTH);
if ($linha['count(*)']>0) {
    echo 'error';
} else {
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO user(nome, email, senha) VALUES(:nome,:email,:senha)');
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt->execute();
    echo "1";

    $sql = "SELECT idUser FROM user WHERE email = '$email'";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    $linha = $consulta->fetch(PDO::FETCH_BOTH);
    $_SESSION['idUser'] = $linha['idUser'];
}

?>