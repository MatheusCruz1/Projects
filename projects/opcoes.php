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

    $idUser = $_SESSION['id2'] ;
    $idUser64 = base64_encode($idUser);
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
    <title>Opções</title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">
        <!--    Menu perfil   -->
        <?php include 'menuPerfil.php' ?>

        <table class="mb-5 ml-1" style="width: 100%">
            <form method="post" action="cadastrar/alterarSenha.php">
                <tr>
                    <td colspan="3">
                        <h5 class="mt-3" style="margin-left: 40%">Senha antiga: </h5>
                        <input type="password" class="form-control form-control-sm" name="senhaAntiga" style="width: 20%; margin-left: 40%" maxlength="16" minlength="8">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h5 class="mt-3" style="margin-left: 40%">Nova senha: </h5>
                        <input type="password" class="form-control form-control-sm" name="senhaNova" style="width: 20%; margin-left: 40%" maxlength="16" minlength="8">
                    </td>
                </tr>
                <tr>
                    <td class="text-center pt-4" colspan="3" style="border: none">
                        <div>
                            <button type="submi" class="btn btn-primary" id="btn-alt-ver" style="width: 20%">Alterar Senha</button>
                        </div>
                    </td>
                </tr>
            </form>
            <tr>
                <td class="text-center pt-4" colspan="3" style="border: none">
                    <div>
                        <button type="button" class="btn btn-danger" style="width: 20%" id="btn-cancel"
                            onclick="location.href='cadastrar/apagarConta.php?x=<?php echo $idUser64 ?>'">Apagar conta</button>
                    </div>
                </td>
            </tr>
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
