<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $principal = false;
    $alterarSenha = false;
    $relative_link = '';
    session_start();
    if (!isset($_SESSION['idUser'])) {
        header('location:login.php');
    }
    $pdo = Conexao::getInstance();
    //id do Usuário
    $idUser = $_SESSION['idUser'];
    // valores dos inputs para pesquisa
    $select = isset($_POST['select'])?$_POST['select']: '';
    // consulta os tipos de simulações
    $sql = "SELECT * FROM simulation";
    $consulta_simulation = $pdo->query($sql);
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <?php include('links-css.html');?>
    <link href="css-adicional/css.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="img/physiclation_icon.ico">
</head>
<body>
    <?php include('menu-principal.php');?>
    <br><br>
    <div class="container">
        <div class="mx-auto col-md-6 shadow rounded-bottom p-4 bg-light">
            <form action="" method="post">
                <fieldset>
                    <legend class="mb-3 green-color text-center fs-1">Alterar Senha</legend>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" aria-describedby="senhaHelp" required>
                            <div class="form-text text-danger" id="senhaHelp"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="novaSenha" class="form-label">Nova Senha</label>
                            <input type="password" name="novaSenha" id="novaSenha" class="form-control" aria-describedby="novaSenhaHelp" required>
                            <div class="form-text text-danger" id="novaSenhaHelp"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="confNovaSenha" class="form-label">Confirmação de Nova Senha</label>
                            <input type="password" name="confNovaSenha" id="confNovaSenha" class="form-control" aria-describedby="confNovaSenhaHelp" required>
                            <div class="form-text text-danger" id="confNovaSenhaHelp"></div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button id="submit" class="btn btn-outline-success">Alterar</button>
                        <input type='text' class="form-text text-center" id="request" value="" disable>
                        <div class="form-text text-center" id="loading"></div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</body>
<?php include('links-script.html');?>
<script src="js-adicional/xhttp.js"></script>
<script src="js-adicional/alterar-senha.js"></script>
</html>