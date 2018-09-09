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

	$idPro64 = $_GET["x"];
	$idPro = base64_decode($idPro64);
	$idUser64 = $_GET["y"];
	$idUser = base64_decode($idUser64);

	require ('conexao.php');

	$sql = "SELECT tipo_id FROM usuario_projeto WHERE projeto_id = '$idPro' LIMIT 1;";
	$result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
    $aux = mysqli_fetch_assoc($result);

	if ($aux['tipo_id'] == 1) {
		$sql2 = "DELETE FROM usuario_projeto WHERE projeto_id = '$idPro'";
		mysqli_query($conexao, $sql2);

		$sql3 = "SELECT id FROM notificacao WHERE projeto_id = '$idPro'";
		$result3 = mysqli_query($conexao, $sql3) or die( mysqli_error($conexao));
		
		while($aux2 = mysqli_fetch_assoc($result3)) {
			$idNot = $aux2['id'];

			$sql4 = "DELETE FROM usuarioPedido WHERE notificacao_id = '$idNot'";
			mysqli_query($conexao, $sql4);
		}

		$sql5 = "DELETE FROM notificacao WHERE projeto_id = '$idPro'";

		if (mysqli_query($conexao, $sql5)) {
			$sql6 = "DELETE FROM projeto WHERE id = '$idPro' LIMIT 1";

			if (mysqli_query($conexao, $sql6)) {
				echo "<script>alert('Projeto apagado com sucesso!'); window.location.href='../meusProjetos.php';</script>";		
				mysqli_close($conexao);
			} else {
				echo "<script>alert('Erro ao tentar apagar o sucesso!'); history.back(0);</script>";		
				mysqli_close($conexao);
			}
		}
	} else {
		echo "<script>alert('Voçê não é o proprietario do projeto!'); history.back(0);</script>";		
		mysqli_close($conexao);
	}
?>