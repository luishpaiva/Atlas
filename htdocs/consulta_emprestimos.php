<?php
    include('conexao.php');

    $usuario = $_SESSION['usuario'];

    $tipo = $conexao->query("SELECT id_usuario, id_tipo_usuario FROM usuario WHERE usuario = '{$usuario}'");

    $linha = mysqli_fetch_array($tipo);
    
    if ($linha['id_tipo_usuario'] == 1) {
        $result = $conexao->query("SELECT
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
                                    ORDER BY
                                        e.data_emprestimo DESC");
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
                                    ORDER BY
                                        e.data_emprestimo DESC");
    }
?>