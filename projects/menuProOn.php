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
?>

<!doctype html>
<html lang="pt-br">

<head>

</head>

<body>
    <!--    Menu de projetos    -->
    <div class="btn-group mt-3" role="group" aria-label="Basic example" style="width: 100%">
        <button type="button" class="btn" onclick="location.href='meusProjetos.php'" id="item-menu-projetos">Meus Projetos</button>
        <button type="button" class="btn" onclick="location.href='projetosOutrosPropritarios.php'" id="item-menu-projetos">Outros Proprietarios</button>
        <button type="button" class="btn" onclick="location.href='criarProjeto.php'" id="item-menu-projetos">Criar Projeto</button>
    </div>
    <!--    Fim do menu de projetos -->
    
</body>

</html>
