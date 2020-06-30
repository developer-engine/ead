<?php

require_once("enviar-email.php");

$email = new Email();

$email->enviarEmail("onofresimiao.arauj@gmail.com", "EAD Padre João Bosco Lima - Dados de Acesso", "teste");
