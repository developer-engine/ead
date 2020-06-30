<?php
    if(!isset($_SESSION)) session_start();

?>

<div id="modal-logout">
    <div class="dialog-logout">
        <div class="header-logout"><h2>SAIR</h2></div>
        <hr>
        <div class="content">Você realmente deseja sair?</div>
        <div class="buttons">
            <a href="logout.php?token=<?php echo md5(session_id())?>" class="button confirm">CONFIRMAR</a>
            <a class="button negar">NEGAR</a>
        </div>
    </div>
</div>


<div id="content-side">
            <div class="header">
                <a href="#logo">
                    <div class="logo">
                        <img src="assets/img/logo.png">
                    </div>
                </a>

                <div class="header-left">
                   <div class="foto-perfil">
                    <img src="assets/img/perfil/eu.jpg" width="100%">
                   </div>
                    <div class="dados-perfil">
                        <div class="nome">
                            <?php

                                if(!isset($_SESSION['cargo'])){
                                    $n = explode(" ", $_SESSION['nomeAluno']);

                                    if(strlen($n[1]) < 4 && isset($n[2])){
                                        echo "$n[0] $n[1] $n[2]";
                                    }else{
                                        echo "$n[0] $n[1]";
                                    }
                                }else{
                                    $n = explode(" ", $_SESSION['nomeProfessor']);


                                    if(isset($n[1]) && strlen($n[1]) < 4 && isset($n[2])){
                                        echo "$n[0] $n[1] $n[2]";
                                    }
                                    else{
                                        if(isset($n[1])){
                                            echo "$n[0] $n[1]";
                                        }else{
                                            echo "$n[0]";
                                        }
                                    } 
                                }                       
                            ?>
                        </div>
                        <div class="turma">

                            <?php 

                            if(!isset($_SESSION['cargo'])){

                                echo $_SESSION['nomeTurma']; 
                            }else{
                                echo $_SESSION['cargo']; 
                            }

                            ?>
                                

                            </div>

                        <button class="btn-logout">SAIR</button>
                    </div>
                </div>
            </div>


            <div class="left-side">
                <div id="close">
                    <img src="assets/img/seta.png">
                </div>

                <div class="navegacao">
                    <form class="buscar">
                        <input type="text" placeholder="Buscar">
                        <button><img src="assets/img/busca.png"></button>
                    </form>
                    <ul class="menu">
                        <li>
                            <a href="materias.php">
                                <div class="img">
                                    <img src="assets/img/materias.png">
                                </div>
                                <span class="txt">MATÉRIAS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="img">
                                    <img src="assets/img/redacao.png">
                                </div>
                                <span class="txt">CORREÇÃO DE REDAÇÃO</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               <div class="img">
                                    <img src="assets/img/atividades.png">
                                </div>
                                <span class="txt">ATIVIDADES</span>
                            </a>
                        </li>
                        <li class="text-subtitle txt">
                            <span>EXPLORAR</span>   
                        </li>

                        <li>
                            <a href="#">
                                <div class="img">
                                    <img src="assets/img/bquestao.png">
                                </div>
                                <span class="txt">BANCO DE QUESTÕES</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <div class="img">
                                    <img src="assets/img/download.png">
                                </div>
                                <span class="txt">DOWNLOADS</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               <div class="img">
                                    <img src="assets/img/simulados.png">
                                </div>
                                <span class="txt">SIMULADOS</span>
                            </a>
                        </li>  
                        <?php 
                            if(isset($_SESSION['cargo']) && $_SESSION['cargo'] == "PROFESSOR"){
                        ?>
                        <li>
                            <a href="#">
                                <div class="img">
                                    <img src="assets/img/bquestao.png">
                                </div>
                                <span class="txt">AREA DO PROFESSOR</span>
                            </a>
                        </li>
                        <li>
                            <a href="admin.php">
                               <div class="img">
                                    <img src="assets/img/admin.png">
                                </div>
                                <span class="txt">ADMINISTRADOR</span>
                            </a>
                        </li> 
                        <?php }?>                                       
                    </ul>
                </div>
            </div>
        </div>
