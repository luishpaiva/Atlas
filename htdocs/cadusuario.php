<?php
    session_start();
    include('conexao.php');

    $usuario = mysqli_real_escape_string($conexao, trim($_POST['cadastra_usuario']));
    $nome = mysqli_real_escape_string($conexao, trim($_POST['cadastra_nome']));
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['cadastra_data_nascimento']);
    $email = mysqli_real_escape_string($conexao, trim($_POST['cadastra_email']));
    $senha1 = mysqli_real_escape_string($conexao, trim($_POST['cadastra_senha1']));
    $senha2 = mysqli_real_escape_string($conexao, trim($_POST['cadastra_senha2']));
    $tipo_usuario = mysqli_real_escape_string($conexao, $_POST['cadastra_tipo_usuario']);

    $nomeArquivo = basename($_FILES["cadastra_imagem"]["name"]); 
    $tipoArquivo = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
    $nomeImagem = $_FILES['cadastra_imagem']['tmp_name']; 
    $ctdImagem = addslashes(file_get_contents($nomeImagem));

    $hashed1 = hash('sha512', $senha1);
    $hashed2 = hash('sha512', $senha2);

    $query = "SELECT COUNT(*) AS total FROM usuario WHERE usuario = '{$usuario}'";
    $result = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == 1) {
        $_SESSION['usuario_existe'] = true;
        header('Location: usuario.php');
        exit;
    }

    if ($hashed1 != $hashed2) {
        $_SESSION['senhas_diferentes'] = true;
        header('Location: usuario.php');
        exit;
    }

    if (empty($data_nascimento)) {
        if (empty($ctdImagem)){
            $insert =  "INSERT INTO usuario (usuario, nome, email, senha, id_tipo_usuario, data_criacao)
                        VALUES ('$usuario', '$nome', '$email', '$hashed1', $tipo_usuario, now())";
        } else {
            $insert =  "INSERT INTO usuario (usuario, nome, email, senha, id_tipo_usuario, data_criacao, imagem)
                        VALUES ('$usuario', '$nome', '$email', '$hashed1', $tipo_usuario, now(), '$ctdImagem')";
        }
    } else {
        if (empty($ctdImagem)) {
            $insert =  "INSERT INTO usuario (usuario, nome, data_nascimento, email, senha, id_tipo_usuario, data_criacao)
                        VALUES ('$usuario', '$nome', '$data_nascimento', '$email', '$hashed1', $tipo_usuario, now())";
        } else {
            $insert =  "INSERT INTO usuario (usuario, nome, data_nascimento, email, senha, id_tipo_usuario, data_criacao, imagem)
                        VALUES ('$usuario', '$nome', '$data_nascimento', '$email', '$hashed1', $tipo_usuario, now(), '$ctdImagem')";
        }
    }
    
    if ($conexao->query($insert) === TRUE) {
        $_SESSION['cadastra_sucesso'] = true;
        header('Location: usuarios.php');
    } else {
        echo "Ocorreu algum erro ao processar os dados! Por gentileza, verifique e tente novamente.";
        echo "<hr>";
        echo $insert;
        /*echo $;*/
    }

    $conexao->close();

    exit;
?>