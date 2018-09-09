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

    $idPro64 = $_GET["x"];
    $idPro = base64_decode("$idPro64");
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

    <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png">
    <title>Alterar dados do projeto</title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">
        <!--    Menu de navegação   -->
        <?php include 'menuVerPro.php' ?>

        <div class="row mt-1 mb-0 pb-0">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-wrapper my-0 py-0">
                            <table class="table">
                                <tbody>
                                    <form method="post" action="cadastrar/alterarProjeto.php">
                                        <tr class="text-center">
                                            <?php
                                                $sql = "SELECT id, nome_projeto, descricao, numero_atual_participantes, numero_max_participantes FROM projeto WHERE id = '$idPro' LIMIT 1";

                                                $result = mysqli_query($conexao, $sql) or die( mysqli_error($conexao));
                                                $aux = mysqli_fetch_assoc($result);
                                            ?>
                                            <td class="text-left" style="border:none; width: 50%">
                                                Nome do Projeto:
                                                <input class="form-control form-control-sm" name="nome" type="text" maxlength="42" value="<?php echo $aux['nome_projeto']; ?>">
                                                <input type="number" name="id" value="<?php echo $idPro ?>" hidden>
                                            </td>

                                            <td class="text-left" style="border:none; width: 50%">
                                                Limite de Participantes:
                                                <?php if ($aux['numero_max_participantes'] == 1) {?>
                                                    <select class="form-control form-control-sm" name="max">
                                                        <option selected>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                <?php } ?>
                                                <?php if ($aux['numero_max_participantes'] == 2) {?>
                                                    <select class="form-control form-control-sm" name="max">
                                                        <option>1</option>
                                                        <option selected>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                <?php } ?>
                                                <?php if ($aux['numero_max_participantes'] == 3) {?>
                                                    <select class="form-control form-control-sm" name="max">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option selected>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                <?php } ?>
                                                <?php if ($aux['numero_max_participantes'] == 4) {?>
                                                    <select class="form-control form-control-sm" name="max">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option selected>4</option>
                                                        <option>5</option>
                                                    </select>
                                                <?php } ?>
                                                <?php if ($aux['numero_max_participantes'] == 5) {?>
                                                    <select class="form-control form-control-sm" name="max">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option selected>5</option>
                                                    </select>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="text-left" style="border:none; width: 50%" colspan="2">
                                                Descrição:
                                                <div class="form-group">
                                                    <textarea class="form-control" name="descricao" style="resize: none; height: 250px" maxlength="1024"><?php echo $aux['descricao']; ?></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-center" colspan="2" style="border: none">
                                                <div>
                                                    <button type="submi" class="btn btn-primary" id="btn-alt-ver">Alterar Dados</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
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
