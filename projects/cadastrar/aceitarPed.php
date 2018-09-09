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
	$idPro64 = $_GET["y"];
	$idPro = base64_decode($idPro64);
	$tipo = 3;
	
	$idNot64 = $_GET['x'];
	$idNot = base64_decode($idNot64);

	// echo $idNot;

	require ('conexao.php');

	$sql0 = "SELECT usuarioPedido.usuario_id, usuarioPedido.id FROM (notificacao INNER JOIN usuarioPedido ON notificacao.id = usuarioPedido.notificacao_id) WHERE notificacao.id = '$idNot' && notificacao.projeto_id = '$idPro' LIMIT 1";
    $result0 = mysqli_query($conexao, $sql0) or die( mysqli_error($conexao));
    $aux0 = mysqli_fetch_assoc($result0);
    $idUser = $aux0['usuario_id'];
    $idPed = $aux0['id'];
    $idUsuPed = $aux0['usuario_id'];

    // echo $idPed;
    // echo "<br>";
    // echo $idUsuPed;
    // echo "<br>";
    // echo $idPro;

	$sql = "SELECT numero_atual_participantes, numero_max_participantes FROM projeto WHERE id = '$idPro' LIMIT 1";
    $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
    $aux = mysqli_fetch_assoc($result);

    $numPart = $aux['numero_atual_participantes']+1;

    if ($aux['numero_atual_participantes'] < $aux['numero_max_participantes']) {
	    $sql2 = "INSERT INTO usuario_projeto (usuario_id, projeto_id, tipo_id) VALUES ('$idUser', '$idPro', '$tipo')";

		if (mysqli_query($conexao, $sql2)) {
			$sql5 = "UPDATE projeto SET numero_atual_participantes = '$numPart' WHERE id = '$idPro'";
			$sql4 = "DELETE FROM usuarioPedido WHERE id = '$idPed'";
		    $sql3 = "DELETE FROM notificacao WHERE id = '$idNot'";

		    $sql13 = "DELETE FROM notificacao WHERE notificacao.usuario_id = '$idUsuPed' && notificacao.projeto_id = '$idPro'";

			if (mysqli_query($conexao, $sql5) && mysqli_query($conexao, $sql4) && mysqli_query($conexao, $sql3) && mysqli_query($conexao, $sql13)) {
				echo "<script>alert('Pedido confirmado, novo participante adicionado ao projeto!'); history.back(0);</script>";		
				mysqli_close($conexao);
			}
		}
    } else {
    	echo "<script>alert('Sinto muito mas o projeto já está com o máximo de participantes!'); history.back(0);</script>";		
		mysqli_close($conexao);
    }
?>