<?php
	if(!isset($_SESSION)) // Verifica se existe alguma sessão. Senão existir, a função cria uma
    { 
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

    $perfil = $_SESSION['id2'];

	$idNot64 = $_GET["x"];
	$idNot = base64_decode($idNot64);

	require ('conexao.php');


	$sql1 = "DELETE FROM usuarioPedido WHERE notificacao_id = '$idNot'";
	$sql2 = "DELETE FROM notificacao WHERE id = '$idNot'";

	if (mysqli_query($conexao, $sql1) && mysqli_query($conexao, $sql2)) {
		echo "<script>history.back(0);</script>";		
		mysqli_close($conexao);
	}
?>