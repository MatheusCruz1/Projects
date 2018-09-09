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
    <title>Projects</title>
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
            <!--    Menu de navegação   -->
            <?php include 'menu.php' ?>

            <!--    Carousel    -->
            <div id="carouselTelaInicio" class="carousel slide" data-ride="carousel">
                <!--    Indicadores -->
                <ol class="carousel-indicators">
                    <li data-target="#carouselTelaInicio" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselTelaInicio" data-slide-to="1"></li>
                    <li data-target="#carouselTelaInicio" data-slide-to="2"></li>
                </ol>
                <!--    Fim dos indicadores -->

                <!--    Itens -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="img-fluid d-block" src="imagens/carousel/slide5 (2).jpg" alt="First slide">

                        <div class="carousel-caption d-none d-md-block text-dark">
                            <h1>Gerencie seus Projetos!</h1>
                            <p class="lead" id="p-carousel">Tenha todos seus projetos organizados e catalogados para fácil acesso e leitura!</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="img-fluid d-block" src="imagens/carousel/slide2.jpg" alt="Second slide">

                        <div class="carousel-caption d-none d-md-block text-dark">
                            <h1>Encontre ajuda para seus projetos!</h1>
                            <p class="lead" id="p-carousel">Busque pessoas para participar do seu projeto e então finalizá-lo!</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="img-fluid d-block" src="imagens/carousel/slide3.jpg" alt="Third slide">

                        <div class="carousel-caption d-none d-md-block text-dark">
                            <h1>Gerencie seus Projetos!</h1>
                            <p class="lead" id="p-carousel">Tenha todos seus projetos organizados para fácil acesso e leitura!</p>
                        </div>
                    </div>
                </div>
                <!--    Fim dos itens  -->

                <!--    Botões de para mudar o slide    -->
                <a class="carousel-control-prev" href="#carouselTelaInicio" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselTelaInicio" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Proximo</span>
                </a>
                <!--    Botões de para mudar o slide    -->
            </div>
            <!--    Fim do carousel    -->

            <div class="container">
                <div class="row">
                    <div class="col-12 text-center my-1">
                        <img src="imagens/logoProjects (1).png" style="max-width: 100%; height: 76px;">
                        <p>A resposta para todos que buscam um lugar seguro para gerenciar seus projetos.</p>
                    </div>
                </div>

                <div class="row mb-5">

                    <div class="col-sm-6 col-md-3 mb-3">

                        <nav id="navbarVertical" class="navbar navbar-light bg-light">

                            <nav class="nav nav-pills flex-column">

                                <a class="nav-link" href="#item1" id="nav-pills-1">Quem somos</a>

                                <nav class="nav nav-pills flex-column">

                                    <a class="nav-link ml-3" href="#item1-1" id="nav-pills-1">Nossa missão</a>

                                    <a class="nav-link ml-3" href="#item1-2" id="nav-pills-1">Nossos objetivos</a>

                                </nav>

                                <a class="nav-link my-2" href="#item2" id="nav-pills-1">Por que gerenciar projetos?</a>

                                <a class="nav-link my-2" href="#item3" id="nav-pills-1">Empresas, busquem seus profissionais aqui!</a>

                                <nav class="nav nav-pills flex-column">

                                    <a class="nav-link ml-3" href="#item3-1" id="nav-pills-1">Segurança</a>

                                    <a class="nav-link ml-3" href="#item3-2" id="nav-pills-1">Fale conosco</a>

                                </nav>

                            </nav>

                        </nav>

                    </div>

                    <div class="col-sm-6 col-md-9" style="background-color: #f8f8f8; max-height: 330px">

                        <div data-spy="scroll" data-target="#navbarVertical" data-offset="0" class="scrolspySite mt-2">

                            <h4 id="item1">Quem somos</h4>
                            <p>Somos profissionais assim como vocês, nossos clientes. E buscamos dar a vocês a chance de pôr em ordem os frutos do seu trabalho, bem como lhes dar a chance de oferecer contato com outros profissionais que busquem terminar seus projetos. Somos InProjects, e estamos aqui para ajudar a organizar sua vida profissional.</p>

                            <h5 id="item1-1">Nossa missão</h5>
                            <p>É ser a ponte entre profissionais que busquem concretizar projetos, bem como o índice no qual tais profissionais possam organizar seus projetos.</p>

                            <h5 id="item1-2">Nossos objetivos</h5>
                            <p>Proporcionar um ambiente seguro para depósito de informações sobre projetos e profissionais; Promover contato entre profissionais em prol do fim de um projeto.</p>

                            <h4 id="item2">Por que gerenciar projetos?</h4>
                            <p>Muitas vezes o profissional possui muito trabalho acumulado em seu computador pessoal e pouco espaço para manter armazenamento coeso e atualizado. A partir disso, torna-se necessário uma outra forma de organização de projetos para que o profissional seja capaz de aliviar o peso de dados em sua máquina. O gerenciamento garante ordem, facilidade de busca e entendimento de todo o material estudado e criado pelo profissional.</p>

                            <h4 id="item3">Empresas, busquem seus profissionais aqui!</h4>
                            <p>Sabemos o quanto é difícil para o setor de RH de uma empresa realizar seleções para vagas de emprego. Por que não facilitar este processo indo atrás de pessoas que se encaixem no perfil que a empresa busca ao invés de esperar que elas cheguem? Vejam os profissionais cadastrados em nosso site, talvez aqui encontrem o que só encontrariam em uma seleção de emprego!<br>
                            Em uma época como agora, nada mais natural para o usuário de internet seja móvel seja banda larga se preocupar com a segurança de seus dados. É necessário olho aberto e vigilância constante quando colocar seus dados pessoais na internet. Aqui nós priorizamos sua tranquilidade, garantindo segurança para seus dados e proteção de informações.</p>

                            <h5 id="item3-1">Segurança</h5>
                            <p>Em uma época como agora, nada mais natural para o usuário de internet seja móvel seja banda larga se preocupar com a segurança de seus dados. É necessário olho aberto e vigilância constante quando colocar seus dados pessoais na internet. Aqui nós priorizamos sua tranquilidade, garantindo segurança para seus dados e proteção de informações.<br>
                            Em uma época como agora, nada mais natural para o usuário de internet seja móvel seja banda larga se preocupar com a segurança de seus dados. É necessário olho aberto e vigilância constante quando colocar seus dados pessoais na internet. Aqui nós priorizamos sua tranquilidade, garantindo segurança para seus dados e proteção de informações.</p>

                            <h5 id="item3-2">Fale conosco</h5>
                            <p>Dúvidas? Nos contacte! vtr.fariasqi@gmail.com / mcmatheuskx@gmail.com<br>
                            Em uma época como agora, nada mais natural para o usuário de internet seja móvel seja banda larga se preocupar com a segurança de seus dados. É necessário olho aberto e vigilância constante quando colocar seus dados pessoais na internet. Aqui nós priorizamos sua tranquilidade, garantindo segurança para seus dados e proteção de informações.</p>

                        </div>

                    </div>

                </div>
            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="node_modules/jquery/dist/jquery.js"></script>
            <script src="node_modules/popper.js/dist/umd/popper.js"></script>
            <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
        </body>

        </html>
