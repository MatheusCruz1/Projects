<?php
	require ('conexao.php');

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
	?>

	<?php

	$nome = addslashes (strip_tags($_POST['nome']));
	$descricao = addslashes (strip_tags($_POST['descricao']));
	$max = $_POST['max'];
	$idPro = $_POST['id'];
	$idPro64 = base64_encode($idPro);

	$sql = "UPDATE projeto SET nome_projeto = '$nome', descricao = '$descricao', numero_max_participantes = '$max' WHERE id = '$idPro'";

	if (mysqli_query($conexao, $sql)) {
		echo "<script>alert('Os dados do projeto foram alterados com sucesso!'); window.location.href='../verProjeto.php?x=$idPro64'</script>";		
		mysqli_close($conexao);
	} else {
		echo "<script>alert('Erro ao tentar alterar os dados do projeto!'); history.back(0);</script>";		
		mysqli_close($conexao);
	}
?>