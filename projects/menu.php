<?php
session_start();
?>

<!doctype html>
<html lang="pt-br">

<head>

</head>

<!--    
        Paleta de cores :
            azul claro:     #6495ED;
            azul escuro:    #345BA0;
            verde escuro:   #83A03C;
            verde claro:    #95BA3C;
            rosa:           #F08E7D;
        -->

        <body>
            <nav class="navbar navbar-expand-lg navbar-dark" id="navbar-menu">
                <div class="container">
                    <a href="index.php"><img src="imagens/logoTriangulo (1).png" style="height: 40px;"></a>
                    <a class="navbar-brand h1 mb-0 ml-1" id="navbar-brand-menu" href="index.php">Projects</a>

                    <!--    Botão de menu colapsavel    -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!--    Fim do botão de menu colapsavel    -->

                    <div class="collapse navbar-collapse" id="navbarSite">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php" id="menu-item">Início</a></li>

                            <!--    Dropdown de pesquisa    -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="menuPresquisar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">Pesquisar</a>

                                <div class="dropdown-menu" aria-labelledby="menuPesquisar">
                                    <a class="dropdown-item" href="pesquisarProjetoOff.php">Projetos</a>
                                    <a class="dropdown-item" href="pesquisarUsuarioOff.php">Usuarios</a>
                                </div>
                            </li>
                            <!--    Fim do dropdown de pesquisa    -->
                        </ul>

                        <!--    Dropdown da conta do usuario   -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Button trigger modal -->
                            <li class="nav-item"><a class="nav-link" href="#" id="menu-item" data-toggle="modal" data-target="#exampleModal">Entrar</a></li>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">

                                            <ul class="nav nav-tabs text-center" style="width: 100%">
                                                <li style="width: 44%">
                                                    <a href="#entrar" data-toggle="tab" style="text-decoration: none">Entrar</a>
                                                </li>
                                                <li style="width: 44%">
                                                    <a href="#cadastre-ser" data-toggle="tab" style="text-decoration: none">Cadastre-se</a>
                                                </li>
                                                <li class="text-right ml-4">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </li>
                                            </ul>

                                            <div id="myTabContent" class="tab-content mt-3">
                                                <div class="tab-pane active in" id="entrar">
                                                    <form id="tab" method="post" action="cadastrar/login.php">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Email:</label>
                                                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="exempli@email.com" name="email" maxlength="65">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Senha:</label>
                                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="senha"
                                                            maxlength="16" >
                                                        </div>
                                                        <div class="text-right">
                                                            <div class="btn-group" role="group" style="width: 100%">
                                                                <input type="button" class="btn btn-danger float-left" data-dismiss="modal" aria-label="Close" style="width: 100%" id="btn-cancel" onclick="resetTab()" value="Cancelar">
                                                                <button type="submit" class="btn btn-primary" id="btn-alt-ver" style="width: 100%">Entrar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane fade" id="cadastre-ser">
                                                    <form id="tab2" method="post" action="cadastrar/cadastrar.php">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Nome:</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nome Sobrenome" name="nome" maxlength="45">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleSelect">sexo:</label>
                                                            <select class="form-control" placeholder="Selecione" id="exampleSelect" name="sexo">
                                                                <option selected disabled>Selecione...</option>
                                                                <option>Feminino</option>
                                                                <option>Masculino</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Email:</label>
                                                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="exempli@email.com" name="email" maxlength="65">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Senha:</label>
                                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="senha"
                                                            maxlength="16" minlength="8">
                                                        </div>
                                                        <div class="text-right">
                                                            <div class="btn-group" role="group" style="width: 100%">
                                                                <input type="button" class="btn btn-danger float-left" data-dismiss="modal" aria-label="Close" style="width: 50%" id="btn-cancel" onclick="resetTab2()" value="Cancelar">
                                                                <button type="submit" class="btn btn-primary" id="btn-alt-ver" style="width: 50%">Cadastrar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </ul>
                        <!--    Fim do dropdown da conta do usuario   -->
                    </div>
                </div>
            </nav>

            <script>
                function resetTab() {
                    document.getElementById("tab").reset();
                }

                function resetTab2() {
                    document.getElementById("tab2").reset();
                }
            </script>
        </body>
        </html>