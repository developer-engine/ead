<?php 
	require_once("assets/config/conexao.php");
	require_once("assets/classes/geradorMatricula.php");
	require_once("enviar-email.php");

    include("protected.php");
    proteger();
    anti_adm();

	$email = new Email();

	#REQUIRES DO PHPMAILER



	$gerador = new GeradorMatricula();


	#RESETAR A URL CASO O USUARIO ENTRAR SEM ID
	if(!isset($_GET['id'])){
		$query = $con->prepare("SELECT id FROM tb_turmas WHERE id = (SELECT min(id) FROM tb_turmas)");
		$query->execute();
		$id = $query->fetch(PDO::FETCH_ASSOC);
		$location = "Location: gerenciar-turma.php?id=".$id['id'];
		header($location);
	}

	#PEGAR OS DADOS DA TURMA
	if(isset($_GET['id'])){
		$query = $con->prepare("SELECT * FROM tb_turmas WHERE id = ?");
		$query->bindParam(1, $_GET['id']);
		$query->execute();
		$dadosTurma = $query->fetch(PDO::FETCH_ASSOC);
	}


	#CADASTRADO DE NOVO ALUNO
	if(isset($_POST['btn_novoAluno'])){
		$nomeAluno = isset($_POST['nome_aluno']) ? $_POST['nome_aluno'] : '';
		$emailAluno = isset($_POST['email_aluno']) ? $_POST['email_aluno'] : '';

		if(empty($nomeAluno) || empty($emailAluno)){
			echo "<script>alert('preecha todos os campos');</script>";
			header("Refresh: 1;");
			$SESSION['novoAluno'] = true;
			return;
		}

		$permitido = false;
		$matriculaAluno = '';
		while(!$permitido){
			$matriculaAluno = $gerador->gerar();
			$verificar = $con->prepare("SELECT * FROM tb_usuarios WHERE matricula = ?");
			$verificar->bindParam(1, $matriculaAluno);
			$verificar->execute();
			if(!$verificar->rowCount() > 0){
				$permitido = true;
			}
		}

		$senhaAluno = $gerador->gerarSenha();

		$novoAluno = $con->prepare("INSERT INTO tb_usuarios(matricula, nome, senha, email, id_turma, aluno, professor, admin) VALUES(?, ?, ?, ?, ?, true, false, false)");

		$senhaHash = sha1($senhaAluno);
		$novoAluno->bindParam(1, $matriculaAluno);
		$novoAluno->bindParam(2, $nomeAluno);
		$novoAluno->bindParam(3, $senhaHash);
		$novoAluno->bindParam(4, $emailAluno);
		$novoAluno->bindParam(5, $dadosTurma['id']);

		if($novoAluno->execute()){
			$mensagem = "
				<center><h1>EAD - Padre João Bosco Lima</h1></center>
				<div>Olá {$nomeAluno}, seja bem vindo a nossa plataforma de ensino a distância, espero que você aproveite o máximo dessa tecnologia.</div>
				<h3>Aqui estão os seus dados para acessar a plataforma</h3>
				<b>Matricula:</b> {$matriculaAluno}<br>
				<b>Senha:</b> {$senhaAluno}<br>

				<b>Link para o site:</b> <a href='https://ead-pjbl.herokuapp.com/'>Clique aqui</a><br>
				<span>Tenha um bom proveito. Bons Estudos</span>
			";
			$email->enviarEmail($emailAluno, "EAD Padre João Bosco Lima - Dados de Acesso", $mensagem);
			echo "<script>alert('Aluno cadastrado com sucesso'); </script>";
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
                <h3 class="colorWhite">GERENCIAR TURMA - <?php echo $dadosTurma['nome_turma']?></h3>
            </div>

            <div class="content">

            	<?php  if(isset($_GET['menu']) && $_GET['menu'] == 'alunos') {?>
            	<div class="content-alunos">
            		<div id="novo-aluno">
            			<h1>NOVO ALUNO</h1>
        				<form method="POST">
        					<input type="text" name="nome_aluno" class="form-control" placeholder="Digite o nome do aluno" />
        					<input type="email" name="email_aluno" class="form-control" placeholder="Digite o email do aluno">
        					<button type="submit" name="btn_novoAluno" class="form-control btn-cadastrar">CADASTRAR ALUNO</button>
        				</form>
        			</div>

            		<?php 
   $sql = "SELECT tb_usuarios.*, tb_turmas.* FROM tb_usuarios INNER JOIN tb_turmas ON tb_usuarios.id_turma = tb_turmas.id WHERE id_turma = ? ORDER BY nome";
            			$query = $con->prepare($sql);
            			$query->bindParam(1, $dadosTurma['id']);
            			$query->execute();

            			$_SESSION['paginaAtual'] = $_SERVER['REQUEST_URI'];
            			$itens = $query->fetchAll(PDO::FETCH_ASSOC);
            			if(count($itens) > 0){
            		?>

            		<div class="wrapp">
	            		<div class="header">
	            		<button class="btn-aluno">Adicionar Aluno</button>

	  					<h1>LISTA DE ALUNOS</h1>
	  					</div>
	            		<table border="1px" cellspacing="0">
	            			<tr class="title">
	            				<td width="12%">MATRICULA</td>
	            				<td >NOME</td>
	            				<td width="30%">EMAIL</td>
	            				<td>AÇÃO</td>
	            			</tr>
	            			<?php 
	            				foreach($itens as $item){
	            			?>
	            			<tr class="">
	            				<td align="center"><?php echo $item['matricula'] ?> </td>
	            				<td><?php echo $item['nome'] ?></td>
	            				<td><?php echo $item['email'] ?></td>
	            				<td align="center">
	            					<a href="editar.php?matricula=<?php echo $item['matricula'] ?>"><img src="assets/img/editar.png" height="5%"></a>
	            					|
	            					<a href="deletar.php?matricula=<?php echo $item['matricula'] ?>"><img src="assets/img/deletar.png" height="5%"></a>
	            				</td>
	            			</tr>
	            		<?php }
	            		
	            		?>
	            		</table>
            		</div>
            		<?php } else { ?>
            		<div class="wrapp">
	            		<div class="vazio">
	            			<div class="linha">AINDA NÃO HÁ ALUNOS CADASTRADOS</div>
	            			<button class="btn-aluno">ADICIONE UM NOVO ALUNO</button>
	            		</div>
	            	</div>
            		<?php } ?>
            	</div>


	            <?php } else if(isset($_GET['menu']) && $_GET['menu'] == 'pdt' ){ ?>
	            	AQUI VAI OS DO PDT
	            <?php } else{ ?>

	        	<a href="gerenciar-turma.php<?php echo '?id='.$dadosTurma['id'].'&menu=alunos'?>" class="link-item">
	                <div class="materia">
		                <div class="icon-materia fisica"><img src="assets/img/definicao.png" class="icon-fisica"></div>
		                <span class="name-materia">ALUNOS</span>
	                </div>
	             </a> 
	            
	            <a href="gerenciar-turma.php<?php echo '?id='.$dadosTurma['id'].'&menu=pdt'?>" class="link-item">
	            	<div class="materia">
		                <div class="icon-materia fisica"><img src="assets/img/definicao.png" class="icon-fisica"></div>
		                <span class="name-materia">PDT</span>
	                </div>
	            </a>

	        	<a href="gerenciar-turma.php<?php echo '?id='.$dadosTurma['id'].'&menu=pdt'?>" class="link-item">
	            	<div class="materia">
		                <div class="icon-materia fisica"><img src="assets/img/definicao.png" class="icon-fisica"></div>
		                <span class="name-materia">Editar Nome</span>
	                </div>
	            </a>   

	            <?php }?>
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
