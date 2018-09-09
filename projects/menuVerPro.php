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

    $idUser = $_SESSION['id2'];
    $idPro2 = $_SESSION['projID'];
    $IdPro64 = base64_encode("$idPro2");
?>

<!doctype html>
<html lang="pt-br">

<head>

</head>

<body>
	<!--    Menu de projetos    -->
	<div class="btn-group mt-3" role="group" aria-label="Basic example" style="width: 100%">
        <button type="button" class="btn" onclick="location.href='verProjeto.php?x=<?php echo $IdPro64 ?>'" id="item-menu-projetos" style="width: 100%">Apresentação</button>
		<button type="button" class="btn" onclick="location.href='projetoParticipantes.php'" id="item-menu-projetos" style="width: 100%">Participantes</button>
		<?php 
            require ('cadastrar/conexao.php');

            $sql4 = "SELECT tipo.id FROM ((tipo INNER JOIN usuario_projeto ON tipo.id = usuario_projeto.tipo_id) INNER JOIN usuario ON usuario_projeto.usuario_id = usuario.id) WHERE usuario_projeto.usuario_id = '$idUser' && usuario_projeto.projeto_id = '$idPro2'";
            $result4 = mysqli_query($conexao, $sql4) or die( mysqli_error($conexao));   
            $aux4 = mysqli_fetch_assoc($result4);

            $sql5 = "SELECT statusProjeto_id FROM projeto WHERE id = '$idPro2'";
            $result5 = mysqli_query($conexao, $sql5) or die( mysqli_error($conexao));   
            $aux5 = mysqli_fetch_assoc($result5);

            if ($sql4 && $aux4["id"] == 3 || $aux4["id"] == 1) {
                if ($aux5['statusProjeto_id'] == 1) {?>
                <button type="button" class="btn" onclick="location.href='projetoTarefas.php'" id="item-menu-projetos" style="width: 100%">Tarefas</button>
            <?php } ?>
            <?php if ($aux4["id"] == 1) {?>
                <button type="button" class="btn" onclick="location.href='alterarDadosProjeto.php?x=<?php echo $IdPro64 ?>'" id="item-menu-projetos" style="width: 100%">Aterar Dados</button>
        <?php }} ?>
	</div>
	<!--    Fim do menu de projetos -->
    
</body>

</html>
