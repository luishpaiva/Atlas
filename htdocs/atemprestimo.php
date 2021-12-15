<?php
    session_start();
    include('conexao.php');

    $id_emprestimo = mysqli_real_escape_string($conexao, $_POST['atualiza_id_emprestimo']);
    $id_usuario = mysqli_real_escape_string($conexao, $_POST['atualiza_id_usuario']);
    $nome_item = mysqli_real_escape_string($conexao, $_POST['atualiza_nome_item']);
    $descricao_item = mysqli_real_escape_string($conexao, $_POST['atualiza_descricao_item']);
    $data_emprestimo = mysqli_real_escape_string($conexao, $_POST['atualiza_data_emprestimo']);
    $data_devolucao = mysqli_real_escape_string($conexao, $_POST['atualiza_data_devolucao']);
    $data_devolvido = mysqli_real_escape_string($conexao, $_POST['atualiza_data_devolvido']);
    $nome_destinatario = mysqli_real_escape_string($conexao, $_POST['atualiza_nome_destinatario']);
    $telefone_destinatario = mysqli_real_escape_string($conexao, $_POST['atualiza_telefone_destinatario']);
    $email_destinatario = mysqli_real_escape_string($conexao, $_POST['atualiza_email_destinatario']);
    $situacao = mysqli_real_escape_string($conexao, $_POST['atualiza_situacao']);

    if (empty($data_devolucao)) {
        if (empty($data_devolvido)) {
            $update =  "UPDATE
                            emprestimo
                        SET
                            nome_item = '$nome_item',
                            descricao_item = '$descricao_item',
                            data_emprestimo = '$data_emprestimo',
                            data_devolucao = null,
                            data_devolvido = null,
                            nome_destinatario = '$nome_destinatario',
                            telefone_destinatario = '$telefone_destinatario',
                            email_destinatario = '$email_destinatario',
                            id_situacao = {$situacao}
                        WHERE
                            id_emprestimo = {$id_emprestimo}";
        } else {
            $update =  "UPDATE
                            emprestimo
                        SET
                            nome_item = '$nome_item',
                            descricao_item = '$descricao_item',
                            data_emprestimo = '$data_emprestimo',
                            data_devolucao = null,
                            data_devolvido = '$data_devolvido',
                            nome_destinatario = '$nome_destinatario',
                            telefone_destinatario = '$telefone_destinatario',
                            email_destinatario = '$email_destinatario',
                            id_situacao = {$situacao}
                        WHERE
                            id_emprestimo = {$id_emprestimo}";
        }
    } else {
        if (empty($data_devolvido)) {
            $update =  "UPDATE
                            emprestimo
                        SET
                            nome_item = '$nome_item',
                            descricao_item = '$descricao_item',
                            data_emprestimo = '$data_emprestimo',
                            data_devolucao = '$data_devolucao',
                            data_devolvido = null,
                            nome_destinatario = '$nome_destinatario',
                            telefone_destinatario = '$telefone_destinatario',
                            email_destinatario = '$email_destinatario',
                            id_situacao = {$situacao}
                        WHERE
                            id_emprestimo = {$id_emprestimo}";
        } else {
            $update =  "UPDATE
                            emprestimo
                        SET
                            nome_item = '$nome_item',
                            descricao_item = '$descricao_item',
                            data_emprestimo = '$data_emprestimo',
                            data_devolucao = '$data_devolucao',
                            data_devolvido = '$data_devolvido',
                            nome_destinatario = '$nome_destinatario',
                            telefone_destinatario = '$telefone_destinatario',
                            email_destinatario = '$email_destinatario',
                            id_situacao = {$situacao}
                        WHERE
                            id_emprestimo = {$id_emprestimo}";
        }
    }

    if ($conexao->query($update) === TRUE) {
        $_SESSION['atualiza_sucesso'] = true;
        header('Location: emprestimos.php');
    } else {
        echo "Ocorreu algum erro ao processar os dados! Por gentileza, verifique e tente novamente.";
        echo "<hr>";
        echo $update;
        echo $situacao;
    }

    $conexao->close();

    exit;
?>