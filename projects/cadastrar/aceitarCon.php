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

	$idNot64 = $_GET["x"];
	$idNot = base64_decode($idNot64);

	require ('conexao.php');

	$sql = "SELECT numero_atual_participantes, numero_max_participantes FROM projeto WHERE id = '$idPro' LIMIT 1";

    $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
    $aux = mysqli_fetch_assoc($result);

    $numPart = $aux['numero_atual_participantes']+1;

    if ($aux['numero_atual_participantes'] < $aux['numero_max_participantes']) {
	    $sql2 = "INSERT INTO usuario_projeto (usuario_id, projeto_id, tipo_id) VALUES ('$perfil', '$idPro', '$tipo')";
		
		if (mysqli_query($conexao, $sql2)) {
            $sql13 = "SELECT notificacao_id FROM (notificacao INNER JOIN usuarioPedido ON notificacao.id = usuarioPedido.notificacao_id) WHERE usuarioPedido.usuario_id = '$perfil' && notificacao.projeto_id = '$idPro'";
            $result13 = mysqli_query($conexao, $sql13) or die( mysqli_error($conexao));
                    
            while($aux4 = mysqli_fetch_assoc($result13)) {
                $idNot2 = $aux4['notificacao_id'];

                $sql14 = "DELETE FROM usuarioPedido WHERE notificacao_id = '$idNot2'";
                mysqli_query($conexao, $sql14);
                
                $sql15 = "DELETE FROM notificacao WHERE id = '$idNot2'";
                mysqli_query($conexao, $sql15);   
            }

			$sql4 = "UPDATE projeto SET numero_atual_participantes = '$numPart' WHERE id = '$idPro'";
			mysqli_query($conexao, $sql4);
		
		    $sql3 = "DELETE FROM notificacao WHERE id = '$idNot'";
			mysqli_query($conexao, $sql3);

            if (mysqli_query($conexao, $sql3) && mysqli_query($conexao, $sql4)) {
    			echo "<script>alert('Agora voçê está participando do projeto!'); history.back(0);</script>";		
    			mysqli_close($conexao);
            }
		}
    } else {
    	echo "<script>alert('Sinto muito mas o projeto já está com o máximo de participantes!'); history.back(0);</script>";		
		mysqli_close($conexao);
    }
?>