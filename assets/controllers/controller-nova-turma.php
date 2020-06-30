<?php 
	require_once("assets/config/conexao.php");
	header("Content-type: text/html; charset=utf-8");

	session_start();
	if(isset($_POST['cadastrar'])){
		$nomeTurma = isset($_POST['nome_turma']) ? $_POST['nome_turma'] : '';
		echo "<script>alert($nomeTurma);</script>";
		if(empty($nomeTurma)){
			$_SESSION['mensagem'] = '<div class="mensagem error">Digite o nome da turma</div>';
			header("Location: nova-turma.php");
			exit();
		}

		$query = $con->prepare("INSERT INTO tb_turmas(nome) VALUES(?)");
		$query->bindParam(1, $nomeTurma);
		if($query->execute()){
			$_SESSION['mensagem'] = '<div class="mensagem sucesso">A turma foi cadastrada com sucesso</div>';
			header("Location: nova-turma.php");
			exit();
		}
	}

?>