<?php
	if(!isset($_SESSION)) session_start();
	require_once("assets/config/conexao.php");
	require_once("enviar-email.php");

    include("protected.php");
    proteger();
    anti_adm();


	if(isset($_SESSION["paginaAtual"]) && isset($_GET['matricula'])){
		
	    $matricula = $_GET['matricula'];
     	$deletarAluno = $con->prepare("DELETE FROM tb_usuarios WHERE matricula = ?");

		$deletarAluno->bindParam(1, $matricula);

		if($deletarAluno->execute()){	
			echo "<script>alert('Aluno deletado com sucesso')</script>";
			$paginaVoltar = $_SESSION['paginaAtual'];
			unset($_SESSION['paginaAtual']);
			Header("Location: ".$paginaVoltar);
		}
     }

?>