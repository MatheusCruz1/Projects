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
    $perfil64 = base64_encode($perfil);
?>

<!doctype html>
<html lang="pt-br">

<head>

</head>

<!--    
        Paleta de cores :
            azul claro:     #6495ED;
            azul escuro:    #345BA0;
            verde escuro:   #83A03C;
            verde claro:    #95BA3C;
            rosa:           #F08E7D;
        -->

<body>

    <script type="text/javascript">
        function logout(){
            window.location.href = "cadastrar/sair.php";
        }
    </script>

    <nav class="navbar navbar-expand-lg navbar-dark" id="navbar-menu">
        <div class="container">
            <a href="indexOn.php"><img src="imagens/logoTriangulo (1).png" style="height: 40px;"></a>
            <a class="navbar-brand h1 mb-0 ml-1" id="navbar-brand-menu" href="indexOn.php">Projects</a>

            <!--    Botão de menu colapsavel    -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--    Fim do botão de menu colapsavel    -->

            <div class="collapse navbar-collapse" id="navbarSite">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="indexOn.php" id="menu-item">Início</a></li>

                    <!--    Dropdown de projetos    -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuProjetos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Projetos</a>

                        <div class="dropdown-menu" aria-labelledby="menuProjetos">
                            <a class="dropdown-item" href="meusProjetos.php">Meus Projetos</a>
                            <a class="dropdown-item" href="projetosOutrosPropritarios.php">Outro Proprietarios</a>
                            <a class="dropdown-item" href="criarProjeto.php">Criar Projeto</a>
                        </div>
                    </li>
                    <!--    Fim do dropdown de projetos    -->

                    <!--    Dropdown de pesquisa    -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuPresquisar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">Pesquisar</a>

                        <div class="dropdown-menu" aria-labelledby="menuPesquisar">
                            <a class="dropdown-item" href="pesquisarProjeto.php">Projetos</a>
                            <a class="dropdown-item" href="pesquisarUsuario.php">Usuarios</a>
                        </div>
                    </li>
                    <!--    Fim do dropdown de pesquisa    -->
                </ul>

                        <!--    Dropdown da conta do usuario   -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <?php
                            require ('cadastrar/conexao.php');

                            $sqlQtdNot = "SELECT COUNT(*) AS total FROM notificacao WHERE usuario_id = '$perfil'";
                            $resultQtdNot = mysqli_query($conexao, $sqlQtdNot) or die( mysqli_error($conexao));
                            $auxQtdNot = mysqli_fetch_assoc($resultQtdNot);
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" id="menuConta" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION["nome2"]; ?>
                            <?php if ($auxQtdNot['total'] > 0) { ?>
                                <span class="badge badge-pill badge-danger"><?php echo $auxQtdNot['total'] ?></span>
                            <?php } ?>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="menuConta">
                            <a class="dropdown-item" href="perfil.php?x=<?php echo $perfil64 ?>" id="menu-item">Perfil</a>
                            <a class="dropdown-item" href="notificacoes.php?x=<?php echo $perfil64 ?>" id="menu-item">
                                Notificações
                                <?php if ($auxQtdNot['total'] > 0) { ?>
                                    <span class="badge badge-pill badge-danger"><?php echo $auxQtdNot['total'] ?></span>
                                <?php } ?>
                            </a>
                            <a class="dropdown-item" href="opcoes.php?x=<?php echo $perfil64 ?>">Opções</a>
                            <div class="dropdown-divider" style="height: 2px"></div>
                            <a class="dropdown-item" href="#" onclick="logout()">Sair</a>
                        </div>
                    </li>
                </ul>
                <!--    Fim do dropdown da conta do usuario   -->
            </div>
        </div>
    </nav>
</body>
</html>