<?php
    session_start();
    include('conexao.php');

    $id_emprestimo = mysqli_real_escape_string($conexao, $_POST['excluir_id_emprestimo']);

    $delete = "DELETE FROM emprestimo WHERE id_emprestimo = {$id_emprestimo}";

    if ($conexao->query($delete) === TRUE) {
        $_SESSION['excluir_sucesso'] = true;
        header('Location: emprestimos.php');
    } else {
        echo "Ocorreu algum erro ao processar os dados! Por gentileza, verifique e tente novamente.";
    }

    $conexao->close();

    exit;
?>