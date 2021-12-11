<?php
    include('conexao.php');

    $usuario = $_SESSION['usuario'];

    $ordenar = " ORDER BY ";

    if (isset($_GET['ordenar'])) {
        if ($_GET['ordenar'] == 'usuarioaz') {
            $ordenar .= "u.usuario ASC";
        } else if ($_GET['ordenar'] == 'usuarioza') {
            $ordenar .= "u.usuario DESC";
        } else if ($_GET['ordenar'] == 'nomeaz') {
            $ordenar .= "u.nome ASC";
        } else if ($_GET['ordenar'] == 'nomeza') {
            $ordenar .= "u.nome DESC";
        } else if ($_GET['ordenar'] == 'datanascimentor') {
            $ordenar .= "u.data_nascimento DESC";
        } else if ($_GET['ordenar'] == 'datanascimentoa') {
            $ordenar .= "u.data_nascimento ASC";
        } else if ($_GET['ordenar'] == 'tipousuario') {
            $ordenar .= "u.id_tipo_usuario ASC";
        } else if ($_GET['ordenar'] == 'datacriacaor') {
            $ordenar .= "u.data_criacao DESC";
        } else if ($_GET['ordenar'] == 'datacriacaoa') {
            $ordenar .= "u.data_criacao ASC";
        } else if ($_GET['ordenar'] == 'default') {
            $ordenar .= "u.id_usuario ASC";
        } else {
            $ordenar .= "u.id_usuario DESC";
        }
    } else {
        $ordenar = "";
    }

    $query = $conexao->query("SELECT
                                u.id_usuario,
                                u.usuario,
                                u.nome,
                                DATE_FORMAT(u.data_nascimento, '%d/%m/%Y ') data_nascimento,
                                u.email,
                                u.id_tipo_usuario,
                                DATE_FORMAT(u.data_criacao, '%d/%m/%Y às %H:%i:%s.') data_criacao,
                                t.descricao,
                                u.imagem
                            FROM
                                usuario u
                                INNER JOIN tipo_usuario t
                                on u.id_tipo_usuario = t.id_tipo_usuario
                                $ordenar");
?>