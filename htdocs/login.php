<?php
	session_start();
	include('conexao.php');
	
	if(empty($_POST['usuario']) || empty($_POST['senha'])) {
		header('Location: index.php');
		exit();
	}

	$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
	$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
	$hashed = hash('sha512', $senha);

	$query = "SELECT nome FROM usuario WHERE usuario = '{$usuario}' AND senha = '{$hashed}'";

	$result = mysqli_query($conexao, $query);
	
	$row = mysqli_num_rows($result);
	
	if($row == 1) {
		$_SESSION['usuario'] = $usuario;
		header('Location: principal.php');
		exit();
	} else {
		$_SESSION['nao_autenticado'] = true;
		header('Location: index.php');
		exit();
	}
?>