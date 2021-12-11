<?php
    include('conexao.php');

    $usuario = $_SESSION['usuario'];

    $tipo = $conexao->query("SELECT id_usuario, id_tipo_usuario FROM usuario WHERE usuario = '{$usuario}'");
    $linha = mysqli_fetch_array($tipo);
    $ordenar = " ORDER BY ";

    if (isset($_GET['ordenar'])) {
        if ($_GET['ordenar'] == 'nomeaz') {
            $ordenar .= "e.nome_item ASC";
        } else if ($_GET['ordenar'] == 'nomeza') {
            $ordenar .= "e.nome_item DESC";
        } else if ($_GET['ordenar'] == 'emprestimor') {
            $ordenar .= "e.data_emprestimo DESC";
        } else if ($_GET['ordenar'] == 'emprestimoa') {
            $ordenar .= "e.data_emprestimo ASC";
        } else if ($_GET['ordenar'] == 'devolucaor') {
            $ordenar .= "e.data_devolucao DESC";
        } else if ($_GET['ordenar'] == 'devolucaoa') {
            $ordenar .= "e.data_devolucao ASC";
        } else if ($_GET['ordenar'] == 'devolvidor') {
            $ordenar .= "e.data_devolvido DESC";
        } else if ($_GET['ordenar'] == 'devolvidoa') {
            $ordenar .= "e.data_devolvido ASC";
        } else if ($_GET['ordenar'] == 'destinatarioaz') {
            $ordenar .= "e.nome_destinatario ASC";
        } else if ($_GET['ordenar'] == 'destinatarioza') {
            $ordenar .= "e.nome_destinatario DESC";
        } else if ($_GET['ordenar'] == 'situacao') {
            $ordenar .= "situacao ASC";
        } else if ($_GET['ordenar'] == 'pendentes') {
            if ($linha['id_tipo_usuario'] == 1) {
                $ordenar = "WHERE (s.id_situacao = 3 OR s.id_situacao = 4) ORDER BY s.descricao ASC";
            } else {
                $ordenar = "AND (s.descricao = 'Atrasado' OR s.descricao = 'Extraviado') ORDER BY s.descricao ASC";
            }
        } else if ($_GET['ordenar'] == 'default') {
            $ordenar .= "e.id_emprestimo ASC";
        } else {
            $ordenar .= "e.id_emprestimo DESC";
        }
    } else {
        $ordenar = "";
    }

    if ($linha['id_tipo_usuario'] == 1) {
        $result = $conexao->query("SELECT
                                        e.id_emprestimo,
                                        e.id_usuario,
                                        e.nome_item,
                                        e.descricao_item,
                                        DATE_FORMAT(e.data_emprestimo,'%d/%m/%Y') data_emprestimo,
                                        DATE_FORMAT(e.data_devolucao,'%d/%m/%Y') data_devolucao,
                                        DATE_FORMAT(e.data_devolvido,'%d/%m/%Y') data_devolvido,
                                        e.telefone_destinatario,
                                        e.nome_destinatario,
                                        e.email_destinatario,
                                        s.descricao as situacao
                                    FROM emprestimo e
                                        INNER JOIN usuario u
                                        ON e.id_usuario = u.id_usuario
                                        INNER JOIN situacao s
                                        ON e.id_situacao = s.id_situacao
                                        $ordenar");
    } else {
        $result = $conexao->query( "SELECT
                                        e.id_emprestimo,
                                        e.id_usuario,
                                        e.nome_item,
                                        e.descricao_item,
                                        DATE_FORMAT(e.data_emprestimo,'%d/%m/%Y') data_emprestimo,
                                        DATE_FORMAT(e.data_devolucao,'%d/%m/%Y') data_devolucao,
                                        DATE_FORMAT(e.data_devolvido,'%d/%m/%Y') data_devolvido,
                                        e.nome_destinatario,
                                        e.telefone_destinatario,
                                        e.email_destinatario,
                                        s.descricao as situacao
                                    FROM emprestimo e
                                        INNER JOIN usuario u
                                        ON e.id_usuario = u.id_usuario
                                        INNER JOIN situacao s
                                        ON e.id_situacao = s.id_situacao
                                    WHERE
                                        u.usuario = '{$usuario}'
                                        $ordenar");
    }
?>