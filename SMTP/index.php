<?php
include('smtp/PHPMailerAutoload.php');
$html='hello how are you ?';
echo smtp_mailer('abulqasimansari842@gmail.com','Contact us',$html);
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "abulqasimansari@gmail.com";
	$mail->Password = "@pass1234word$";
	$mail->SetFrom("abulqasimansari842@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress("abulqasimansari842@gmail.com");
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}
?>