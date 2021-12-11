<?php
    define('HOST', '127.0.0.1');
    define('USUARIO', 'root');
    define('SENHA', 'RxDq.W8L43rd');
    define('DB', 'atlas');
 
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível realizar a conexão. Verifique seus dados e tente novamente.'); ?>