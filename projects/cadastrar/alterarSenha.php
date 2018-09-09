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

	$senhaAntiga = addslashes (strip_tags($_POST['senhaAntiga']));
	$cripSenhaAntiga = md5($senhaAntiga);
	$senhaNova = addslashes (strip_tags($_POST['senhaNova']));
	$cripSenhaNova = md5($senhaNova);
	$idUser = $_SESSION['id2'];
    $idUser64 = base64_encode($idUser);

    $sql = "SELECT senha FROM usuario WHERE id = '$idUser' LIMIT 1";
    $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
	$aux = mysqli_fetch_assoc($result);

    if ($cripSenhaAntiga != $aux['senha']) {
    	echo "<script>alert('A sua antiga senha está incorreta, por favor tente novamente!'); history.back(0);</script>";		
		mysqli_close($conexao);
    } elseif ($senhaAntiga == $senhaNova) {
    	echo "<script>alert('A sua nova senha não pode ser igual a sua senha antiga, por favor tente novamente!'); history.back(0);</script>";		
		mysqli_close($conexao);
    } else {
		$sql = "UPDATE usuario SET senha = '$cripSenhaNova' WHERE id = '$idUser'";

		if (mysqli_query($conexao, $sql)) {
			echo "<script>alert('A sua senha foi alterada com sucesso!'); window.location.href='../perfil.php?x=$idUser64';</script>";
			mysqli_close($conexao);
		} else {
			echo "<script>alert('Erro ao tentar alterar a sua senha!'); history.back(0);</script>";		
			mysqli_close($conexao);
		}
    } 
?>