<?php

class GeradorMatricula{


	function gerar(){
		$random = rand(7, 7);
		$matricula = substr(str_shuffle("0123456789"), 0, $random);
		return $matricula;	
	}

	function gerarSenha(){
		$random = rand(7, 7);
		$senha = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzASDFGHJKL0123456789"), 0, $random);
		return $senha;
	}
}