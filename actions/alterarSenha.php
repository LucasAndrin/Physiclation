<?php
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
// verificações
session_start();
$id = $_SESSION['idUser'];
$senha = md5(filter_input(INPUT_GET, 'senha'));
$novaSenha = filter_input(INPUT_GET, 'novaSenha');
$confNovaSenha = filter_input(INPUT_GET, 'confNovaSenha');
$sql = "SELECT senha FROM user WHERE idUser = '$id'";

$pdo = Conexao::getInstance();
$consulta = $pdo->query($sql);
$linha = $consulta->fetch(PDO::FETCH_BOTH);
if ($linha['senha']!=$senha) {
    echo 'senha';
} else if ($novaSenha != $confNovaSenha) {
    echo 'confSenha';
} else if (md5($novaSenha)==$linha['senha']) {
   echo 'senhaNovaSenha';
} 
else {
    $novaSenha = md5($novaSenha);
    $consulta = $pdo->prepare('UPDATE user SET senha = :senha WHERE idUser = :id');
    $consulta->bindParam(':senha', $novaSenha, PDO::PARAM_STR);
    $consulta->bindParam(':id', $id, PDO::PARAM_STR);
    $consulta->execute();
    echo '1';
}
?>