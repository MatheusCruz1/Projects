<?php 
session_start();

require_once('conexao.php');

$email = strtolower($_POST['email']);
$senha = $_POST['senha'];
$senhacriptografada = md5($senha);


if (empty($email) OR empty($senhacriptografada)) {
	header("Location: ../index.php"); exit;
}

$query =  mysqli_query($conexao, "SELECT  *  FROM usuario WHERE email = '$email' AND senha = '$senhacriptografada' LIMIT 1");

if(mysqli_num_rows($query) != 1){
	echo "<script>alert('E-mail ou senha incorretos! Por favor tente novamente!'); history.back();</script>";
	
	
}else{
	
	$resultado = mysqli_fetch_assoc($query);
	// Salva os dados encontrados na sessão
	$_SESSION["id2"] = $resultado['id'];
	$_SESSION["nome2"] = $resultado['nome_usuario'];
	
    // Redireciona o visitante
    echo "<script>window.location.href='../indexOn.php'</script>";
	
}


?>