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

    $idUser = $_SESSION["id2"];
    $idPro2 = $_SESSION['projID'];

    require ('cadastrar/conexao.php');

    $sql2 = "SELECT  nome_projeto, numero_atual_participantes, numero_max_participantes FROM projeto WHERE id = '$idPro2'";
    $result2 = mysqli_query($conexao, $sql2) or die( mysqli_error($conexao));   

    $aux2 = mysqli_fetch_assoc($result2);
?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/compiler/style.css">
    <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/compiler/filtro.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png">
    <title><?php echo $aux2['nome_projeto'] ?> - Participantes</title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">
        <!--    Menu de navegação   -->
        <?php include 'menuVerPro.php' ?>

        <div class="row mt-1">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="table-wrapper my-0 py-0">
                                    <div class="table-title my-0">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h2>Participantes do Projeto - 
                                                    <?php echo $aux2["numero_atual_participantes"]; ?>/<?php echo $aux2["numero_max_participantes"]; ?>

                                                </h2>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Hierarquia</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                $IdPro64 = base64_encode("$idPro2");

                                                $sql = "SELECT  usuario_projeto.usuario_id, usuario.nome_usuario, tipo.nome_tipo, tipo.id FROM ((tipo INNER JOIN usuario_projeto ON tipo.id = usuario_projeto.tipo_id) INNER JOIN usuario ON usuario_projeto.usuario_id = usuario.id) WHERE usuario_projeto.projeto_id = '$idPro2'";

                                                $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));   

                                                while($aux = mysqli_fetch_assoc($result)) 
                                                { 
                                            ?>
                                                <tr class="text-center">
                                                    <td class="text-left"><?php echo $aux["nome_usuario"]; ?></td>
                                                    <td class="text-left"><?php echo $aux["nome_tipo"]; ?></td>
                                                    <td>
                                                        <?php
                                                            $perfil = $aux["usuario_id"];
                                                            $perfil64 = base64_encode($perfil);

                                                            if ($perfil == $_SESSION['id2']) {
                                                        ?>
                                                            <a href="perfil.php" title="Ver perfil" data-toggle="tooltip">
                                                                <i class="fa fa-eye"></i></i>
                                                            </a>
                                                        <?php } else { ?>
                                                        <a href="perfilOutro.php?x=<?php echo $perfil64 ?>" title="Ver perfil" data-toggle="tooltip">
                                                            <i class="fa fa-eye"></i></i>
                                                        </a>
                                                        <?php } ?>
                                                        <?php 
                                                            $sql4 = "SELECT tipo.id FROM ((tipo INNER JOIN usuario_projeto ON tipo.id = usuario_projeto.tipo_id) INNER JOIN usuario ON usuario_projeto.usuario_id = usuario.id) WHERE usuario_projeto.usuario_id = '$idUser' && usuario_projeto.projeto_id = '$idPro2'";

                                                            $result4 = mysqli_query($conexao, $sql4) or die( mysqli_error($conexao));   

                                                            $aux4 = mysqli_fetch_assoc($result4);
                                                            
                                                            if ($aux["id"] != 1 && $aux4["id"] == 1) {       
                                                        ?>

                                                        <a href="cadastrar/sairPro.php?x=<?php echo $IdPro64 ?>&&y=<?php echo $perfil64 ?>&&z=1" title="Remover usuario" data-toggle="tooltip">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php
                                        if ($aux4["id"] == 1 && $aux2["numero_atual_participantes"] < $aux2["numero_max_participantes"]) { 
                                    ?>
                                        <div class="text-center">
                                            <a href="pesquisarParticipante.php?x=<?php echo $IdPro64 ?>" title="Adicionar participante" data-toggle="tooltip">
                                                <i class="fa fa-plus-circle fa-2x"></i>
                                            </a>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
        });

    </script>
</body>

</html>
