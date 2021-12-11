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
        <title>Atlas - Projeto de coisas emprestadas</title>
    </head>
    <body class="text-center">
        <form action="login.php" method="POST" class="form-signin">
            <img class="mb-4" src="img/logo.png" alt="Atlas">
            <h1 class="h3 mb-3 font-weight-normal"><img src="/img/atlas_black.png" style="width: 50%"><br /><small style="font-size:medium;">Projeto de coisas emprestadas</small></h1>
            <p><input type="text" id="usuario" name="usuario" class="form-control" placeholder="Digite seu usuário" required autofocus></p>
            <p><input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required></p>
            <?php if(isset($_SESSION['nao_autenticado'])): ?>
                <div class="alert alert-danger" role="alert"">
                    Não foi possível conectar!<br />Verifique seu usuário e senha.
                </div>
            <?php endif; unset($_SESSION['nao_autenticado']); ?>
            <p><button type="submit" class="btn btn-primary">Entrar</button></p>
            <p>Não é cadastrado ainda?<br /> <a href="cadastro.php">Clique aqui</a> para criar uma conta.</p>
            <p class="mt-5 mb-3 text-muted">&reg; 2021-2021<br />Desenvolvido por Luís Henrique Paiva</p>
          </form>
    </body>
</html>