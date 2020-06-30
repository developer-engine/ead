<?php
	
	$query = $con->prepare("SELECT * FROM tb_turmas");
	$query->execute();

?>