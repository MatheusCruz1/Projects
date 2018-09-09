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

    require ('cadastrar/conexao.php');

    $perfil = $_SESSION['id2'];

    $sql = "SELECT nome_usuario, sexo, email FROM usuario WHERE id = '$perfil' LIMIT 1";
    $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
    $aux = mysqli_fetch_assoc($result);
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
    <title><?php echo $aux['nome_usuario'] ?> - Notificações</title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">
        <!--    Menu perfil   -->
        <?php include 'menuPerfil.php' ?>

        <div class="table-wrapper my-0 py-0">
            <table class="table table-striped table-hover table-bordered" id="myTable">
                <thead>
                    <tr class="text-center">
                        <th class="text-left">Mensagem</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    require ('cadastrar/conexao.php');

                    $sql2 = "SELECT id, mensagem, usuario_id, projeto_id, data FROM notificacao WHERE usuario_id = '$perfil' ORDER BY notificacao.data DESC";

                    $result2 = mysqli_query($conexao, $sql2) or die( mysqli_error($conexao));

                    while($aux2 = mysqli_fetch_assoc($result2)) 
                    { 
                        $idNot = $aux2["id"];
                        $idNot64 = base64_encode($idNot);
                        $idPro = $aux2["projeto_id"];
                        $idPro64 = base64_encode($idPro);

                        $idUser = $aux2['usuario_id'];

                        $dataNot = $aux2["data"];
                        $dataNot2 = date("d/m/Y - H:i", strtotime($dataNot));
                ?>

                    <tr class="text-center">
                        <td class="text-left">
                            <?php echo $aux2["mensagem"]; ?>
                        </td>
                        <td>
                            <?php echo $dataNot2; ?>
                        </td>
                        <td>
                            <?php
                                $sql3 = "SELECT id FROM usuario_projeto WHERE usuario_projeto.usuario_id = '$idUser' && usuario_projeto.projeto_id = '$idPro' LIMIT 1;";
                                $result3 = mysqli_query($conexao, $sql3) or die( mysqli_error($conexao));
                                $aux3 = mysqli_fetch_assoc($result3);

                                $tem = $aux3['id'];

                                if (!isset($tem)) {
                            ?>
                                <a href="cadastrar/aceitarCon.php?x=<?php echo $idNot64 ?>&&y=<?php echo $idPro64 ?>" title="Aceitar convite" data-toggle="tooltip">
                                    <i class="fa fa-check-circle"></i></i>
                                </a>
                                <a href="cadastrar/recusarCon.php?x=<?php echo $idNot64 ?>" title="Recusar convite" data-toggle="tooltip">
                                    <i class="fa fa-times-circle"></i></i>
                                </a>
                            <?php } else { ?>
                                <a href="cadastrar/aceitarPed.php?x=<?php echo $idNot64 ?>&&y=<?php echo $idPro64 ?>" title="Aceitar pedido" data-toggle="tooltip">
                                    <i class="fa fa-check-circle"></i></i>
                                </a>
                                <a href="cadastrar/recusarPed.php?x=<?php echo $idNot64 ?>" title="Recusar pedido" data-toggle="tooltip">
                                    <i class="fa fa-times-circle"></i></i>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
        
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
