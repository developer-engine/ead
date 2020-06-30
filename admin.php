
<?php 
    include("protected.php");
    proteger();
    anti_adm();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EAD - Padre João Bosco Lima</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <script type="text/javascript" src="assets/js/jquery.js"></script>

        <script type="text/javascript" src="assets/js/funcoes.js"></script>

    </head>

    <body>
        <?php include("header.php"); ?>
        <div class="content-wrapper">
            <div class="title-content">
                <div class="img-content">
                    <img src="assets/img/admin.png" />
                </div>
                <h3 class="colorWhite"> ADMINISTRADOR</h3>
            </div>

            <div class="content">

                <a href="turmas.php" class="link-item">
                    <div class="materia">
                        <div class="icon-materia fisica"><img src="assets/img/materias.png" class="icon-fisica"></div>
                        <span class="name-materia">GERENCIAR TURMAS</span>
                    </div>
                </a>


                <a href="#materia" class="link-item">
                    <div class="materia">
                        <div class="icon-materia fisica"><img src="assets/img/materias.png" class="icon-fisica"></div>
                        <span class="name-materia">GERENCIAR PROFESSORES</span>
                    </div>
                </a>


                <a href="#materia" class="link-item">
                    <div class="materia">
                        <div class="icon-materia fisica"><img src="assets/img/materias.png" class="icon-fisica"></div>
                        <span class="name-materia">GERENCIAR MATÉRIAS</span>
                    </div>
                </a>
                <a href="#materia" class="link-item">
                    <div class="materia">
                        <div class="icon-materia fisica"><img src="assets/img/definicao.png" class="icon-fisica"></div>
                        <span class="name-materia">DEFINIÇÃO</span>
                    </div>
                </a>                                                

            </div>

            <footer>
                <button id="topo">TOPO</button>
                <img src="assets/img/p.png" class="logo-escola" />
                <div class="txt">
                    <div class="">
                        Todos os direitos reservados | Rua José Jácome de Carvalho, S/N, Bela Vista, Mauriti-CE - CEP  063210-000
                    </div>
                    <div class="">
                        Copyright (c) 2020 EEEP Padre João Bosco Lima. <b>Desenvolvido com amor.</b>
                    </div>
                </div>
            </footer>  
        </div> 
    </body>

</html>
