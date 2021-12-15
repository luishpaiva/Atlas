<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/signin.css" rel="stylesheet" type="text/css">
        <title>Atlas - Cadastro</title>
    </head>
    <body class="text-center">
        <form action="cadextusuario.php" method="POST" class="form-signin">
            <img class="mb-4" src="img/logo.png" alt="Atlas - Projeto de coisas emprestadas">
            <div id="legend">
                <legend class="">Registrar-se</legend>
            </div>
            <div class="form-group">
                <p><input type="text" id="usuario" name="usuario" placeholder="Escolha um nome de usuário" class="form-control" required></p>
            </div>
            <div class="form-group">
                <p><input type="text" id="nome" name="nome" placeholder="Informe o seu nome" class="form-control" required></p>
            </div>
            <div class="form-group">
                <p><input type="password" id="senha1" name="senha1" minlength="6" placeholder="Escolha uma senha" class="form-control" required></p>
            </div>
            <div class="form-group">
                <p><input type="password" id="senha2" name="senha2" minlength="6" placeholder="Confirme a senha escolhida" class="form-control" required></p>
            </div>
            <?php
                if (isset($_SESSION['usuario_existe'])):
            ?>
            <div class="alert alert-primary" role="alert"">
                Nome de usuário já escolhido!<br />Por favor, tente outro.
            </div>
            <?php endif; unset($_SESSION['usuario_existe']); ?>
            <?php
                if (isset($_SESSION['senhas_diferentes'])):
            ?>
            <div class="alert alert-primary" role="alert"">
                Senhas diferentes!<br />Digite duas senhas iguais.
            </div>
            <?php endif; unset($_SESSION['senhas_diferentes']); ?>
            <?php
                if (isset($_SESSION['cadastro_sucesso'])):
            ?>
            <div class="alert alert-success" role="alert"">
                Cadastro realizado com sucesso!<br />Volte para realizar o login.
            </div>
            <?php endif; unset($_SESSION['cadastro_sucesso']); ?>
            <p><button type="submit" class="btn btn-primary">Cadastrar</button></p>
            <p><a href="index.php">Voltar à página inicial</a><br /></p>
            <p class="mt-5 mb-3 text-muted">&reg; 2021-2021<br />Desenvolvido por Luís Henrique Paiva</p>
        </form>
    </body>
</html>