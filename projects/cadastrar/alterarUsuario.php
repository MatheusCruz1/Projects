<?php
	require ('conexao.php');

	// Verifica se existe alguma sessão. Senão existir, a função cria uma
	if(!isset($_SESSION)) { 
		session_start(); 
	}

	if (!isset($_SESSION['id2'])) {
	    // Destrói a sessão por segurança
	    session_destroy();
	    // Redireciona o visitante de volta pro login
		header("Location: index.php"); exit;
	}

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	} 
?>

<?php

	$nome = addslashes (strip_tags($_POST['nome']));
	$email = strtolower(addslashes (strip_tags($_POST['email'])));
	$sexo = $_POST['sexo'];
	$idUser = $_SESSION['id2'];
	$idUser64 = base64_encode($idUser);

	$sql = "UPDATE usuario SET nome_usuario = '$nome', email = '$email', sexo = '$sexo' WHERE id = '$idUser'";

	if (mysqli_query($conexao, $sql)) {
		echo "<script>alert('Os seus dados foram alterados com sucesso!'); window.location.href='../perfil.php?x=$idUser64';</script>";

        $sql2 = "SELECT nome_usuario FROM usuario WHERE id = '$idUser' LIMIT 1";
        $result2 = mysqli_query($conexao, $sql2) or die( mysqli_error($conexao));
        $aux2 = mysqli_fetch_assoc($result2);

		$_SESSION["nome2"] = $aux2['nome_usuario'];
		
		mysqli_close($conexao);
	} else {
		echo "<script>alert('Erro ao tentar alterar os seus dados!'); history.back(0);</script>";		
		mysqli_close($conexao);
	}
?>