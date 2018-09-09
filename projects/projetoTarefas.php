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
    <title>Tarefas do projeto</title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">
        <!--    Menu de navegação   -->
        <?php include 'menuVerPro.php' ?>


        <div class="row mt-1">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Não Iniciada</h5>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item text-center">
                                        <a href="#" class="delete" title="Adicionar Tarefa" data-toggle="tooltip">
                                            <i class="fa fa-plus fa-lg" style="color: #a0a5b1"></i>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Iniciada</h5>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Teste</h5>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Feita</h5>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Pendente</h5>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" class="text-center text-muted" style="text-decoration: none">Titulo da tarefa</a>
                                    </li>
                                </ul>
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
