<?php
    include('conexao.php');

    $usuario = $_SESSION['usuario'];

    $query = $conexao->query("SELECT
                            u.id_usuario,
                            u.usuario,
                            u.nome,
                            DATE_FORMAT(data_nascimento, '%d/%m/%Y') data_nascimento,
                            u.email,
                            u.id_tipo_usuario,
                            DATE_FORMAT(data_criacao, '%d/%m/%Y às %H:%i:%s.') data_criacao,
                            t.descricao,
                            u.imagem
                        FROM
                            usuario u
                            INNER JOIN tipo_usuario t
                            ON u.id_tipo_usuario = t.id_tipo_usuario
                        WHERE
                            usuario <> '$usuario'
                        ORDER BY
                            data_criacao DESC");
?>