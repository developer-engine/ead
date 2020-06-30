<?php
	if(!isset($_SESSION)) session_start();
	require_once("assets/config/conexao.php");
	require_once("enviar-email.php");

    include("protected.php");
    proteger();
    anti_adm();

	$email = new Email();

	$matriculaAluno = $_GET['matricula'];
	$query = $con->prepare("SELECT tb_usuarios.*, tb_turmas.nome_turma FROM tb_usuarios INNER JOIN tb_turmas ON tb_usuarios.id_turma  = tb_turmas.id WHERE matricula = ?");
    $query->bindParam(1, $matriculaAluno);
    $query->execute();


    if($query->rowCount() > 0){
        $dadosAluno = $query->fetch(PDO::FETCH_ASSOC);
        $nome = $dadosAluno['nome'];
        $email = $dadosAluno['email'];
        $matricula = $dadosAluno['matricula'];
     }


     if(isset($_POST['btn_atualizarAluno'])){
     	$nomeAtualizado = isset($_POST['nome_aluno']) ? $_POST['nome_aluno'] : '';
     	$emailAtualizado = isset($_POST['email_aluno']) ? $_POST['email_aluno'] : ' ';

     	$atualizarAluno = $con->prepare("UPDATE tb_usuarios SET nome = ?, email = ? WHERE matricula = ?");

		$atualizarAluno->bindParam(1, $nomeAtualizado);
		$atualizarAluno->bindParam(2, $emailAtualizado);
		$atualizarAluno->bindParam(3, $matricula);
		if($atualizarAluno->execute()){	
			echo "<script>alert('Aluno atualizado com sucesso')</script>";
			$paginaVoltar = $_SESSION['paginaAtual'];
			unset($_SESSION['paginaAtual']);
			Header("Location: ".$paginaVoltar);
			
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

    </head>

    <body>


        <?php include("header.php"); ?>

        <div class="content-wrapper">
            <div class="title-content">
                <div class="img-content">
                    <img src="assets/img/admin.png" />
                </div>
                <h3 class="colorWhite">EDITAR PERFIL ALUNO?></h3>
            </div>

            <div class="content">
            	<div class="content-alunos">
            		<div id="editar-aluno">
            			<h1>EDITAR ALUNO</h1>
        				<form method="POST">
        					<input type="text" name="matricula_aluno" class="form-control" value="<?php echo $matricula; ?>" disabled/>

        					<input type="text" name="nome_aluno" class="form-control" placeholder="Digite o nome do aluno" value="<?php echo $nome; ?>">

        					<input type="email" name="email_aluno" class="form-control" placeholder="Digite o email do aluno" value="<?php echo $email; ?>">

        					<button type="submit" name="btn_atualizarAluno" class="form-control btn-formAluno">ATUALIZAR</button>
        				</form>
        			</div>
            	</div>
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
                        <?php
                        echo $_SESSION['previous'];
                         ?>
                    </div>
                </div>
            </footer>  
        </div> 
    </body>

</html>
