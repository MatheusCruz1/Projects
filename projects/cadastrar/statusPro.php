<?php
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

    $idPro64 = $_GET["x"];
	$idPro = base64_decode($idPro64);
	$idUser = $_SESSION['id2'];
	$fun = $_GET["y"];

	require ('conexao.php');

	$sql = "SELECT projeto.statusProjeto_id, projeto.nome_projeto, usuario_projeto.tipo_id  FROM (usuario_projeto INNER JOIN projeto ON usuario_projeto.projeto_id = projeto.id) WHERE usuario_projeto.projeto_id = '$idPro' && usuario_projeto.usuario_id = '$idUser' && usuario_projeto.tipo_id = 1 LIMIT 1";
    $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
    $aux = mysqli_fetch_assoc($result);

    $nomePro = $aux['nome_projeto'];

    if ($fun == 1 && $aux["statusProjeto_id"] != 1 && $aux['tipo_id'] == 1) {
    	$sql2 = "UPDATE projeto SET projeto.statusProjeto_id = 1 WHERE id = '$idPro'";

    	if (mysqli_query($conexao, $sql2)) {
	    	echo "<script>alert('O projeto ' + '$nomePro' + ' foi retomado!'); history.back(0);</script>";		
			mysqli_close($conexao);
    	} else {
    		echo "<script>alert('Erro ao retomar o projeto ' + '$nomePro' + '!'); history.back(0);</script>";		
			mysqli_close($conexao);
    	}
    } elseif ($aux['tipo_id'] != 1) {
    	echo "<script>alert('Você não tem permissão para mudar as opções do projeto!'); history.back(0);</script>";		
		mysqli_close($conexao);
    }

    if ($fun == 2 && $aux["statusProjeto_id"] != 2 && $aux['tipo_id'] == 1) {
    	$sql3 = "UPDATE projeto SET projeto.statusProjeto_id = 2, projeto.data_fim = CURRENT_TIMESTAMP WHERE id = '$idPro'";

    	if (mysqli_query($conexao, $sql3)) {
	    	echo "<script>alert('O projeto ' + '$nomePro' + ' foi concluido!'); history.back(0);</script>";		
			mysqli_close($conexao);
    	} else {
    		echo "<script>alert('Erro ao concluir o projeto ' + '$nomePro' + '!'); history.back(0);</script>";		
			mysqli_close($conexao);
    	}
    } elseif ($aux['tipo_id'] != 1) {
    	echo "<script>alert('Você não tem permissão para mudar as opções do projeto!'); history.back(0);</script>";		
		mysqli_close($conexao);
    }

    if ($fun == 3 && $aux["statusProjeto_id"] != 3 && $aux['tipo_id'] == 1) {
    	$sql4 = "UPDATE projeto SET projeto.statusProjeto_id = 3, projeto.data_fim = CURRENT_TIMESTAMP WHERE id = '$idPro'";

    	if (mysqli_query($conexao, $sql4)) {
	    	echo "<script>alert('O projeto ' + '$nomePro' + ' foi pausado!'); history.back(0);</script>";		
			mysqli_close($conexao);
    	} else {
    		echo "<script>alert('Erro ao pausar o projeto ' + '$nomePro' + '!'); history.back(0);</script>";		
			mysqli_close($conexao);
    	}
    } elseif ($aux['tipo_id'] != 1) {
    	echo "<script>alert('Você não tem permissão para mudar as opções do projeto!'); history.back(0);</script>";		
		mysqli_close($conexao);
    }

    if ($fun == 4 && $aux["statusProjeto_id"] != 4 && $aux['tipo_id'] == 1) {
    	$sql5 = "UPDATE projeto SET projeto.statusProjeto_id = 4, projeto.data_fim = CURRENT_TIMESTAMP WHERE id = '$idPro'";

    	if (mysqli_query($conexao, $sql5)) {
	    	echo "<script>alert('O projeto ' + '$nomePro' + ' foi cancelado!'); history.back(0);</script>";		
			mysqli_close($conexao);
    	} else {
    		echo "<script>alert('Erro ao cancelar o projeto ' + '$nomePro' + '!'); history.back(0);</script>";		
			mysqli_close($conexao);
    	}
    } elseif ($aux['tipo_id'] != 1) {
    	echo "<script>alert('Você não tem permissão para mudar as opções do projeto!'); history.back(0);</script>";		
		mysqli_close($conexao);
    }
?>