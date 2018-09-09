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
$atual = $_POST['atual'];
$status = $_POST['status'];


$sql = "INSERT INTO projeto (nome_projeto, descricao, numero_max_participantes, numero_atual_participantes, statusProjeto_id) VALUES ('$nome', '$descricao', '$max', '$atual', '$status')";

if (mysqli_query($conexao, $sql)) {
	$proprietario = $_SESSION["id2"];
	$tipo = 1;

	$sql2 = "SELECT id FROM projeto WHERE nome_projeto = '$nome' LIMIT 1";
	$result = mysqli_query($conexao, $sql2);
	$row = mysqli_fetch_assoc($result);
	$idProjeto = $row["id"];

	if ($sql2) {
		$sql3 = "INSERT INTO usuario_projeto (usuario_id, projeto_id, tipo_id) VALUES ('$proprietario', '$idProjeto', '$tipo')";

		if (mysqli_query($conexao, $sql3)) {
			echo "<script>alert('Projeto ' + '$nome' + ' criado com sucesso!'); window.location.href='../meusProjetos.php'</script>";
			
			mysqli_close($conexao);
		}
	}
	
}else{
	 echo "<script>alert('Projeto já existe!'); history.back(0);</script>";
}

?>