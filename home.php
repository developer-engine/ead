<?php
    require_once("assets/config/conexao.php");

    session_start();

    if(isset($_SESSION['login'])){
        header("Location: materias.php");
    }


    if(isset($_POST['login-aluno'])){
        $matriculaAluno = isset($_POST['matricula_aluno']) ? $_POST['matricula_aluno'] : '';
        $senhaAluno = isset($_POST['senha_aluno']) ? sha1($_POST['senha_aluno']) : '';

        $query = $con->prepare("SELECT tb_usuarios.*, tb_turmas.nome_turma FROM tb_usuarios INNER JOIN tb_turmas ON tb_usuarios.id_turma  = tb_turmas.id WHERE matricula = ? AND senha = ?");
        $query->bindParam(1, $matriculaAluno);
        $query->bindParam(2, $senhaAluno);
        $query->execute();

        if($query->rowCount() > 0){
            $dadosAluno = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['matriculaAluno'] = $dadosAluno['matricula'];
            $_SESSION['nomeAluno'] = $dadosAluno['nome'];
            $_SESSION['nomeTurma'] = $dadosAluno['nome_turma'];
            $_SESSION['login'] = true;
            if(isset($_SESSION['mensagem_erro'])) unset($_SESSION['mensagem_erro']);
            Header("Location: materias.php");
        }else{
            $_SESSION['mensagem_erro'] = "Usuario não encontrado";
        }
    }


    if(isset($_POST['login-professor'])){
        $cpfProfessor = isset($_POST['cpf']) ? sha1($_POST['cpf']) : '';
        $senhaProfessor = isset($_POST["senha_professor"]) ? sha1($_POST['senha_professor']) : '';

        $query = $con->prepare("SELECT * FROM tb_professores WHERE CPF = ? AND senha = ?");
        $query->bindParam(1, $cpfProfessor);
        $query->bindParam(2, $senhaProfessor);
        $query->execute();

        if($query->rowCount() > 0){
            $dadosAluno = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['cpfProfessor'] = $dadosAluno['CPF'];
            $_SESSION['nomeProfessor'] = $dadosAluno['NOME'];
            $_SESSION['cargo'] = $dadosAluno['CARGO'];
            $_SESSION['login'] = true;
            if(isset($_SESSION['mensagem_erro'])) unset($_SESSION['mensagem_erro']);
            Header("Location: materias.php");
        }else{
            $_SESSION['mensagem_erro'] = "Usuario não encontrado";
        }


    }

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

        <?php 
            if(isset($_SESSION['mensagem_erro'])){
                echo "
                <script>
                    window.onload = function()
                    {
                        document.querySelector('.btn-acessar').click();
                    }
                </script>";
            }

            ?>

    </head>

    <body>
        <div id="content-side">
            <div class="header">
                <a href="#logo">
                    <div class="logo">
                        <img src="assets/img/logo.png">
                    </div>
                </a>

                <div class="header-left">
                    <button class="btn-acessar">
                        <img src="assets/img/chave.png" />
                        ACESSAR
                    </button>
                </div>
            </div>
        </div>


        <div id="login-modal">
            <div class="login-content">

                <div class="header-login">
                    <div class="title-header">
                        <img src="assets/img/lock.png">
                        <span class="txt">Área restrita</span>
                    </div>
                    
                </div>
                <div class="escolha">
                    <button class="btn-aluno btn-active">Aluno</button>
                    <button class="btn-professor">Professor</button>
                </div>

                <div class="content-form">
                    <div class="login-aluno login-form">
                        <form class="form-login" method="POST">
                            <input type="text" name="matricula_aluno" class="form-control" placeholder="Digite a sua matricula">
                            <input type="password" name="senha_aluno" class="form-control" placeholder="Digite a sua senha">
                            <button type="submit" class="form-control btn-login" name="login-aluno">FAZER LOGIN</button>

                            <a href="#">Esqueceu sua senha?</a>
                        </form>
                    </div>

                    <div class="login-professor login-form">
                        <form class="form-login" method="POST">
                            <input type="text" name="cpf" class="form-control" placeholder="Digite a seu CPF">
                            <input type="password" name="senha_professor" class="form-control" placeholder="Digite a sua senha">
                            <button type="submit" class="form-control btn-login" name="login-professor">FAZER LOGIN</button>

                            <a href="#">Esqueceu sua senha?</a>
                        </form>
                    </div>
                </div>


                <?php if(isset($_SESSION['mensagem_erro'])){ ?>
                <div class="mensagem_erro"><?php echo $_SESSION['mensagem_erro']; ?></div>
                <?php } ?>
                <div class="footer-login">

                    <img class="logo" src="assets/img/logo.png">
                </div>
            </div>
        </div>

        <div class="content-home">
            <div class="slider-bar">
                
               SLIDER BAR
            </div>


            <div class="content">
                CONTEUDO;
            </div>


            <footer>
                <button id="topo">TOPO</button>
                <img src="assets/img/p.png" class="logo-escola" />
                <div class="txt">
                    <div class="">
                        Todos os direitos reservados | Rua José Jácome de Carvalho, S/N, Bela Vista, Mauriti-CE - CEP  063210-000
                    </div>
                    <div class="">
                        Copyright (c) 2020 EEEP Padre João Bosco Lima. <b>Desenvolvido por Onofre Araújo.</b>
                    </div>
                </div>
            </footer>
        </div> 
    </body>

</html>
