<?php

	if(!function_exists("proteger")){
		function proteger(){
			if(!isset($_SESSION)) session_start();
			if(!isset($_SESSION['login'])){
				header("Location: /ead/home.php");
			}
		}
	}

	if(!function_exists("anti_adm")){
		function anti_adm(){
			if(!isset($_SESSION['cargo']) && isset($_SESSION['admin']) != "PROFESSOR"){
				header("Location: home.php");
			}
		}
	}

	if(!function_exists("pagina_off")){
		function pagina_off(){
			header("Location: home.php");
		}
	}

	proteger();
?>