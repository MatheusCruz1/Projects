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

    $idUser64 = $_GET['x'];
    $idUser = base64_decode($idUser64);

    require ('conexao.php');

	$sql = "SELECT projeto_id FROM usuario_projeto WHERE usuario_id = '$idUser' && tipo_id = 1;";
	$result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
    
    while($aux = mysqli_fetch_assoc($result)) {
    	$idPro = $aux['projeto_id'];

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
			mysqli_query($conexao, $sql6);
		}
    }
    
    $sql11 = "SELECT usuario_projeto.projeto_id, projeto.numero_atual_participantes FROM (usuario_projeto INNER JOIN projeto ON usuario_projeto.projeto_id = projeto.id) WHERE usuario_projeto.usuario_id = '$idUser' && usuario_projeto.tipo_id = 3";
	$result11 = mysqli_query($conexao, $sql11) or die( mysqli_error($conexao));
	
	while($aux3 = mysqli_fetch_assoc($result11)) {
		$idPro2 = $aux3['projeto_id'];
		$numPart = $aux3['numero_atual_participantes']-1;

		$sql12 = "UPDATE projeto SET numero_atual_participantes = '$numPart' WHERE id =  '$idPro2' LIMIT 1";
    	mysqli_query($conexao, $sql12);

	    $sql7 = "DELETE FROM usuario_projeto WHERE usuario_id = '$idUser' && projeto_id = '$idPro2'";
	    mysqli_query($conexao, $sql7);
    }

    $sql13 = "SELECT notificacao_id FROM (notificacao INNER JOIN usuarioPedido ON notificacao.id = usuarioPedido.notificacao_id) WHERE usuarioPedido.usuario_id = '$idUser'";
	$result13 = mysqli_query($conexao, $sql13) or die( mysqli_error($conexao));
		
	while($aux4 = mysqli_fetch_assoc($result13)) {
		$idNot2 = $aux4['notificacao_id'];

		$sql14 = "DELETE FROM usuarioPedido WHERE notificacao_id = '$idNot2'";
		mysqli_query($conexao, $sql14);
		
		$sql15 = "DELETE FROM notificacao WHERE id = '$idNot2'";
		mysqli_query($conexao, $sql15);
	}

	$sql16 = "SELECT notificacao_id, usuarioPedido.id FROM (notificacao INNER JOIN usuarioPedido ON notificacao.id = usuarioPedido.notificacao_id) WHERE notificacao.usuario_id != '$idUser' && usuarioPedido.usuario_id = '$idUser'";
	$result16 = mysqli_query($conexao, $sql16) or die( mysqli_error($conexao));
		
	while($aux5 = mysqli_fetch_assoc($result16)) {
		$idNot3 = $aux5['notificacao_id'];
		$idPed = $aux5['id'];

		$sql17 = "DELETE FROM usuarioPedido WHERE id = '$idPed'";
		mysqli_query($conexao, $sql17);
			
		$sql18 = "DELETE FROM notificacao WHERE id = '$idNot3'";
		mysqli_query($conexao, $sql18);
	}

	$sql8 = "DELETE FROM usuarioPedido WHERE usuario_id = '$idUser'";
    mysqli_query($conexao, $sql8);

    $sql9 = "DELETE FROM notificacao WHERE usuario_id = '$idUser'";
    mysqli_query($conexao, $sql9);

    $sql10 = "DELETE FROM usuario WHERE id = '$idUser'";

    if (mysqli_query($conexao, $sql10)) {
    	session_destroy();
    	echo "<script>alert('Conta apagada com sucesso!'); window.location.href='../index.php';</script>";		
		mysqli_close($conexao);
    } else {
    	echo "<script>alert('Erro ao tentar apagar sua conta!'); history.back(0);</script>";		
		mysqli_close($conexao);
    }
?>