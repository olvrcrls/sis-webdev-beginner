<?php

  require_once('class.phpmailer.php');

  $mailer = new Mailer();
  Class Mailer{

    function __construct(){
      $dbCon = mysqli_connect("localhost", "root", "", "dbppa");
    }
	


    public function sendMail($e,$message,$subject){
		$mail = new PhpMailer;
		
		if(empty($e)){
				$obj->msg("Enter reciepient's email address.");
				return false;
		}
		
		
		$body = $message;
		
		$subject = "Faculty Message";
		$clientName = $e;
		$mail->SMTPDebug = 2;
		$mail->CharSet = 'utf-8';
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = 'tls://smtp.gmail.com:587';
		$mail->Port = 587;
		$mail->Username = "sjnhs.sis.system@gmail.com";
		$mail->Password = "sanjuannationalhighschool2016";
		$mail->SMTPSecure = 'tls';
		$mail->setFrom("sjnhs.sis.system@gmail.com","PPA Administrator");
		$mail->addReplyTo('sjnhs.sis.system@gmail.com', 'PPA Admin');
		$mail->Subject = $subject;
		$mail->AltBody = "This is the official news letter from PPA ";
		$mail->Body = $body;
		$address = $e;
		$mail->AddAddress($address, $clientName);
		
		if(!$mail->Send()){
            echo "NOT SENT";
            
		}
		else{
			echo "SENT";
			
            
		}


	}
  }//class mailer

?>
