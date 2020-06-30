<?php

	require_once("assets/src/PHPMailer.php");
	require_once("assets/src/SMTP.php");
	require_once("assets/src/Exception.php");

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

Class Email{

	function enviarEmail($emailTo, $title, $corpo){
		$emailMailer = new PHPMailer();
		try{
			$emailMailer->isSMTP();
			$emailMailer->Host = 'smtp.gmail.com';
			$emailMailer->SMTPAuth = true;
			$emailMailer->Username = "sistemaead2020@gmail.com";
			$emailMailer->Password = 'sistema2020';
			$emailMailer->Port = 587;


			$emailMailer->setFrom('sistemaead2020@gmail.com');
			$emailMailer->addAddress($emailTo);
			
			$emailMailer->isHTML(true);
			$emailMailer->CharSet = 'UTF-8';
			$emailMailer->Subject = $title;
			$emailMailer->Body = $corpo;
			$emailMailer->send();
		}catch(Exception $e){
			echo "Erro ao enviar mensagem: {$emailMailer->ErrorInfo}";
		}
	}
}