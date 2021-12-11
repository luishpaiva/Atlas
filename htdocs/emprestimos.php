<?php
    include('validacao.php');
    include('consulta_emprestimos.php');
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
        <title>Atlas - Empréstimos</title>
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" data-bs-toggle='modal' data-bs-target='#modalcademprestimo' style="position: absolute; top: 48px; right: 20px;">Cadastrar empréstimos</button>
            </div>
        </nav>
        <hr>
        <h2>Empréstimos</h2>
        <hr>
        <?php
            echo '<div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="centro" hidden>ID Empréstimo</th>
                                <th class="centro" hidden>ID Usuário</th>
                                <th class="centro">Nome do item</th>
                                <th class="centro">Descrição</th>
                                <th class="centro">Data de empréstimo</th>
                                <th class="centro">Data de devolução</th>
                                <th class="centro">Data em que foi devolvido</th>
                                <th class="centro">Nome do destinatário</th>
                                <th class="centro">Telefone do destinatário</th>
                                <th class="centro">E-mail do destinatário</th>
                                <th class="centro">Situação</th>
                                <th class="centro">Editar</th>
                                <th class="centro">Excluir</th>
                            </tr>
                        </thead>';
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['situacao'] == 'Emprestado') {
                        echo "<tr class='table-info'>";
                    } else if ($row['situacao'] == 'Devolvido') {
                        echo "<tr class='table-success'>";
                    } else if ($row['situacao'] == 'Atrasado') {
                        echo "<tr class='table-warning'>";
                    } else {
                        echo "<tr class='table-danger'>";
                    }                    
                        echo "<td class='centro' hidden>" . $row['id_emprestimo'] . "</td>";
                        echo "<td class='centro' hidden>" . $row['id_usuario'] . "</td>";
                        echo "<td class='centro'>" . $row['nome_item'] . "</td>";
                        echo "<td class='centro'>" . $row['descricao_item'] . "</td>";
                        echo "<td class='centro'>" . $row['data_emprestimo'] . "</td>";
                        echo "<td class='centro'>" . $row['data_devolucao'] . "</td>";
                        echo "<td class='centro'>" . $row['data_devolvido'] . "</td>";
                        echo "<td class='centro'>" . $row['nome_destinatario'] . "</td>";
                        echo "<td class='centro'>" . $row['telefone_destinatario'] . "</td>";
                        echo "<td class='centro'>" . $row['email_destinatario'] . "</td>";
                        echo "<td class='centro'>" . $row['situacao'] . "</td>";
                        echo "<td class='centro editbtn'><a href='#' data-bs-toggle='modal' data-bs-target='#modalatemprestimo' style='text-align: right;'><i class='far fa-edit'></i></a></td>";
                        if ($linha['id_tipo_usuario'] == 1) {
                            echo "<td class='centro excbtn'><a href='#' data-bs-toggle='modal' data-bs-target='#modalexcemprestimo' style='text-align: right;'><i class='far fa-trash-alt'></i></a></td>";
                        } else {
                            echo "<td class='centro'><a href='#'><span onclick='permissao()'><i class='far fa-times-circle' style='color: darkred;'></i></a></span></td>";
                        }
                    echo "</tr>";
                }
                echo "</table>";
            echo '</div>';
            mysqli_close($conexao);
        ?>

        <form action="cademprestimo.php" method="POST">
            <div id="modalcademprestimo" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Cadastrar empréstimo</h5>
                            <button type="button" class="modal-header btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="cadastra_id_emprestimo" class="form-text text-muted" hidden>ID Emprestimo</label>
                                <input type="text" name="cadastra_id_emprestimo" id="cadastra_id_emprestimo" class="form-control" hidden>
                            </div>
                            <div class="form-group">
                                <label for="cadastra_id_usuario" class="form-text text-muted" hidden>ID Usuário</label>
                                <input type="text" name="cadastra_id_usuario" id="cadastra_id_usuario" class="form-control" <?php echo "value='". $linha['id_usuario'] . "'";?> hidden required>
                            </div>
                            <div class="form-group">
                                <label for="cadastra_nome_item" class="form-text text-muted">Nome do item emprestado</label>
                                <input type="text" name="cadastra_nome_item" id="cadastra_nome_item" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cadastra_descricao_item" class="form-text text-muted">Descrição do item emprestado</label>
                                <input type="text" name="cadastra_descricao_item" id="cadastra_descricao_item" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_data_emprestimo" class="form-text text-muted">Data empréstimo</label>
                                <input type="date" name="cadastra_data_emprestimo" id="cadastra_data_emprestimo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cadastra_data_devolucao" class="form-text text-muted">Data devolução</label>
                                <input type="date" name="cadastra_data_devolucao" id="cadastra_data_devolucao" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_data_devolvido" class="form-text text-muted">Data em que foi devolvido</label>
                                <input type="date" name="cadastra_data_devolvido" id="cadastra_data_devolvido" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_nome_destinatario" class="form-text text-muted">Nome do destinatário</label>
                                <input type="text" name="cadastra_nome_destinatario" id="cadastra_nome_destinatario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_telefone_destinatario" class="form-text text-muted">Telefone do destinatário</label>
                                <input type="text" name="cadastra_telefone_destinatario" id="cadastra_telefone_destinatario" class="form-control" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" placeholder="(41) 99999-9999">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_email_destinatario" class="form-text text-muted">E-mail do destinatário</label>
                                <input type="email" name="cadastra_email_destinatario" id="cadastra_email_destinatario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cadastra_situacao" class="form-text text-muted">Situação</label><br />
                                <select name="cadastra_situacao" id="cadastra_situacao" required>
                                    <option value="1">Emprestado</option>
                                    <option value="2">Devolvido</option>
                                    <option value="3">Atrasado</option>
                                    <option value="4">Extraviado</option>
                                </select>
                            </div>
                        </div>
                        <?php
                            if (isset($_SESSION['cadastra_sucesso'])):
                        ?>
                        <script>alert("Empréstimo cadastrado com sucesso!");</script>
                        <?php endif; unset($_SESSION['cadastra_sucesso']); ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="atualizar_dados_emprestimo" class="btn btn-primary">Salvar alterações</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="atemprestimo.php" method="POST">
            <div id="modalatemprestimo" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Alterar dados do empréstimo</h5>
                            <button type="button" class="modal-header btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="atualiza_id_emprestimo" class="form-text text-muted" hidden>ID Emprestimo</label>
                                <input type="text" name="atualiza_id_emprestimo" id="atualiza_id_emprestimo" class="form-control" hidden>
                            </div>
                            <div class="form-group">
                                <label for="atualiza_id_usuario" class="form-text text-muted" hidden>ID Usuário</label>
                                <input type="text" name="atualiza_id_usuario" id="atualiza_id_usuario" class="form-control" hidden>
                            </div>
                            <div class="form-group">
                                <label for="atualiza_nome_item" class="form-text text-muted">Nome do item emprestado</label>
                                <input type="text" name="atualiza_nome_item" id="atualiza_nome_item" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_descricao_item" class="form-text text-muted">Descrição do item emprestado</label>
                                <input type="text" name="atualiza_descricao_item" id="atualiza_descricao_item" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_data_emprestimo" class="form-text text-muted">Data empréstimo</label>
                                <input type="date" name="atualiza_data_emprestimo" id="atualiza_data_emprestimo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_data_devolucao" class="form-text text-muted">Data devolução</label>
                                <input type="date" name="atualiza_data_devolucao" id="atualiza_data_devolucao" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_data_devolvido" class="form-text text-muted">Data em que foi devolvido</label>
                                <input type="date" name="atualiza_data_devolvido" id="atualiza_data_devolvido" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_nome_destinatario" class="form-text text-muted">Nome do destinatário</label>
                                <input type="text" name="atualiza_nome_destinatario" id="atualiza_nome_destinatario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_telefone_destinatario" class="form-text text-muted">Telefone do destinatário</label>
                                <input type="text" name="atualiza_telefone_destinatario" id="atualiza_telefone_destinatario" class="form-control" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" placeholder="(41) 99999-9999">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_email_destinatario" class="form-text text-muted">E-mail do destinatário</label>
                                <input type="email" name="atualiza_email_destinatario" id="atualiza_email_destinatario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="atualiza_situacao" class="form-text text-muted">Situação</label><br />
                                <select name="atualiza_situacao" id="atualiza_situacao">
                                    <option value="1">Emprestado</option>
                                    <option value="2">Devolvido</option>
                                    <option value="3">Atrasado</option>
                                    <option value="4">Extraviado</option>
                                </select>
                            </div>
                        </div>
                        <?php
                            if (isset($_SESSION['atualiza_sucesso'])):
                        ?>
                        <script>alert("Dados atualizados com sucesso!");</script>
                        <?php endif; unset($_SESSION['atualiza_sucesso']); ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="atualizar_dados_emprestimo" class="btn btn-primary">Salvar alterações</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        
        <form action="excemprestimo.php" method="POST">
            <div id="modalexcemprestimo" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Excluir o empréstimo do item</h5>
                            <button type="button" class="modal-header btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="form-group">
                            <input type="text" name="excluir_id_emprestimo" id="excluir_id_emprestimo" class="form-control" style="font-weight: bolder; text-align: center;" hidden>
                        </div>
                        <div class="form-group">
                            <input type="text" name="excluir_nome_item" id="excluir_nome_item" class="form-control" style="font-weight: bolder; text-align: center;" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" name="excluir_descricao_item" id="excluir_descricao_item" class="form-control" style="text-align: center;" disabled>
                        </div>
                        <div class="modal-body">Você realmente deseja excluir esse registro?<br /> Esse processo não poderá ser desfeito.</div>
                        <?php
                            if (isset($_SESSION['excluir_sucesso'])):
                        ?>
                        <script>alert("Dados excluídos com sucesso!");</script>
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
                    $('#modalatemprestimo').modal('show');
                        $row = $(this).closest('tr');

                        var data = $row.children("td").map(function() {
                            return $(this).text();
                        }).get();

                        function converteData (Strdata) {
                            auxdata = Strdata.split("/");
                            saida = new String(+auxdata[2]+'-').concat(auxdata[1]+'-').concat(auxdata[0]);
                            return saida;
                        }
                        
                        var data_emprestimo = converteData(data[4]);
                        var data_devolucao = converteData(data[5]);
                        var data_devolvido = converteData(data[6]);
                        
                        $('#atualiza_id_emprestimo').val(data[0]);
                        $('#atualiza_id_usuario').val(data[1]);
                        $('#atualiza_nome_item').val(data[2]);
                        $('#atualiza_descricao_item').val(data[3]);
                        $('#atualiza_data_emprestimo').val(data_emprestimo);
                        $('#atualiza_data_devolucao').val(data_devolucao);
                        $('#atualiza_data_devolvido').val(data_devolvido);
                        $('#atualiza_nome_destinatario').val(data[7]);
                        $('#atualiza_telefone_destinatario').val(data[8]);
                        $('#atualiza_email_destinatario').val(data[9]);

                        var situacao = data[10];

                        if (situacao == 'Emprestado') {
                            document.getElementById('atualiza_situacao').value = 1;
                        } else if (situacao == 'Devolvido') {
                            document.getElementById('atualiza_situacao').value = 2;
                        } else if (situacao == 'Atrasado') {
                            document.getElementById('atualiza_situacao').value = 3;
                        } else {
                            document.getElementById('atualiza_situacao').value = 4;
                        }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.excbtn').on('click', function() {
                    $('#modalexcemprestimo').modal('show');
                        $row = $(this).closest('tr');

                        var data = $row.children("td").map(function() {
                            return $(this).text();
                        }).get();

                        console.log(data);

                        $('#excluir_id_emprestimo').val(data[0]);
                        $('#excluir_nome_item').val(data[2]);
                        $('#excluir_descricao_item').val(data[3]);
                });
            });
        </script>
        <script>
            function permissao() {
                alert("Você não possui permissões necessárias para exluir empréstimos!\r\n=\\");
            }
        </script>
        <script>
            function mask(o, f) {
                setTimeout(function() {
                    var v = mphone(o.value);
                    if (v != o.value) {
                        o.value = v;
                    }
                }, 1);
            }

            function mphone(v) {
                var r = v.replace(/\D/g, "");
                r = r.replace(/^0/, "");
                if (r.length > 10) {
                    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
                } else if (r.length > 5) {
                    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
                } else if (r.length > 2) {
                    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
                } else {
                    r = r.replace(/^(\d*)/, "($1");
                }
                return r;
            }
        </script>
    </body>
</html>