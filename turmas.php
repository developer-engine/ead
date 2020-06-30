<?php
    require_once("assets/config/conexao.php");
    require_once("assets/controllers/controller-turma.php");

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
                <h3 class="colorWhite">GERENCIAR TURMAS</h3>
            </div>

            <div class="content">

                <?php 
                    while($item = $query->fetch(PDO::FETCH_ASSOC)){
                ?>
                <a href="gerenciar-turma.php?id=<?php echo $item['id'] ?>" class="link-item">
                    <div class="materia">
                        <div class="icon-materia fisica"><img src="assets/img/definicao.png" class="icon-fisica"></div>
                        <span class="name-materia"><?php echo $item['nome_turma'] ?></span>
                    </div>
                </a>   
                <?php } ?>            

                <a href="nova-turma.php" class="link-item">
                    <div class="materia">
                        <div class="icon-materia fisica bg-verde"><img src="assets/img/definicao.png" class="icon-fisica"></div>
                        <span class="name-materia">NOVA TURMA</span>
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
                        Copyright (c) 2020 EEEP Padre João Bosco Lima. <b>Desenvolvido com Amor.</b>
                    </div>
                </div>
            </footer>  
        </div> 
    </body>

</html>
