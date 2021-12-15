<?php
    session_start();
    include('conexao.php');

    $usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $senha1 = mysqli_real_escape_string($conexao, trim($_POST['senha1']));
    $senha2 = mysqli_real_escape_string($conexao, trim($_POST['senha2']));

    $hashed1 = hash('sha512', $senha1);
    $hashed2 = hash('sha512', $senha2);

    $query = "SELECT COUNT(*) AS total FROM usuario WHERE usuario = '{$usuario}'";
    $result = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == 1) {
        $_SESSION['usuario_existe'] = true;
        header('Location: cadastro.php');
        exit;
    }

    if ($hashed1 != $hashed2) {
        $_SESSION['senhas_diferentes'] = true;
        header('Location: cadastro.php');
        exit;
    }

    $insert = "INSERT INTO usuario (usuario, nome, senha, id_tipo_usuario, data_criacao)
               VALUES ('$usuario', '$nome', '$hashed1', 2, now())";

    if ($conexao->query($insert) === TRUE) {
        $_SESSION['cadastro_sucesso'] = true;
    }

    $conexao->close();

    header('Location: cadastro.php');
    exit;
?>