<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    $pdo = Conexao::getInstance();
    // informações para display de menu
    $principal = false;
    $alterarSenha = true;
    $relative_link = '../';
    session_start();
    if (!isset($_SESSION['idUser'])) {
        header('location:../login.php');
    } else {
        //id do Usuário
        $idUser = $_SESSION['idUser'];
        $idSimulationGET = isset($_GET['id'])?$_GET['id']:'';
        $aceleration = isset($_GET['aceleration'])?$_GET['aceleration']:1;
        $linearVelocity = isset($_GET['linearVelocity'])?$_GET['linearVelocity']:1;
        $angularVelocity = isset($_GET['angularVelocity'])?$_GET['angularVelocity']:1;
        $frequency = isset($_GET['frequency'])?$_GET['frequency']:1;
        $trajetoria = isset($_GET['trajetoria'])?$_GET['trajetoria']:0;
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCU</title>
    <script type="text/javascript">
        var idSimul = <?php echo $idSimulationGET;?>
    </script>
    <?php include('../links-css.html');?>
    <link href="../css-adicional/css.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="../img/physiclation_icon.ico">
</head>
<body>
    <?php include('../menu-principal.php');?>
    <div class="container">
        <div class="mx-auto col-md-10 bg-light p-5 shadow rounded-bottom">
            <center>
                <canvas class="border border-success rounded" width="801" height="425" id="mcu">
                    Your Browser doesn't support canvas HTML
                </canvas>
            </center>
            <div class="btn-group position-relative top-100 start-50 translate-middle">
                <button class="btn btn-success border border-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Inserir</button>
                <button class="btn btn-success border border-white" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Iniciar/Pausar" id="btnPlay"><i id="play"></i></button>
                <button class="btn btn-success border border-white" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Reiniciar" id="restart"><i class="fas fa-stop"></i></button>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title green-color" id="offcanvasBottomLabel">Inserção de Valores</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body small">
                    <form>
                        <div class="col mb-3">
                            <label for="raio" class="form-label">Raio (metros) [<span id='raioText'></span>]</label>
                            <input type="range" class="form-range" name="raio" id="raio" min="50" max="180">
                            <span class="form-text">Use setas mudando valores com maior precisão</span>
                        </div>
                        <div class="col mb-3">
                            <label for="periodo" class="form-label">Período (segundos) [<span id='periodoText'></span>]</label>
                            <input type="range" class="form-range" name="periodo" id="periodo" min="1" max="30" step = '0.1'>
                            <span class="form-text">Use setas mudando valores com maior precisão</span>
                        </div>
                            <h5 class="offcanvas-title green-color">Grandezas</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="aceleration" <?php if($aceleration==1){echo 'checked';}?>>
                            <label class="form-check-label" for="aceleration">
                                Aceleração Centrípeta
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="linearVelocity" <?php if($linearVelocity==1){echo 'checked';}?>>
                            <label class="form-check-label" for="linearVelocity">
                                Velocidade Linear
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="angularVelocity" <?php if($angularVelocity==1){echo 'checked';}?>>
                            <label class="form-check-label" for="angularVelocity">
                                Velocidade Angular
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="frequency" <?php if($frequency==1){echo 'checked';}?>>
                            <label class="form-check-label" for="frequency">
                                Frequência
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="trajetoria" <?php if($trajetoria==1){echo 'checked';}?>>
                            <label class="form-check-label" for="trajetoria">
                                Exibir Trajetoria de Vetores
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <h1 class="text-center"><?php echo $simulationLinha['nome'];?></h1>
        </div>
    </div>
</body>
<script src="../js-adicional/xhttp.js"></script>
<?php include('../links-script.html');?>
<script src="script-simulation/MCU.js"></script>
</html>