<?php 
    require_once("assets/controllers/controller-nova-turma.php");
    
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
                <h3 class="colorWhite">NOVA TURMA</h3>
            </div>

            <div class="content">     
                <form class="nova-turma" method="POST">
                    <label>CADASTRAR TURMA</label>
                    <input type="text" placeholder="Digite o nome da turma" name="nome_turma" class="form-control">
                    <button class="form-control bg-green" type="submit" name="cadastrar">CADASTRAR TURMA</button>


                    <?php
                        if(isset($_SESSION['mensagem'])){ 
                            echo $_SESSION['mensagem'];
                            unset($_SESSION['mensagem']);
                        }
                    ?> 
                </form>
            </div>

            <footer>
                <button id="topo">TOPO</button>
                <img src="assets/img/p.png" class="logo-escola" />
                <div class="txt">
                    <div class="">
                        Todos os direitos reservados | Rua José Jácome de Carvalho, S/N, Bela Vista, Mauriti-CE - CEP  063210-000
                    </div>
                    <div class="">
                        Copyright (c) 2020 EEEP Padre João Bosco Lima. <b>Desenvolvido com Amor.</b>
                    </div>
                </div>
            </footer>  
        </div> 
    </body>

</html>
