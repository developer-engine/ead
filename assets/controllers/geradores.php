<!DOCTYPE html>
<html>
<head>
	<title>CADASTRO ALUNO</title>
</head>
<body>

	<form method="POST">
		<input name="matricula" value="<?php gerarMatricula(); ?>" disabled/>
		<input placeholder="Digite o nome do usuario" name="nome" />
		<select>
			<option>ESCOLA A TURMA</option>
		</select>

	</form>

</body>
</html>


<?php

	function gerarMatricula(){
		$random = rand(7, 7);
		$matricula = substr(str_shuffle("0123456789"), 0, $random);
		echo $matricula;	
	}
