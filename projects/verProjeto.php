<?php
    if(!isset($_SESSION)) // Verifica se existe alguma sessão. Senão existir, a função cria uma
    { 
        session_start(); 
    }

    $idPro64 = $_GET["x"];
    $idPro = base64_decode($idPro64);

    $_SESSION['projID'] = $idPro;

    if (!isset($_SESSION['id2'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: index.php"); exit;
    }

    $idUser = $_SESSION['id2'];
    $idUser64 = base64_encode($idUser);

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    } 

    require ('cadastrar/conexao.php');

    $sql = "SELECT projeto.nome_projeto, projeto.descricao, statusProjeto.nome, projeto.numero_atual_participantes, projeto.numero_max_participantes, statusProjeto.id, projeto.data_inicio, projeto.data_fim, usuario.nome_usuario FROM (((statusProjeto INNER JOIN projeto ON statusProjeto.id = projeto.statusProjeto_id) INNER JOIN usuario_projeto ON projeto.id = usuario_projeto.projeto_id) INNER JOIN usuario ON usuario.id = usuario_projeto.usuario_id) WHERE projeto.id = '$idPro'";
    $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
    $aux = mysqli_fetch_assoc($result);

    $sql2 = "SELECT usuario_projeto.tipo_id FROM usuario_projeto WHERE usuario_projeto.projeto_id = '$idPro' && usuario_projeto.usuario_id = '$idUser'";
    $result2 = mysqli_query($conexao, $sql2) or die( mysqli_error($conexao));
    $aux2 = mysqli_fetch_assoc($result2);

    $dataInicio = $aux["data_inicio"];
    $dataInicio2 = date("d/m/Y - H:i", strtotime($dataInicio));
    $dataFim = $aux["data_fim"];
    $dataFim2 = date("d/m/Y - H:i", strtotime($dataFim));

    $sql3 = "SELECT numero_atual_participantes, numero_max_participantes FROM projeto WHERE id = '$idPro' LIMIT 1";
    $result3 = mysqli_query($conexao, $sql3) or die( mysqli_error($conexao));
    $aux3 = mysqli_fetch_assoc($result3);
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

    <!-- <link rel="shortcut icon" href="imagens/logo.ico" type="image/x-icon" /> -->
    <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png">
    <title><?php echo $aux["nome_projeto"]; ?></title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">
        <!--    Menu de navegação   -->
        <?php include 'menuVerPro.php' ?>

        <div class="row mt-1 mb-0 pb-0">
            <div class="col-6 mb-4">
                <h5 class="text-center mt-3">Descrição</h5>
                <p><?php echo $aux["descricao"]; ?></p>
            </div>

            <div class="col-6">
                <div>
                    <div class="row">
                        <h3 class="card-title ml-3 float-left"><?php echo $aux["nome_projeto"]; ?></h3>
                        <h3 class="card-title mt-1 ml-3 mr-3" style="font-size: 16px">
                            <?php if ($aux["id"]==1) { ?>
                                <div class="badge badge-pill badge-primary mr-3" style="font-size: 16px"><?php echo $aux["nome"]; ?>
                                </div>
                            <?php } elseif ($aux["id"]==2) { ?>
                                <div class="badge badge-pill badge-success mr-3" style="font-size: 16px"><?php echo $aux["nome"]; ?>
                                </div>
                            <?php } elseif ($aux["id"]==3) { ?>
                                <div class="badge badge-pill badge-secondary mr-3" style="font-size: 16px"><?php echo $aux["nome"]; ?>
                                </div>
                            <?php } elseif ($aux["id"]==4) { ?>
                                <div class="badge badge-pill badge-danger mr-3" style="font-size: 16px"><?php echo $aux["nome"]; ?>
                                </div>
                            <?php } ?>
                        </h3>

                    </div>
                    <h5 class="card-subtitle ml-2 text-muted"><?php echo $aux["nome_usuario"]; ?></h5>
                </div>

                <ul class="list-group list-group-flush mt-1">
                    <li class="list-group-item">
                        <div class="row mx-0 mb-0">
                            <div class="col-sm-4 pl-0">
                                <h6>Iniciado em:</h6>
                                <p><?php
                                echo $dataInicio2; ?></p>
                            </div>

                            <?php if ($aux["id"]==2) {?>
                                <div class="col-sm-4 pl-0">
                                    <h6>Finalizado em:</h6>
                                    <p><?php
                                    echo $dataFim2; ?></p>
                                </div>
                            <?php } elseif ($aux["id"]==3) {?>
                                <div class="col-sm-4 pl-0">
                                    <h6>Pausado em:</h6>
                                    <p><?php
                                    echo $dataFim2; ?></p>
                                </div>
                            <?php } elseif ($aux["id"]==4) {?>
                                <div class="col-sm-4 pl-0">
                                    <h6>Cancelado em:</h6>
                                    <p><?php
                                    echo $dataFim2; ?></p>
                                </div>
                            <?php } ?>

                            <div class="col-sm-4 pl-0">
                                <h6>Panticipantes:</h6>
                                <p><?php echo $aux["numero_atual_participantes"]; ?>/<?php echo $aux["numero_max_participantes"]; ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%">
                            <?php if ($aux["id"]==1 && $aux2["tipo_id"]==1) { ?>
                                <button type="button" class="btn btn-success" style="width: 100%" id="btn-con"
                                    onclick="location.href='cadastrar/statusPro.php?x=<?php echo $idPro64 ?>
                                        &&y=2'">Concluir</button>
                                <button type="button" class="btn btn-secondary" style="width: 100%" id="btn-pause"
                                    onclick="location.href='cadastrar/statusPro.php?x=<?php echo $idPro64 ?>
                                        &&y=3'">Pausar</button>
                                <button type="button" class="btn btn-danger" style="width: 100%" id="btn-cancel"
                                    onclick="location.href='cadastrar/statusPro.php?x=<?php echo $idPro64 ?>
                                        &&y=4'">Cancelar</button>
                            <?php } elseif ($aux["id"]==2 && $aux2["tipo_id"]==1) { ?>
                                <button type="button" class="btn btn-primary" id="btn-alt-ver" style="width: 100%"
                                    onclick="location.href='cadastrar/statusPro.php?x=<?php echo $idPro64 ?>
                                        &&y=1'">Retomar</button>
                            <?php } elseif ($aux["id"]==3 && $aux2["tipo_id"]==1) { ?>
                                <button type="button" class="btn btn-primary" id="btn-alt-ver" style="width: 100%"
                                    onclick="location.href='cadastrar/statusPro.php?x=<?php echo $idPro64 ?>
                                        &&y=1'">Retomar</button>
                                <button type="button" class="btn btn-danger" style="width: 100%" id="btn-cancel"
                                    onclick="location.href='cadastrar/statusPro.php?x=<?php echo $idPro64 ?>
                                        &&y=4'">Cancelar</button>
                            <?php } elseif ($aux["id"]==4 && $aux2["tipo_id"]==1) { ?>
                                <button type="button" class="btn btn-primary" id="btn-alt-ver" style="width: 100%"
                                    onclick="location.href='cadastrar/statusPro.php?x=<?php echo $idPro64 ?>
                                        &&y=1'">Retomar</button>
                            <?php } elseif ($aux2["tipo_id"]!=1 && $aux2["tipo_id"]!=2 && $aux2["tipo_id"]!=3 && $aux3['numero_atual_participantes'] < $aux3['numero_max_participantes']) { ?>
                                <button type="button" class="btn btn-primary" id="btn-alt-ver" style="width: 100%"
                                    onclick="location.href='cadastrar/entrarPro.php?x=<?php echo $idPro64 ?>
                                        &&y=<?php echo $idUser64 ?>'">Entrar no projeto</button>
                            <?php } ?>
                        </div>
                        <?php if ($aux2["tipo_id"]==1) { ?>
                            <button type="button" class="mt-2 btn btn-info" id="btn-del-pro" style="width: 100%"
                                    onclick="location.href='cadastrar/apagarPro.php?x=<?php echo $idPro64 ?>&&y=<?php echo $idUser64 ?>'">Apagar projeto</button>
                        <?php } ?>
                    </li>

                </ul>
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
