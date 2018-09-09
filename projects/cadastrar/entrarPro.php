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

	$sql = "SELECT usuario.nome_usuario, usuario.id, projeto.nome_projeto FROM ((usuario INNER JOIN usuario_projeto ON usuario.id = usuario_projeto.usuario_id) INNER JOIN projeto ON usuario_projeto.projeto_id = projeto.id) WHERE usuario_projeto.projeto_id = '$idPro' && usuario_projeto.tipo_id = 1 LIMIT 1";
 	$result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
 	$aux = mysqli_fetch_assoc($result);

 	$sql2 = "SELECT nome_usuario FROM usuario WHERE id = '$idUser'";
 	$result2 = mysqli_query($conexao, $sql2) or die( mysqli_error($conexao));
 	$aux2 = mysqli_fetch_assoc($result2);

 	$nomePro = $aux['nome_projeto'];
 	$prop = $aux['id'];
 	$nomeUser = $aux2['nome_usuario'];
 	$mensagem = "Olá " . $aux['nome_usuario'] . ", eu sou " . $aux2['nome_usuario'] . "!<br>E estou querendo participar do seu projeto, " . $aux['nome_projeto'] . "!";

 	$sql3 = "SELECT id FROM notificacao WHERE mensagem = '$mensagem'";
 	$result3 = mysqli_query($conexao, $sql3) or die( mysqli_error($conexao));
 	$aux3 = mysqli_fetch_assoc($result3);

 	if (!isset($aux3['id'])) {
 		$sql4 = "INSERT INTO notificacao (mensagem, usuario_id, projeto_id) VALUES ('$mensagem', '$prop', '$idPro')";
 		mysqli_query($conexao, $sql4);

	 	$sql5 = "SELECT id FROM notificacao WHERE mensagem = '$mensagem' LIMIT 1";
		$result5 = mysqli_query($conexao, $sql5);
		$row = mysqli_fetch_assoc($result5);
		$idNot = $row["id"];

	 	$sql6 = "INSERT INTO usuarioPedido (usuario_id, notificacao_id) VALUES ('$idUser', '$idNot')";

	 	if ($sql4 && mysqli_query($conexao, $sql6)) {
			echo "<script>alert('Pedido para entrar no projeto ' + '$nomePro' + ' enviado!'); window.location.href='../verProjeto.php?x=$idPro64'</script>";
				
			mysqli_close($conexao);
		}
	} else {
	 	echo "<script>alert('Você já enviou um pedido para entrar no projeto ' + '$nomePro' + '!'); history.back(0);</script>";

		mysqli_close($conexao);
	}
?>