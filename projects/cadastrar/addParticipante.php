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

    $prop = $_SESSION['id2'];

	$perfil64 = $_GET["x"];
	$perfil = base64_decode($perfil64);

	$idPro64 = $_GET["y"];
	$idPro = base64_decode($idPro64);

	require ('conexao.php');

	$sql = "SELECT usuario.nome_usuario, projeto.nome_projeto FROM ((usuario INNER JOIN usuario_projeto ON usuario.id = usuario_projeto.usuario_id) INNER JOIN projeto ON usuario_projeto.projeto_id = projeto.id) WHERE usuario_projeto.usuario_id = '$prop' && usuario_projeto.projeto_id = '$idPro'";
 	$result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
 	$aux = mysqli_fetch_assoc($result);

 	$sql2 = "SELECT nome_usuario FROM usuario WHERE id = '$perfil'";
 	$result2 = mysqli_query($conexao, $sql2) or die( mysqli_error($conexao));
 	$aux2 = mysqli_fetch_assoc($result2);

 	$nomeUser = $aux2['nome_usuario'];
 	$mensagem = "Olá " . $aux2['nome_usuario'] . ", eu sou " . $aux['nome_usuario'] . "!<br>E estou convidando você para participar do meu projeto, " . $aux['nome_projeto'] . "!";

 	$sql3 = "SELECT id FROM notificacao WHERE mensagem = '$mensagem'";
 	$result3 = mysqli_query($conexao, $sql3) or die( mysqli_error($conexao));
 	$aux3 = mysqli_fetch_assoc($result3);

 	if (!isset($aux3['id'])) {
 		$sql4 = "INSERT INTO notificacao (mensagem, usuario_id, projeto_id) VALUES ('$mensagem', '$perfil', '$idPro')";

	 	if (mysqli_query($conexao, $sql4)) {
			echo "<script>alert('$nomeUser' + ' foi convidado!'); history.back(0);</script>";
				
			mysqli_close($conexao);
		}
	} else {
	 	echo "<script>alert('Você já convidou ' + '$nomeUser' + '!'); history.back(0);</script>";

		mysqli_close($conexao);
	}
?>