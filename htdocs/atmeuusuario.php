<?php
    session_start();
    include('conexao.php');

    $id_usuario = mysqli_real_escape_string($conexao, $_POST['atualiza_id']);
    $nome = mysqli_real_escape_string($conexao, trim($_POST['atualiza_nome']));
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['atualiza_data_nascimento']);
    $email = mysqli_real_escape_string($conexao, trim($_POST['atualiza_email']));
    $senha1 = mysqli_real_escape_string($conexao, trim($_POST['atualiza_senha1']));
    $senha2 = mysqli_real_escape_string($conexao, trim($_POST['atualiza_senha2']));
    $hashed1 = hash('sha512', $senha1);
    $hashed2 = hash('sha512', $senha2);
    $tipo_usuario = mysqli_real_escape_string($conexao, trim($_POST['atualiza_tipo_usuario']));

    $nome_arquivo = basename($_FILES["atualiza_imagem"]["name"]);
    $tipo_arquivo = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
    $nome_imagem = $_FILES['atualiza_imagem']['tmp_name'];
    if (!empty($nome_imagem)) {
        $ctd_imagem = addslashes(file_get_contents($nome_imagem));
    }

    $query = "SELECT COUNT(*) AS total FROM usuario WHERE id_usuario = {$id_usuario}";
    $result = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($result);

    $sel_senha = "";
    if (!empty($senha1)) {
        $sel_senha = "senha = '$hashed1',";
    }

    $sel_dt_nas = "";
    if (!empty($data_nascimento)) {
        $sel_dt_nas = "data_nascimento = '$data_nascimento',";
    }

    $sel_imagem = "";
    if (!empty($ctd_imagem)) {
        $sel_imagem = ", imagem = '$ctd_imagem'";
    }

    if ($hashed1 != $hashed2) {
        $_SESSION['senhas_diferentes'] = true;
        header('Location: principal.php');
        exit;
    }

    $update =  "UPDATE
                    usuario
                SET
                    nome = '$nome',
                    $sel_dt_nas
                    email = '$email',
                    $sel_senha
                    id_tipo_usuario = {$tipo_usuario}
                    $sel_imagem
                WHERE
                    id_usuario = {$id_usuario}";

    if ($conexao->query($update) === TRUE) {
        $_SESSION['atualiza_sucesso'] = true;
        header('Location: principal.php');
    } else {
        echo "Ocorreu algum erro ao processar os dados! Por gentileza, verifique e tente novamente.";
    }

    echo $update;

    $conexao->close();

    exit;
?>