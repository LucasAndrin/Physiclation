<?php
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
$email = filter_input(INPUT_GET, 'email');
// verifica se já foi cadastrado email
$sql = "SELECT count(*) FROM user WHERE email = '$email'";
$pdo = Conexao::getInstance();
$consulta = $pdo->query($sql);
$linha = $consulta->fetch(PDO::FETCH_BOTH);
if ($linha['count(*)']>0) {
    echo 'a';
} else {
    echo 0;
}
?>