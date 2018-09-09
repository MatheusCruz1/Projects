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
    <title>Pesqisar participante</title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">

        <!--    Menu de projetos    -->
        <div class="btn-group mt-3" role="group" aria-label="Basic example" style="width: 100%">
            <div class="btn disabled" id="item-menu-projetos-active" style="width: 100%">Pesquisar Participantes</div>
        </div>
        <!--    Fim do menu de projetos -->

        <div class="row mt-1">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="table-wrapper my-0 py-0">
                                    <div class="table-title my-0">
                                        <div class="row ml-3">
                                            <div class="search-box">
                                                <i class="material-icons">&#xE8B6;</i>
                                                <input type="text" class="form-control" id="myInput" placeholder="Buscar...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-wrapper my-0 py-0">
                                    <div class="table-title my-0">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <?php
                                                    $idUser = $_SESSION["id2"];

                                                    $idPro64 = $_GET["x"];
                                                    $idPro2 = base64_decode($idPro64);

                                                    require ('cadastrar/conexao.php');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-striped table-hover table-bordered" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Sexo</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                $sql = "SELECT  id, nome_usuario, sexo  FROM usuario WHERE id != '$idUser' order by nome_usuario";

                                                $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));   

                                                while($aux = mysqli_fetch_assoc($result)) {
                                                    $idPesqisa = $aux["id"];

                                                    $sql2 = "SELECT usuario_projeto.tipo_id FROM ((tipo INNER JOIN usuario_projeto ON tipo.id = usuario_projeto.tipo_id) INNER JOIN usuario ON usuario_projeto.usuario_id = usuario.id) WHERE usuario_projeto.usuario_id = '$idPesqisa' && usuario_projeto.projeto_id = '$idPro2'";

                                                    $result2 = mysqli_query($conexao, $sql2) or die( mysqli_error($conexao));

                                                    $aux2 = mysqli_fetch_assoc($result2);

                                                    if (!isset($aux2['tipo_id']) && $aux['nome_usuario'] != $idPesqisa2) { 

                                                    $idPesqisa2 = $aux['nome_usuario'];
                                                    $perfil = $idPesqisa;
                                                    $perfil64 = base64_encode($perfil);
                                            ?>
                                                <tr class="text-center">
                                                    <td class="text-left"><?php echo $aux["nome_usuario"]; ?></td>
                                                    <td class="text-left"><?php echo $aux["sexo"]; ?></td>
                                                    <td>
                                                        <a href="perfilOutro.php?x=<?php echo $perfil64 ?>" title="Ver perfil" data-toggle="tooltip">
                                                            <i class="fa fa-eye"></i></i>
                                                        </a>
                                                        <?php 
                                                            $sql4 = "SELECT tipo.id FROM ((tipo INNER JOIN usuario_projeto ON tipo.id = usuario_projeto.tipo_id) INNER JOIN usuario ON usuario_projeto.usuario_id = usuario.id) WHERE usuario_projeto.usuario_id = '$idUser' && usuario_projeto.projeto_id = '$idPro2'";

                                                            $result4 = mysqli_query($conexao, $sql4) or die( mysqli_error($conexao));

                                                            $aux4 = mysqli_fetch_assoc($result4);
                                                            
                                                            if ($aux4["id"] == 1) {       
                                                        ?>

                                                        <a href="cadastrar/addParticipante.php?x=<?php echo $perfil64 ?>&&y=<?php echo $idPro64 ?>" title="Convidar participante" data-toggle="tooltip">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </a>
                                                    <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }} ?>
                                        </tbody>
                                    </table>

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
