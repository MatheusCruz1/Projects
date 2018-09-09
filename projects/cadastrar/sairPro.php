<?php
	$idPro64 = $_GET['x'];
	$idPro =  base64_decode($idPro64);

	$idUser64 = $_GET['y'];
	$idUser =  base64_decode($idUser64);

	$z = $_GET['z'];

	require ('conexao.php');

	$sql = "SELECT numero_atual_participantes FROM projeto WHERE id = '$idPro' LIMIT 1";
	$result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
	$aux = mysqli_fetch_assoc($result);

	$numPart = $aux['numero_atual_participantes']-1;

	$sql2 = "DELETE FROM usuario_projeto WHERE usuario_id = '$idUser' && projeto_id = '$idPro' && tipo_id != '1' LIMIT 1";

	$sql3 = "UPDATE projeto SET numero_atual_participantes = '$numPart' WHERE id = '$idPro'";

	if (mysqli_query($conexao, $sql2) && mysqli_query($conexao, $sql3)) {
		if ($z == "1") {
			echo "<script>alert('Participante removido do projeto!'); history.back(0);</script>";		
			mysqli_close($conexao);
		} else {
			echo "<script>alert('Agora voçê não está mais participando do projeto!'); history.back(0);</script>";		
			mysqli_close($conexao);
		}
	}
?>