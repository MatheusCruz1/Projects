<?php

require_once('conexao.php');

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
?>

<?php

$nome = addslashes (strip_tags($_POST['nome']));
$sexo = $_POST['sexo'];
$email = strtolower(addslashes(strip_tags($_POST['email'])));
$senha = addslashes (strip_tags($_POST['senha']));
$cripSenha = md5($senha);

$sql2 = "SELECT email FROM usuario WHERE email = '$email'";
$result2 = mysqli_query($conexao, $sql2) or die( mysqli_error($conexao));  
$aux2 = mysqli_fetch_assoc($result2);

$sql3 = "SELECT nome_usuario FROM usuario WHERE nome_usuario = '$nome'";
$result3 = mysqli_query($conexao, $sql3) or die( mysqli_error($conexao));  
$aux3 = mysqli_fetch_assoc($result3);

if ($aux2 == $email) {
	echo "<script>alert('E-mail de usuario já cadastrado!'); history.back(0);</script>";
} elseif ($aux3 == $nome) {
	echo "<script>alert('Nome de usuario já cadastrado!'); history.back(0);</script>";
} else {

	$sql = "INSERT INTO usuario (nome_usuario, sexo, email, senha) VALUES ('$nome', '$sexo', '$email', '$cripSenha')";

	if (mysqli_query($conexao, $sql)) {
		echo "<script>alert('Usuario cadastrado com sucesso!'); window.location.href='../index.php'</script>";

		mysqli_close($conexao);
	}else{
		echo "<script>alert('Usuario já existe!'); history.back(0);</script>";
	}
}
?>