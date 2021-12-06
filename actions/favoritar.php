<?php
session_start();
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
$pdo = Conexao::getInstance();

$idUser = $_SESSION['idUser'];
$idSimulation = filter_input(INPUT_GET, 'id');
$simulation = filter_input(INPUT_GET, 'simulation');

$stmt = $pdo->prepare('INSERT INTO fav_simulation VALUES(:idSimulation,:idUser)');
$stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
$stmt->bindParam(':idSimulation', $idSimulation, PDO::PARAM_STR);
$stmt->execute();
if (isset($simulation)) {
    header('location:../simulation/MCU.php?id='.$idSimulation);
} else {
    header('location:../index.php');
}
?>