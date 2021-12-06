<?php
session_start();
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
$pdo = Conexao::getInstance();

$idUser = $_SESSION['idUser'];
$idSimulation = filter_input(INPUT_GET, 'id');
$simulation = filter_input(INPUT_GET, 'simulation');

$stmt = $pdo->prepare("DELETE FROM fav_simulation WHERE idUser = '$idUser' and idSimulation = '$idSimulation'");
$stmt->execute();
if (isset($simulation)) {
    header('location:../simulation/MCU.php?id='.$idSimulation);
} else {
    header('location:../index.php');
}
?>