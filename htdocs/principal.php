<?php
    include('validacao.php');
    include('consulta_emprestimos.php');
    include('usuario.php');
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/all.css">
        <link rel="shortcut icon" type="image/ico" href="img/favicon.ico"/>
        <title>Atlas - Principal</title>
    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="principal.php"><img src="img/atlas_white.png" style="width: 50%; display: block; margin-left: auto; margin-right: auto;"></a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap" style="width: 20%;">
                    <a href="#modalusuario" data-bs-toggle="modal" data-bs-target="#modalusuario" class="nav-link px-3" style="text-align: right;">
                        <?php if ($row['imagem'] != null): ?><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imagem']); ?>" width="25" height="25" /><?php endif ?>
                        Olá, <?php echo $row['nome'];?>.
                    </a>
                </div>
            </div>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a href="logout.php" class="nav-link px-3" href="#">Sair</a>
                </div>
            </div>
        </header>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <span class="fas fa-home"></span>
                                Principal
                            </a>
                        </li>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Cadastro</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span><i class="fas fa-plus-circle"></i></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="emprestimos.php" target="display">
                                <span ><i class="fas fa-layer-group"></i></span>
                                Empréstimos
                            </a>
                        </li>
                        <?php
                            $id_tipo_usuario =  $row['id_tipo_usuario'];
                            if ($id_tipo_usuario == 1){
                            echo
                                "<li class='nav-item'>
                                    <a class='nav-link' href='usuarios.php' target='display'>
                                        <span><i class='fas fa-users'></i></span>
                                        Usuários
                                    </a>
                                </li>"
                                ;
                            }
                        ?>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Relatórios</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span class="fas fa-plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="relemprestimos.php" target="display">
                            <span ><i class="fas fa-layer-group"></i></span>
                                Empréstimos
                            </a>
                        </li>
                        <?php
                            $id_tipo_usuario =  $row['id_tipo_usuario'];
                            if ($id_tipo_usuario == 1){
                            echo
                                "<li class='nav-item'>
                                    <a class='nav-link' href='relusuarios.php' target='display'>
                                    <span><i class='fas fa-users'></i></span>
                                        Usuários
                                    </a>
                                </li>"
                                ;
                            }
                        ?>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Sobre nós</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span class="fas fa-plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="sobrenos.html" target="display">
                            <span ><i class="fas fa-info-circle"></i></i></span>
                                Informações
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <nav class="principal">
                <iframe name="display" src="emprestimos.php" height="100%" width="100%"></iframe>
            </nav>
        </main>

        <form action="atmeuusuario.php" method="POST" enctype="multipart/form-data">
            <div id="modalusuario" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Alterar os meus dados</h5>
                            <button type="button" class="modal-header btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if ($row['imagem'] != null): ?>
                                <div class="form-group text-center">
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imagem']); ?>" width="150" height="150" />
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="atualiza_imagem" class="form-text text-muted">Imagem</label>
                                <input type="file" name="atualiza_imagem" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_id" class="form-text text-muted" hidden>ID</label>
                                <input type="text" name="atualiza_id" class="form-control" value="<?php echo $row['id_usuario'];?>" hidden>
                            </div>
                            <div class="form-group">
                                <label for="atualiza_usuario" class="form-text text-muted">Usuário</label>
                                <input type="text" name="atualiza_usuario" class="form-control" value="<?php echo $row['usuario'];?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="atualiza_nome" class="form-text text-muted">Nome</label>
                                <input type="text" name="atualiza_nome" class="form-control" value="<?php echo $row['nome'];?>">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_data_nascimento" class="form-text text-muted">Data de nascimento</label>
                                <input type="date" name="atualiza_data_nascimento" class="form-control" value="<?php echo $row['data_nascimento'];?>">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_email" class="form-text text-muted">E-mail</label>
                                <input type="email" name="atualiza_email" class="form-control" value="<?php echo $row['email'];?>">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_senha1" class="form-text text-muted">Senha</label>
                                <input type="password" name="atualiza_senha1" minlength="6" class="form-control" placeholder="Caso deseje, digite uma nova senha...">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_senha2" class="form-text text-muted">Confirmar senha</label>
                                <input type="password" name="atualiza_senha2" minlength="6" class="form-control" placeholder="Confirme a senha escolhida...">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_tipo_usuario" class="form-text text-muted">Tipo de usuário</label><br />
                                <select name="atualiza_tipo_usuario">
                                    <?php
                                        $id_tipo_usuario =  $row['id_tipo_usuario'];
                                        if ($id_tipo_usuario == 1){
                                            echo "<option value='1' selected='selected'>Administrador</option>";
                                            echo "<option value='2'>Usuário padrão</option>";
                                        } else {
                                            echo "<option value='2' selected='selected'>Usuário padrão</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="atualiza_data_criacao" class="form-text text-muted">Data de criação do usuário</label>
                                <input type="text" name="atualiza_data_criacao" class="form-control" style="text-align: center; width: 200px;" value="<?php echo $row['data_criacao'];?>" disabled>
                            </div>
                        </div>
                        <?php
                            if (isset($_SESSION['atualiza_sucesso'])):
                        ?>
                        <script>alert("Dados atualizados com sucesso!");</script>
                        <?php endif; unset($_SESSION['atualiza_sucesso']); ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="atualizar_dados_usuario" class="btn btn-primary">Salvar alterações</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/dashboard.js"></script>
    </body>
</html>