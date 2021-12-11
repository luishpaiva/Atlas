<?php
    include('validacao.php');
    include('consulta_rel_usuarios.php');
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
                <form action="" method="GET">
                    <div class="col-md-4">
                        <select name="ordenar" id="" class="form-control" style="position: absolute; width: 245px; top: 47px; right: 120px; border: 1px solid; height: 40px; padding: 2px;">
                        <option value="default" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "default") { echo "selected";} ?>>Selecione para ordenar</option>
                            <option value="usuarioaz" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "usuarioaz") { echo "selected";} ?>>Usuário - A-Z</option>
                            <option value="usuarioza" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "usuarioza") { echo "selected";} ?>>Usuário - Z-A</option>
                            <option value="nomeaz" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "nomeaz") { echo "selected";} ?>>Nome - A-Z</option>
                            <option value="nomeza" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "nomeza") { echo "selected";} ?>>Nome - Z-A</option>
                            <option value="datanascimentor" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "datanascimentor") { echo "selected";} ?>>Data de nascimento - Recente</option>
                            <option value="datanascimentoa" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "datanascimentoa") { echo "selected";} ?>>Data de nascimento - Antigo</option>
                            <option value="tipousuario" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "tipousuario") { echo "selected";} ?>>Tipo de usuário</option>
                            <option value="datacriacaor" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "datacriacaor") { echo "selected";} ?>>Data de criação - Recente</option>
                            <option value="datacriacaoa" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "datacriacaoa") { echo "selected";} ?>>Data de criação - Antigo</option>
                        </select>
                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2" style="position: absolute; top: 48px; right: 20px; width: 100px;">Ordenar</button>
                    </div>
                </form>
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
                    echo "</tr>";
                }
                echo "</table>";
            echo '</div>';
            mysqli_close($conexao);
        ?>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/dashboard.js"></script>
    </body>
</html>