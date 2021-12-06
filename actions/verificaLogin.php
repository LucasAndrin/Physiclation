<?php
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
// verifica se o usuário já foi cadastrado
$email = filter_input(INPUT_GET, 'email');
$senha = md5(filter_input(INPUT_GET, 'senha'));
$sql = "SELECT count(*) FROM user WHERE email = '$email'";
$pdo = Conexao::getInstance();
$consulta = $pdo->query($sql);
$linha = $consulta->fetch(PDO::FETCH_BOTH);
if ($linha['count(*)']==0) {
    echo 'Seu e-mail não esta cadastrado!';
} else {
    $sql = "SELECT idUser FROM user WHERE email = '$email' AND senha = '$senha'";
    $consulta = $pdo->query($sql);
    $linha = $consulta->fetch(PDO::FETCH_BOTH);
    // verificação contra invasões de webservice
    if (isset($linha['idUser'])) {
        session_start();
        $_SESSION['idUser'] = $linha['idUser'];
        echo '1';
    } else {
        echo 'senha';
    }
}
// var_dump($sql);


// $email = filter_input(INPUT_GET, 'email');
// // verifica se já foi cadastrado email
// $sql = "SELECT count(*) FROM user WHERE email = '$email'";
// $pdo = Conexao::getInstance();
// $consulta = $pdo->query($sql);
// $linha = $consulta->fetch(PDO::FETCH_BOTH);
// if ($linha['count(*)']>0) {
//     echo 'a';
// } else {
//     echo 0;
// }
?>