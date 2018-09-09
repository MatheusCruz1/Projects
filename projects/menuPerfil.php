<?php
    if(!isset($_SESSION)) // Verifica se existe alguma sessão. Senão existir, a função cria uma
    { 
        session_start(); 
    }

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $perfil64 = $_GET["x"];
    $perfil = base64_decode($perfil64);
?>

<!doctype html>
<html lang="pt-br">

<head>

</head>

<body>
	<!--    Menu perfil   -->
	<div class="btn-group mt-3" role="group" aria-label="Basic example" style="width: 100%">
        <?php
            if ($perfil == $_SESSION['id2']) {
        ?>
            <button type="button" class="btn" onclick="location.href='perfil.php?x=<?php echo $perfil64 ?>'" id="item-menu-projetos" style="width: 100%">Perfil</button>
            <button type="button" class="btn" onclick="location.href='notificacoes.php?x=<?php echo $perfil64 ?>'" id="item-menu-projetos" style="width: 100%">Notificações</button>
            <button type="button" class="btn" onclick="location.href='opcoes.php?x=<?php echo $perfil64 ?>'" id="item-menu-projetos" style="width: 100%">Opções</button>
        <?php } elseif (!isset($_SESSION) || $perfil != $_SESSION['id2']) {
        ?>
            <button type="button active" class="btn disabled" id="item-menu-projetos-active" style="width: 100%">Perfil</button>
        <?php } ?>
    </div>
    
</body>

</html>
