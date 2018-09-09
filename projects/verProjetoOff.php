<?php
    $idPro64 = $_GET["x"];
    $idPro = base64_decode($idPro64);
    
    require ('cadastrar/conexao.php');

    $sql = "SELECT projeto.nome_projeto, projeto.descricao, statusProjeto.nome, projeto.numero_atual_participantes, projeto.numero_max_participantes, statusProjeto.id, projeto.data_inicio, projeto.data_fim, usuario.nome_usuario FROM (((statusProjeto INNER JOIN projeto ON statusProjeto.id = projeto.statusProjeto_id) INNER JOIN usuario_projeto ON projeto.id = usuario_projeto.projeto_id) INNER JOIN usuario ON usuario.id = usuario_projeto.usuario_id) WHERE projeto.id = '$idPro'";

    $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
    $aux = mysqli_fetch_assoc($result);

    $dataInicio = $aux["data_inicio"];
    $dataInicio2 = date("d/m/Y - H:i", strtotime($dataInicio));
    $dataFim = $aux["data_fim"];
    $dataFim2 = date("d/m/Y - H:i", strtotime($dataFim));
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
    <title><?php echo $aux["nome_projeto"]; ?></title>
</head>

<body>
    <!--    Menu de navegação   -->
            <?php include 'menu.php' ?>

    <div class="container">
        <!--    Menu de projetos    -->
        <div class="btn-group mt-3" role="group" aria-label="Basic example" style="width: 100%">
            <button type="button active" class="btn" onclick="location.href='verProjetoOff.php?x=<?php echo $idPro64 ?>'" id="item-menu-projetos-active" style="width: 50%">Apresentação</button>
            <button type="button" class="btn" onclick="location.href='projetoParticipantesOff.php?x=<?php echo $idPro64 ?>'" id="item-menu-projetos" style="width: 50%">Participantes</button>
        </div>
        <!--    Fim do menu de projetos -->

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
                            <div class="col-sm-6 pl-0">
                                <h6>Iniciado em:</h6>
                                <p><?php echo $dataInicio2; ?></p>
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
                            
                            <div class="col-sm-6 pl-0">
                                <h6>Panticipantes:</h6>
                                <p><?php echo $aux["numero_atual_participantes"]; ?>/<?php echo $aux["numero_max_participantes"]; ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic example" style="width: 100%">
                            <button type="button" class="btn btn-primary" id="btn-alt-ver" style="width: 100%"
                                 data-toggle="modal" data-target="#exampleModal">Entrar no projeto</button>
                        </div>
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
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
</body>

</html>
