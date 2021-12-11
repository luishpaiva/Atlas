<?php
    $usuario = $_SESSION['usuario'];
    $result = $conexao->query( "SELECT
                                    u.id_usuario,
                                    u.usuario,
                                    u.nome,
                                    u.data_nascimento,
                                    u.email, u.senha,
                                    u.id_tipo_usuario,
                                    DATE_FORMAT(u.data_criacao, '%d/%m/%Y às %H:%i:%s.') data_criacao,
                                    t.descricao,
                                    u.imagem
                                FROM
                                    usuario u
                                    INNER JOIN tipo_usuario t
                                    ON u.id_tipo_usuario = t.id_tipo_usuario
                                WHERE
                                    u.usuario = '{$usuario}'");
    $row = mysqli_fetch_array($result);
?>