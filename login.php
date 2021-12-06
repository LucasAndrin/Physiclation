<!DOCTYPE html>
<html lang="en">
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
    <title>Login</title>
    <?php include('links-css.html');?>
    <link href="css-adicional/css.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="img/physiclation_icon.ico">
</head>
<body>
    <?php include('menu.html');?>
    <br><br>
    <div class="container">
        <div class="mx-auto col-md-6 shadow rounded-bottom p-4 bg-light">
            <form action="" method="post">
                <fieldset>
                    <legend class="mb-3 green-color text-center fs-1">Logar</legend>
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
                    </div>
                    <div class="d-grid">
                        <button id="submit" class="btn btn-outline-success"><i class="fas fa-sign-in-alt"> Logar</i></button>
                        <input type='text' class="form-text text-center" id="request" value="" disable>
                        <div class="form-text text-center" id="loading"></div>
                    </div>
                    <div class="form-text row bg-light">
                        <div class="col">
                            Não possui uma conta?
                            <a href="cad.php">Cadastrar-se</a>
                        </div>
                        <div class="col">
                            Esqueceu a Senha?
                            <a href="#">Recuperar Senha</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</body>
<?php include('links-script.html');?>
<script src="js-adicional/xhttp.js"></script>
<script src="js-adicional/logar.js"></script>
</html>