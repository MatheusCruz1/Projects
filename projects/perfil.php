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
    <title><?php echo $aux['nome_usuario'] ?></title>
</head>

<body>
    <!--    Menu de navegação   -->
    <?php include 'menuLogado.php' ?>

    <div class="container">
        <!--    Menu perfil   -->
        <?php include 'menuPerfil.php' ?>

        <table class="mb-5 ml-1" style="width: 100%">
            <form method="post" action="cadastrar/alterarUsuario.php">
                <tr>
                    <td>
                        <h5 class="ml-3 mt-3">Nome: </h5>
                        <input type="text" class="form-control form-control-sm" name="nome" maxlength="45" style="width: 86%" value="<?php echo $aux['nome_usuario']; ?>">
                    </td>
                    <td>
                        <h5 class="ml-3 mt-3">Sexo: </h5>
                        <?php if ($aux['sexo'] == 'Feminino') {?>
                            <select class="form-control form-control-sm" name="sexo" style="width: 86%">
                                <option selected>Feminino</option>
                                <option>Masculino</option>
                            </select>
                        <?php } ?>
                        <?php if ($aux['sexo'] == 'Masculino') {?>
                            <select class="form-control form-control-sm" name="sexo" style="width: 86%">
                                <option>Feminino</option>
                                <option selected>Masculino</option>
                            </select>
                        <?php } ?>
                    </td>
                    <td>
                        <h5 class="ml-3 mt-3">E-mail: </h5>
                        <input type="email" class="form-control form-control-sm" name="email" maxlength="65" value="<?php echo $aux["email"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="text-center pt-4" colspan="3" style="border: none">
                        <div>
                            <button type="submi" class="btn btn-primary" id="btn-alt-ver">Alterar Dados</button>
                        </div>
                    </td>
                </tr>
            </form>
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
