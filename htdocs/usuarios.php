<?php
    include('validacao.php');
    include('consulta_usuarios.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/all.css">
        <title>Atlas - Usuários</title>
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" data-bs-toggle='modal' data-bs-target='#modalcadusuario' style="position: absolute; top: 48px; right: 20px;">Cadastrar usuário</button>
            </div>
        </nav>
        <hr>
        <h2>Usuários</h2>
        <hr>
        <?php
            echo '<div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="centro" hidden>ID Usuário</th>
                                <th class="centro">Usuário</th>
                                <th class="centro">Nome</th>
                                <th class="centro">Data de nascimento</th>
                                <th class="centro">E-mail</th>
                                <th class="centro">Tipo de usuário</th>
                                <th class="centro">Data de criação</th>
                                <th class="centro">Editar</th>
                                <th class="centro">Excluir</th>
                            </tr>
                        </thead>';
                while ($row = mysqli_fetch_array($query)) {
                    if ($row['id_tipo_usuario'] == 1) {
                        echo "<tr class='table-info'>";
                    } else {
                        echo "<tr class='table-success'>";
                    }
                        echo "<td class='centro' hidden>" . $row['id_usuario'] . "</td>";
                        echo "<td class='centro'>" . $row['usuario'] . "</td>";
                        echo "<td class='centro'>" . $row['nome'] . "</td>";
                        echo "<td class='centro'>" . $row['data_nascimento'] . "</td>";
                        echo "<td class='centro'>" . $row['email'] . "</td>";
                        echo "<td class='centro'>" . $row['descricao'] . "</td>";
                        echo "<td class='centro'>" . $row['data_criacao'] . "</td>";
                        echo "<td class='centro editbtn'><a href='#' data-bs-toggle='modal' data-bs-target='#modalatusuario' style='text-align: right;'><i class='far fa-edit'></i></a></td>";
                        echo "<td class='centro excbtn'><a href='#' data-bs-toggle='modal' data-bs-target='#modalexcusuario' style='text-align: right;'><i class='far fa-trash-alt'></i></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo '</div>';
            mysqli_close($conexao);
        ?>

        <form action="cadusuario.php" method="POST" enctype="multipart/form-data">
            <div id="modalcadusuario" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Cadastrar usuário</h5>
                            <button type="button" class="modal-header btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cadastra_imagem" class="form-text text-muted">Imagem</label>
                                <input type="file" name="cadastra_imagem" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_id" class="form-text text-muted" hidden>ID Usuário</label>
                                <input type="text" name="cadastra_id" class="form-control" hidden>
                            </div>
                            <div class="form-group">
                                <label for="cadastra_usuario" class="form-text text-muted">Usuário</label>
                                <input type="text" name="cadastra_usuario" class="form-control" placeholder="Escolha um nome de usuário." required>
                            </div>
                            <div class="form-group">
                                <label for="cadastra_nome" class="form-text text-muted">Nome</label>
                                <input type="text" name="cadastra_nome" class="form-control" placeholder="Digite o nome completo do usuário.">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_data_nascimento" class="form-text text-muted">Data de nascimento</label>
                                <input type="date" name="cadastra_data_nascimento" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_email" class="form-text text-muted">E-mail</label>
                                <input type="email" name="cadastra_email" class="form-control" placeholder="Informe o e-mail do usuário.">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_senha1" class="form-text text-muted">Senha</label>
                                <input type="password" name="cadastra_senha1" minlength="6" class="form-control" placeholder="Digite uma senha para o novo usuário." required>
                            </div>
                            <div class="form-group">
                                <label for="cadastra_senha2" class="form-text text-muted">Confirmar senha</label>
                                <input type="password" name="cadastra_senha2" minlength="6" class="form-control" placeholder="Confirme a senha escolhida." required>
                            </div>
                            <div class="form-group">
                                <label for="cadastra_tipo_usuario" class="form-text text-muted">Tipo de usuário</label><br />
                                <select name="cadastra_tipo_usuario">
                                    <option value='1'>Administrador</option>
                                    <option value='2' selected='selected'>Usuário padrão</option>
                                </select>
                            </div>
                        </div>
                        <?php
                            if (isset($_SESSION['cadastra_sucesso'])):
                        ?>
                        <script>alert("Usuário cadastrado com sucesso!");</script>
                        <?php endif; unset($_SESSION['cadastra_sucesso']); ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="atualizar_dados_usuario" class="btn btn-primary">Salvar alterações</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="atusuario.php" method="POST" enctype="multipart/form-data">
            <div id="modalatusuario" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Alterar dados do usuário</h5>
                            <button type="button" class="modal-header btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="atualiza_imagem" class="form-text text-muted">Imagem</label>
                                <input type="file" name="atualiza_imagem" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_id_usuario" class="form-text text-muted" hidden>ID</label>
                                <input type="text" name="atualiza_id_usuario" id="atualiza_id_usuario" class="form-control" hidden>
                            </div>
                            <div class="form-group">
                                <label for="atualiza_usuario" class="form-text text-muted">Usuário</label>
                                <input type="text" name="atualiza_usuario" id="atualiza_usuario" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="atualiza_nome" class="form-text text-muted">Nome</label>
                                <input type="text" name="atualiza_nome" id="atualiza_nome" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_data_nascimento" class="form-text text-muted">Data de nascimento</label>
                                <input type="date" name="atualiza_data_nascimento" id="atualiza_data_nascimento" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_email" class="form-text text-muted">E-mail</label>
                                <input type="email" name="atualiza_email" id="atualiza_email" class="form-control">
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
                                <select name="atualiza_tipo_usuario" id="atualiza_tipo_usuario">
                                    <option value='1' selected='selected'>Administrador</option>
                                    <option value='2'>Usuário padrão</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="atualiza_data_criacao" class="form-text text-muted">Data de criação do usuário</label>
                                <input type="text" name="atualiza_data_criacao" id="atualiza_data_criacao" class="form-control" style="text-align: center; width: 200px;" disabled>
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

        
        <form action="excusuario.php" method="POST">
            <div id="modalexcusuario" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Excluir o usuário</h5>
                            <button type="button" class="modal-header btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="form-group">
                            <input type="text" name="excluir_id_usuario" id="excluir_id_usuario" class="form-control" style="font-weight: bolder; text-align: center;" hidden>
                        </div>
                        <div class="form-group">
                            <input type="text" name="excluir_usuario" id="excluir_usuario" class="form-control" style="font-weight: bolder; text-align: center;" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" name="excluir_nome_usuario" id="excluir_nome_usuario" class="form-control" style="font-weight: bolder; text-align: center;" disabled>
                        </div>
                        <div class="modal-body">Você realmente deseja excluir esse registro?<br /> Esse processo não poderá ser desfeito.</div>
                        <?php
                            if (isset($_SESSION['excluir_sucesso'])):
                        ?>
                        <script>alert("Usuário excluído com sucesso!");</script>
                        <?php endif; unset($_SESSION['excluir_sucesso']); ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="excluir_dados_emprestimo" class="btn btn-danger">Sim, excluir</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/dashboard.js"></script>
        <script>
            $(document).ready(function() {
                $('.editbtn').on('click', function() {
                    $('#modalatusuario').modal('show');
                        $row = $(this).closest('tr');

                        var data = $row.children("td").map(function() {
                            return $(this).text();
                        }).get();

                        function converteData (Strdata) {
                            auxdata = Strdata.split("/");
                            saida = new String(+auxdata[2]+'-').concat(auxdata[1]+'-').concat(auxdata[0]);
                            return saida;
                        }
                        
                        var data_nascimento = converteData(data[3]);
                        
                        $('#atualiza_id_usuario').val(data[0]);
                        $('#atualiza_usuario').val(data[1]);
                        $('#atualiza_nome').val(data[2]);
                        $('#atualiza_data_nascimento').val(data_nascimento);
                        $('#atualiza_email').val(data[4]);
                        $('#atualiza_data_criacao').val(data[6]);

                        console.log(data);

                        var tipo_usuario = data[5];

                        if (tipo_usuario == 'Administrador') {
                            document.getElementById('atualiza_tipo_usuario').value = 1;
                        } else {
                            document.getElementById('atualiza_tipo_usuario').value = 2;
                        }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.excbtn').on('click', function() {
                    $('#modalexcusuario').modal('show');
                        $row = $(this).closest('tr');

                        var data = $row.children("td").map(function() {
                            return $(this).text();
                        }).get();

                        console.log(data);

                        $('#excluir_id_usuario').val(data[0]);
                        $('#excluir_usuario').val(data[1]);
                        $('#excluir_nome_usuario').val(data[2]);
                });
            });
        </script>
    </body>
</html>