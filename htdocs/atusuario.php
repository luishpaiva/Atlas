<?php
    session_start();
    include('conexao.php');

    $id_usuario = mysqli_real_escape_string($conexao, $_POST['atualiza_id_usuario']);
    $nome = mysqli_real_escape_string($conexao, trim($_POST['atualiza_nome']));
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['atualiza_data_nascimento']);
    $email = mysqli_real_escape_string($conexao, trim($_POST['atualiza_email']));
    $senha1 = mysqli_real_escape_string($conexao, trim($_POST['atualiza_senha1']));
    $senha2 = mysqli_real_escape_string($conexao, trim($_POST['atualiza_senha2']));
    $hashed1 = hash('sha512', $senha1);
    $hashed2 = hash('sha512', $senha2);
    $tipo_usuario = mysqli_real_escape_string($conexao, $_POST['atualiza_tipo_usuario']);

    $nomeArquivo = basename($_FILES["atualiza_imagem"]["name"]);
    $tipoArquivo = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
    $nomeImagem = $_FILES['atualiza_imagem']['tmp_name'];
    if (!empty($nomeArquivo)) {
        $ctdImagem = addslashes(file_get_contents($nomeImagem));
    }
    
    $query = "SELECT COUNT(*) AS total FROM usuario WHERE id_usuario = {$id_usuario}";
    $result = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($result);

    if ($hashed1 != $hashed2) {
        $_SESSION['senhas_diferentes'] = true;
        header('Location: ususarios.php');
        exit;
    }

    if (empty($senha1)) {
        if (empty($data_nascimento)) {
            if (empty($ctdImagem)) {
                $update =  "UPDATE
                                usuario
                            SET
                                nome = '$nome',
                                email = '$email',
                                id_tipo_usuario = {$tipo_usuario}
                            WHERE
                                id_usuario = {$id_usuario}";
            } else {
                $update =  "UPDATE
                                usuario
                            SET
                                nome = '$nome',
                                email = '$email',
                                id_tipo_usuario = {$tipo_usuario},
                                imagem = '$ctdImagem'
                            WHERE
                                id_usuario = {$id_usuario}";
            }
                
        } else {
            if (empty($ctdImagem)) {
                $update =  "UPDATE
                            usuario
                        SET nome = '$nome',
                            data_nascimento = '$data_nascimento',
                            email = '$email',
                            id_tipo_usuario = {$tipo_usuario}
                        WHERE
                            id_usuario = {$id_usuario}";
            } else {
                $update =  "UPDATE
                            usuario
                        SET nome = '$nome',
                            data_nascimento = '$data_nascimento',
                            email = '$email',
                            id_tipo_usuario = {$tipo_usuario},
                            imagem = '$ctdImagem'
                        WHERE
                            id_usuario = {$id_usuario}";
            }
        }
    } else {
        if (empty($data_nascimento)) {
            if (empty($ctdImagem)) {
                $update =  "UPDATE
                            usuario
                        SET
                            nome = '$nome',
                            email = '$email',
                            senha = '$hashed1',
                            id_tipo_usuario = {$tipo_usuario}
                        WHERE
                            id_usuario = {$id_usuario}";
            } else {
                $update =  "UPDATE
                            usuario
                        SET
                            nome = '$nome',
                            email = '$email',
                            senha = '$hashed1',
                            id_tipo_usuario = {$tipo_usuario},
                            imagem = '$ctdImagem'
                        WHERE
                            id_usuario = {$id_usuario}";
            }
        } else {
            if (empty($ctdImagem)) {
                $update =  "UPDATE
                            usuario
                        SET
                            nome = '$nome',
                            data_nascimento = '$data_nascimento',
                            email = '$email',
                            senha = '$hashed1',
                            id_tipo_usuario = {$tipo_usuario}
                        WHERE
                            id_usuario = {$id_usuario}";
            } else {
                $update =  "UPDATE
                            usuario
                        SET
                            nome = '$nome',
                            data_nascimento = '$data_nascimento',
                            email = '$email',
                            senha = '$hashed1',
                            id_tipo_usuario = {$tipo_usuario},
                            imagem = '$ctdImagem'
                        WHERE
                            id_usuario = {$id_usuario}";
            }
        }
    }

    if ($conexao->query($update) === TRUE) {
        $_SESSION['atualiza_sucesso'] = true;
        header('Location: usuarios.php');
    } else {
        echo "Ocorreu algum erro ao processar os dados! Por gentileza, verifique e tente novamente.";
    }

    $conexao->close();

    exit;
?>