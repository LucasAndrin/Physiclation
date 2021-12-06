<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    function constructTable($link, $linkImg, $simulationLinha, $idUser, $pdo){
        echo '<div class="card col shadow-sm mb-3 mx-1">';
            echo '<img src="'.$linkImg.'" class="card-img-top">';
            echo '<div class="card-body text-center fs-6">';
                $idSimulation = $simulationLinha['IdSimulation'];
                echo '<a href="'.$link.'?id='.$idSimulation.'" class="link-success fw-bold card-title">'.$simulationLinha['nome'].'</a>';
                $sql = "SELECT count(*) FROM fav_simulation WHERE idUser = '$idUser' and idSimulation = '$idSimulation'";
                $consulta_fav = $pdo->query($sql);
                $favLinha = $consulta_fav->fetch(PDO::FETCH_BOTH);
                if ($favLinha['count(*)']==0) {
                    echo '<a class="link-success" href="actions/favoritar.php?id='.$simulationLinha['IdSimulation'].'"><i class="far fa-star"></i></a>';
                } else {
                    echo '<a class="link-success" href="actions/desfavoritar.php?id='.$simulationLinha['IdSimulation'].'"><i class="fas fa-star"></i></a>';
                }
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
</head>

<body>
    <?php include('menu-principal.php');?>

    <div class="container">
        <div class="mx-auto col-md-10 p-3 bg-light shadow rounded-bottom">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in
                                to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a short card.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in
                                to additional content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in
                                to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('links-script.html');?>

</html>