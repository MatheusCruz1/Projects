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
    <title>Criar projeto</title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">

        <!--    Menu de navegação   -->
        <?php include 'menuProOn.php' ?>



        <div class="row mt-1 mb-0 pb-0">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-wrapper my-0 py-0">
                            <table class="table">
                                <tbody>
                                    <form method="post" action="cadastrar/cadastrarProjeto.php">
                                        <tr class="text-center">
                                            <td class="text-left" style="border:none">
                                                <label for="nome">Nome do Projeto:</label>
                                                <input class="form-control form-control-sm" id="nome" type="text" placeholder="Nome do Projeto" name="nome" maxlength="42">
                                            </td>

                                            <td class="text-left" style="border:none; width: 50%">
                                                <label for="max">Limite de Participantes:</label>
                                                <select class="form-control form-control-sm" id="max" name="max">
                                                    <option selected>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </td>
                                            <td class="text-left" style="border:none" hidden>
                                                <!-- numero atual de participantes -->
                                                <input class="form-control form-control-sm" type="number" name="atual" value="1">
                                                <input class="form-control form-control-sm" type="number" name="status" value="1">
                                            </td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="text-left" style="border:none; width: 50%" colspan="2">
                                                <label for="textarea">Descrição:</label>
                                                <div class="form-group">
                                                    <textarea class="form-control" id="textarea" rows="3" name="descricao" style="resize: none; height: 250px" maxlength="1024"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="text-center">
                                            <td class="text-left" style="border:none" colspan="2">
                                                <div class="text-center">
                                                    <button type="submi" class="btn" id="btn-alt-ver">Criar Projeto</button>
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

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
</body>

</html>
