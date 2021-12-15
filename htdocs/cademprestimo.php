<?php
    session_start();
    include('conexao.php');

    $id_emprestimo = mysqli_real_escape_string($conexao, $_POST['cadastra_id_emprestimo']);
    $id_usuario = mysqli_real_escape_string($conexao, $_POST['cadastra_id_usuario']);
    $nome_item = mysqli_real_escape_string($conexao, $_POST['cadastra_nome_item']);
    $descricao_item = mysqli_real_escape_string($conexao, $_POST['cadastra_descricao_item']);
    $data_emprestimo = mysqli_real_escape_string($conexao, $_POST['cadastra_data_emprestimo']);
    $data_devolucao = mysqli_real_escape_string($conexao, $_POST['cadastra_data_devolucao']);
    $data_devolvido = mysqli_real_escape_string($conexao, $_POST['cadastra_data_devolvido']);
    $nome_destinatario = mysqli_real_escape_string($conexao, $_POST['cadastra_nome_destinatario']);
    $telefone_destinatario = mysqli_real_escape_string($conexao, $_POST['cadastra_telefone_destinatario']);
    $email_destinatario = mysqli_real_escape_string($conexao, $_POST['cadastra_email_destinatario']);
    $situacao = mysqli_real_escape_string($conexao, $_POST['cadastra_situacao']);

    if (empty($data_devolucao)) {
        if (empty($data_devolvido)) {
            $insert =  "INSERT INTO emprestimo (id_usuario, nome_item, descricao_item, data_emprestimo, data_devolucao, data_devolvido, nome_destinatario, telefone_destinatario, email_destinatario, id_situacao)
                        VALUES ({$id_usuario}, '$nome_item', '$descricao_item', '$data_emprestimo', null, null, '$nome_destinatario', '$telefone_destinatario', '$email_destinatario', '$situacao')";
        } else {
            $insert =  "INSERT INTO emprestimo (id_usuario, nome_item, descricao_item, data_emprestimo, data_devolucao, data_devolvido, nome_destinatario, telefone_destinatario, email_destinatario, id_situacao)
                        VALUES ({$id_usuario}, '$nome_item', '$descricao_item', '$data_emprestimo', null, '$data_devolvido', '$nome_destinatario', '$telefone_destinatario', '$email_destinatario', '$situacao')";
        }
    } else {
        if (empty($data_devolvido)) {
            $insert =  "INSERT INTO emprestimo (id_usuario, nome_item, descricao_item, data_emprestimo, data_devolucao, data_devolvido, nome_destinatario, telefone_destinatario, email_destinatario, id_situacao)
                        VALUES ({$id_usuario}, '$nome_item', '$descricao_item', '$data_emprestimo', '$data_devolucao', null, '$nome_destinatario', '$telefone_destinatario', '$email_destinatario', '$situacao')";
        } else {
            $insert =  "INSERT INTO emprestimo (id_usuario, nome_item, descricao_item, data_emprestimo, data_devolucao, data_devolvido, nome_destinatario, telefone_destinatario, email_destinatario, id_situacao)
                        VALUES ({$id_usuario}, '$nome_item', '$descricao_item', '$data_emprestimo', '$data_devolucao', '$data_devolvido', '$nome_destinatario', '$telefone_destinatario', '$email_destinatario', '$situacao')";
        }
    }
    
    if ($conexao->query($insert) === TRUE) {
        $_SESSION['cadastra_sucesso'] = true;
        header('Location: emprestimos.php');
    } else {
        echo "Ocorreu algum erro ao processar os dados! Por gentileza, verifique e tente novamente.";
        echo "<hr>";
        echo $insert;
        echo $update;
        echo $situacao_emp;
    }

    $conexao->close();

    exit;
?>