<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    function constructTable($link, $linkImg, $simulationLinha, $idUser, $pdo){
        echo '<div class="col">';
            echo '<div class="card h-100">';
                    echo '<img src="'.$linkImg.'" class="card-img-top">';
                    echo '<div class="card-body">';
                    $idSimulation = $simulationLinha['IdSimulation'];
                    echo '<h5 class="card-title text-center">';
                        echo '<a href="'.$link.'?id='.$idSimulation.'" class="link-success text-decoration-none">'.$simulationLinha['nome'].'</a>';
                        $sql = "SELECT count(*) FROM fav_simulation WHERE idUser = '$idUser' and idSimulation = '$idSimulation'";
                        $consulta_fav = $pdo->query($sql);
                        $favLinha = $consulta_fav->fetch(PDO::FETCH_BOTH);
                        if ($favLinha['count(*)']==0) {
                            echo '<a class="link-success" href="actions/favoritar.php?id='.$simulationLinha['IdSimulation'].'"><i class="far fa-star" data-bs-toggle="tooltip" data-bs-placement="top" title="Favoritar"></i></a>';
                        } else {
                            echo '<a class="link-success" href="actions/desfavoritar.php?id='.$simulationLinha['IdSimulation'].'"><i class="fas fa-star" data-bs-toggle="tooltip" data-bs-placement="top" title="Desfavoritar"></i></a>';
                        }
                    echo '</h5>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $pdo = Conexao::getInstance();
    $relative_link = '';
    $principal = true;
    $alterarSenha = true;
    session_start();
    if (!isset($_SESSION['idUser'])) {
        header('location:login.php');
    } else {
        //id do Usuário
        $idUser = $_SESSION['idUser'];
        // valores dos inputs para pesquisa
        $select = isset($_GET['select'])?$_GET['select']: '';
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <?php include('links-css.html');?>
    <link href="css-adicional/css.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="img/physiclation_icon.ico">
</head>
<body>
    <?php include('menu-principal.php');?>

    <div class="container">
        <div class="mx-auto col-md-10 bg-light p-4 shadow rounded-bottom">
            <div class="row row-cols-1 row-cols-md-4 g-3">
                <?php
                if ($select == "") {
                    $sql = "SELECT * FROM simulation";
                } else {
                    $sql = "SELECT * FROM simulation WHERE IdType = '$select'";
                }
                $consulta_simulation = $pdo->query($sql);
                // $contador = 0;
                while ($simulationLinha = $consulta_simulation->fetch(PDO::FETCH_BOTH)) {
                    $link = "simulation/{$simulationLinha['link']}";
                    $linkImg = "img/{$simulationLinha['linkImagem']}";
                    constructTable($link, $linkImg, $simulationLinha, $idUser, $pdo);
                }
                ?>
            </div>
        </div>
    </div>
</body>
<?php include('links-script.html');?>
</html>