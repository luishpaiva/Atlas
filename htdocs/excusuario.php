<?php
    session_start();
    include('conexao.php');

    $id_usuario = mysqli_real_escape_string($conexao, $_POST['excluir_id_usuario']);

    $delete = "DELETE FROM usuario WHERE id_usuario = {$id_usuario}";

    if ($conexao->query($delete) === TRUE) {
        $_SESSION['excluir_sucesso'] = true;
        header('Location: usuarios.php');
    } else {
        echo "Ocorreu algum erro ao processar os dados! Por gentileza, verifique e tente novamente.";
    }

    $conexao->close();

    exit;
?>