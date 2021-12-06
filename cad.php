<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php
    session_start();
    if (isset($_SESSION['idUser'])) {
        header('location:index.php');
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <?php
    include('links-css.html'); 
    ?>
    <link href="css-adicional/css.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="img/physiclation_icon.ico">
</head>
<body>
    <?php include('menu.html'); ?>
    <div class="container">
        <br><br>
        <div class="mx-auto col-md-6 shadow rounded-bottom p-4 bg-light">
            <form action="" method="post">
                <fieldset>
                    <legend class="mb-3 green-color text-center fs-1">Cadastrar-se</legend>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control" aria-describedby="nomeHelp" required>
                            <div class="form-text text-danger" id="nomeHelp"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" required>
                            <div class="form-text text-danger" id="emailHelp"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control" aria-describedby="senhaHelp" required>
                            <div class="form-text text-danger" id="senhaHelp"></div>
                        </div>
                        <div class="col">
                            <label for="confSenha" class="form-label">Confirmação de Senha</label>
                            <input type="password" name="senhaConfirm" id="confSenha" class="form-control" aria-describedby="confSenhaHelp" required>
                            <div class="form-text text-danger" id="confSenhaHelp"></div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button id="submit" class="btn btn-outline-success">Cadastrar-se</button>
                        <input type='text' class="form-text text-center" id="request" value="" disable>
                        <div class="form-text text-center" id="loading"></div>
                    </div>
                    <div class="form-text row bg-light">
                        <div class="col">
                            Já possui uma conta?
                            <a href="login.php">Logar-se</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</body>
<?php include('links-script.html'); ?>
<script src="js-adicional/xhttp.js"></script>
<script src="js-adicional/cadastrar.js"></script>
</html>