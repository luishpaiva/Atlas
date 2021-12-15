<?php
    include('validacao.php');
    include('consulta_rel_emprestimos.php');
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
                <form action="" method="GET">
                    <div class="col-md-4">
                        <select name="ordenar" id="" class="form-control" style="position: absolute; width: 226px; top: 47px; right: 120px; border: 1px solid; height: 40px; padding: 2px;">
                            <option value="default" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "default") { echo "selected";} ?>>Selecione para ordenar</option>
                            <option value="nomeaz" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "nomeaz") { echo "selected";} ?>>Nome - A-Z</option>
                            <option value="nomeza" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "nomeza") { echo "selected";} ?>>Nome - Z-A</option>
                            <option value="emprestimor" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "emprestimor") { echo "selected";} ?>>Data empréstimo - Recente</option>
                            <option value="emprestimoa" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "emprestimoa") { echo "selected";} ?>>Data empréstimo - Antigo</option>
                            <option value="devolucaor" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "devolucaor") { echo "selected";} ?>>Data devolução - Recente</option>
                            <option value="devolucaoa" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "devolucaoa") { echo "selected";} ?>>Data devolução - Antigo</option>
                            <option value="devolvidor" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "devolvidor") { echo "selected";} ?>>Data devolvido - Recente</option>
                            <option value="devolvidoa" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "devolvidoa") { echo "selected";} ?>>Data devolvido - Antigo</option>
                            <option value="destinatarioaz" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "destinatarioaz") { echo "selected";} ?>>Nome do destinatário - A-Z</option>
                            <option value="destinatarioza" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "destinatarioza") { echo "selected";} ?>>Nome do destinatário - Z-A</option>
                            <option value="situacao" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "situacao") { echo "selected";} ?>>Situação</option>
                            <option value="pendentes" <?php if(isset($_GET['ordenar']) && $_GET['ordenar'] == "pendentes") { echo "selected";} ?>>Pendentes</option>
                        </select>
                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2" style="position: absolute; top: 48px; right: 20px; width: 100px;">Ordenar</button>
                    </div>
                </form>
            </div>
        </nav>
        <hr>
        <h2>Empréstimos</h2>
        <hr>
        <?php
            echo "<div class='table-responsive'>
                    <table class='table table-sm'>
                        <thead>
                            <tr>
                                <th class='centro' hidden>ID Empréstimo</th>
                                <th class='centro' hidden>ID Usuário</th>
                                <th class='centro'>Nome do item</th>
                                <th class='centro'>Descrição</th>
                                <th class='centro'>Data de empréstimo</th>
                                <th class='centro'>Data de devolução</th>
                                <th class='centro'>Data em que foi devolvido</th>
                                <th class='centro'>Nome do destinatário</th>
                                <th class='centro'>Telefone do destinatário</th>
                                <th class='centro'>E-mail do destinatário</th>
                                <th class='centro'>Situação</th>
                            </tr>
                        </thead>";
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