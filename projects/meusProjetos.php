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
        <title>Meus projetos</title>
    </head>

    <body>
        <!--    Menu de navegação   -->
        <?php include 'menuLogado.php' ?>

        <div class="container">

            <!--    Menu de navegação   -->
            <?php include 'menuProOn.php' ?>

            <div class="row mt-1 mb-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-wrapper my-0 py-0">
                                <div class="table-title my-0">
                                    <div class="row ml-1">
                                        <div class="search-box">
                                            <i class="material-icons">&#xE8B6;</i>
                                            <input type="text" class="form-control" id="myInput" placeholder="Buscar...">
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-striped table-hover table-bordered" id="myTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-left">Nome</th>

                                            <th>Status</th>
                                            <th>Participantes</th>

                                            <th>Ínicio</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $idUser = $_SESSION["id2"];
                                            $idUser64 = base64_encode($idUser);

                                            require ('cadastrar/conexao.php');

                                            $sql = "SELECT projeto.id, projeto.nome_projeto, statusProjeto.nome, projeto.statusProjeto_id, projeto.numero_atual_participantes, projeto.numero_max_participantes, projeto.data_inicio FROM ((statusProjeto INNER JOIN projeto ON statusProjeto.id = projeto.statusProjeto_id) INNER JOIN usuario_projeto ON projeto.id = usuario_projeto.projeto_id) WHERE usuario_projeto.usuario_id = '$idUser' && usuario_projeto.tipo_id = 1";

                                            $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));   

                                            while($aux = mysqli_fetch_assoc($result)) 
                                            { 
                                                $idPro = $aux["id"];
                                                $IdPro64 = base64_encode("$idPro");

                                                $dataInicio = $aux["data_inicio"];
                                                $dataInicio2 = date("d/m/Y - H:i", strtotime($dataInicio));
                                        ?>

                                        <tr class="text-center">
                                            <td class="text-left">
                                                <?php echo $aux["nome_projeto"]; ?>
                                            </td>
                                            <td>
                                                <?php if ($aux["statusProjeto_id"]==1) { ?>
                                                    <div class="badge badge-pill badge-primary"><?php echo $aux["nome"]; ?>
                                                    </div>
                                                <?php } elseif ($aux["statusProjeto_id"]==2) { ?>
                                                    <div class="badge badge-pill badge-success"><?php echo $aux["nome"]; ?>
                                                    </div>
                                                <?php } elseif ($aux["statusProjeto_id"]==3) { ?>
                                                    <div class="badge badge-pill badge-secondary"><?php echo $aux["nome"]; ?>
                                                    </div>
                                                <?php } elseif ($aux["statusProjeto_id"]==4) { ?>
                                                    <div class="badge badge-pill badge-danger"><?php echo $aux["nome"]; ?>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php echo $aux["numero_atual_participantes"]; ?>
                                                /
                                                <?php echo $aux["numero_max_participantes"]; ?>
                                            </td>
                                            <td><?php echo $dataInicio2; ?></td>
                                            <td>
                                                <a href="verProjeto.php?x=<?php echo $IdPro64 ?>" title="Ver projeto" data-toggle="tooltip">
                                                <i class="fa fa-eye"></i></i>
                                                </a>

                                                <a href="cadastrar/apagarPro.php?x=<?php echo $IdPro64 ?>&&y=<?php echo $idUser64 ?>" title="Apagar projeto" data-toggle="tooltip" style="background: none;">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                    </tbody>
                                </table>
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
