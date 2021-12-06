<?php
session_start();
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
$pdo = Conexao::getInstance();

$idUser = $_SESSION['idUser'];
$idSimulation = filter_input(INPUT_GET, 'id');
$descript = filter_input(INPUT_GET, 'descript');
$sql = "SELECT count(*) FROM simulation WHERE IdSimulation = '$idSimulation'";
$consulta = $pdo->query($sql);
$simul = $consulta->fetch(PDO::FETCH_BOTH);
if ($descript!='' and $simul['count(*)']>0) {
    $stmt = $pdo->prepare('INSERT INTO simulation_error(idUser, idSimulation, descript) VALUES(:idUser,:idSimulation,:descript)');
    $stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
    $stmt->bindParam(':idSimulation', $idSimulation, PDO::PARAM_STR);
    $stmt->bindParam(':descript', $descript, PDO::PARAM_STR);
    $stmt->execute();
    echo '1';
} else {
    echo 'error';
}
?>