<?php
	require_once("config.php");
	require_once("class-Clockwork.php");
	require_once("class.phpmailer.php");
	include_once("class.utility.php");
	session_start();
	$f = new Faculty();
	Class Faculty{
	
		private $conn;
		private $faculty_name;
		private $faculty_email;
		function __construct(){
				
				$this->conn = mysqli_connect(db_server,db_user,db_password,db_database);
				$this->faculty_name = $this->getFacultyName();
		}
	
		function __destruct(){
				mysqli_close($this->conn);
		}
		
		
		
		private function getFacultyName(){
				
				$obj = new Utility();
				$fno = $_SESSION['user'];
				$selectSQL = "SELECT faculty_email, faculty_fname,faculty_mname,faculty_lname from tblFaculty WHERE faculty_number = '" .$fno. "'";
				$result = mysqli_query($this->conn,$selectSQL);
				$rs = mysqli_fetch_array($result);
				
				$name = $obj->getFullName($rs['faculty_fname'],$rs['faculty_mname'],$rs['faculty_lname']);
				$this->faculty_email = $rs['faculty_email'];
				return $name;
				
		}
		
		public function changePassword($old,$new){
				
				$obj = new Utility();
				if(empty($old) || empty($new)){
						$obj->msg("Input something.");
						return false;
				}
				
				if(strlen(trim($old)) <= 0 || strlen(trim($old)) <= 0){
						$obj->msg("Invalid input.");
						return false;
				}
				
				$old = $obj->cleanString($old);
				$new = $obj->cleanString($new);
				$old = $this->sanitize($old);
				$new = $this->sanitize($new);
				
				$fno = $_SESSION['user'];
				$type = $_SESSION['type'];

				if($type != 'FACULTY'){
					$obj->redirect("login.php");
				}
				
				
				$checkOldSQL = "SELECT account_password from tblAccount WHERE account_username = '" .$fno. "'";
				$updateSQL = "UPDATE tblAccount set account_password = '" .$new. "' WHERE account_username = '" .$fno. "'";
				
				$checkresult = mysqli_query($this->conn,$checkOldSQL);
				if(!$checkresult || mysqli_num_rows($checkresult) <= 0){
						$obj->msg("Incorrect old password input.");
						return false;
				}
				
				$updateresult = mysqli_query($this->conn,$updateSQL);
				
				if(!$updateresult){
						$obj->msg("Cannot change your password. Try again.");
						return false;
				}
				
				
				
				$obj->msg("Successfully changed your account password.");
		
				return true;
				
		}//change password
		
		
		public function changeEmail($new,$old){
				$obj = new Utility();
				
				if(empty($new) || empty($old)){
						$obj->msg("Input something.");
						return false;
				}
				
				if(strlen(trim($new)) <= 0 || strlen(trim($old)) <= 0){
						
						$obj->msg("Invalid input.");
						return false;
				}
				
				$new = $obj->cleanString($new); $old = $obj->cleanString($old);
				$new = $this->sanitize($new); $old = $this->sanitize($old);
				$fno = $_SESSION['user'];
				
				$checkEmail = "SELECT account_email FROM tblAccount WHERE account_username = '" .$fno. "'";
				$resultCheck = mysqli_query($this->conn,$checkEmail);
				if(!$resultCheck || mysqli_num_rows($resultCheck) <= 0 ){
						$obj->msg("Old e-mail address provided is not registered.");
						return false;
				}
				
				$updateAccount = "UPDATE tblAccount set account_email = '" .$new. "' WHERE account_username = '" .$fno. "'";
				$resultAccount = mysqli_query($this->conn,$updateAccount);
				
				if(!$resultAccount){
						$obj->msg("Cannot update your user account email.");
						return false;
				}
				
				$updateProfile = "UPDATE tblFaculty set faculty_email = '" .$new. "' WHERE faculty_number = '" .$fno. "'";
				$resultProfile = mysqli_query($this->conn,$updateProfile);
				
					if(!$resultProfile){
							$obj->msg("Cannot update your user account email.");
							return false;
						}
				
				$obj->msg("Successfully updated your e-mail account to records.");
				return true;
				
				
				
				
		}
		
		public function sendMessage($email,$number,$subject,$message){
				
				$obj = new Utility();
				
				if(empty($message) || strlen(trim($message)) <= 0){
						$obj->msg("Write something as a message.");
						return false;
				}
				
				if(isset($_POST['checkEmail']) && isset($_POST['checkSMS'])){
						
						$emailResult = $this->emailMessage($email,$message,$subject);
						$smsResult = $this->smsMessage($subject,$message,$number);
						
						if(!$emailResult){
								$obj->msg("Server cannot send your e-mail message.");
						}
						
						if(!$smsResult){
								$obj->msg("Server cannot send your SMS message.");
						}
						
						
						
				}
				
				else if(isset($_POST['checkEmail'])){
						$result = $this->emailMessage($email,$message,$subject);
						if(!$result){
							$obj->msg("Cannot send your e-mail message.");
							return false;
						} else {$obj->msg("Your e-mail message is sent."); return true;}
				}
				
				else if(isset($_POST['checkSMS'])){
						$result = $this->smsMessage($subject,$message,$number);
						if(!$result){
								$obj->msg("Cannot send your sms message.");
								return false;
					} else {$obj->msg("Your SMS message is sent."); return true;}
				}
				
				else{
						$obj->msg("Select a method of messaging.");
						return false;
				}
				
				
				
		}
		
		
		private function emailMessage($email,$message,$sub){
					
			$obj = new Utility();
			$mail = new PhpMailer;
			
			
			if(empty($email)){
				$obj->msg("Enter reciepient's email address.");
				return false;
			}
			
			if(strlen(trim($email)) <= 0){
				$obj->msg("Invalid email address.");
				return false;
			}
			
			
			
			$body = $message;
			
			$subject = $sub;
			$clientName = $email;
			$mail->SMTPDebug = 2;
			$mail->CharSet = 'utf-8';
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = 'tls://smtp.gmail.com:587';
			$mail->Port = 587;
			$mail->Username = "sjnhs.sis.system@gmail.com";
			$mail->Password = "sanjuannationalhighschool2016";
			$mail->SMTPSecure = 'tls';
			$mail->setFrom($this->faculty_email,$this->faculty_name." of SJNHS Faculty");
			$mail->addReplyTo($this->faculty_email, $this->faculty_name);
			$mail->Subject = $subject;
			$mail->AltBody = "An authenticated faculty email message.";
			$mail->Body = $body;
			$address = $email;
			$mail->AddAddress($address, $clientName);
					
			
			if(!$mail->Send()){
					return false;
			} else return true;

			
			}
		
		private function smsMessage($subject,$message,$to){
				
				$obj = new Utility();
				
			if(empty($to)){
				$obj->msg("Enter reciepient's mobile number.");
				return false;
			}
			
			if(strlen(trim($to)) <= 0){
				$obj->msg("Invalid number.");
				return false;
			}
				
				
				$option = array('ssl' => false);
				$from = $this->faculty_name." SJNHS FACULTY";
				$message = "Message Subject: \n".$subject."\n\n\n"."Message:"."\n".$message."\n\n"."From: ".$this->faculty_name;
				$api = "6fe8e8d87b53d21fe5a0a3bd53def2776cf6f0b0";
				$clockwork = new Clockwork($api,$option,$from);
				
				
				$send = array("to" => $to, "message" => $message);
				$result = $clockwork->send($send);
				
				if($result['success']){
						return true;
				}
				
				else{ 
				
					$obj->msg("Try using international format: 639 then the rest 9 digits.");
					return false;}
				
				
				
		}
		
		
	
		public function selectSubject(){
				
				$selectSQL = "SELECT subject_name, fs_id FROM tblfacultysubject WHERE faculty_number = '" .$_SESSION['user']. "'";
				$result = mysqli_query($this->conn,$selectSQL);
				while($rs = mysqli_fetch_array($result)){
						
						echo "<option value = ".$rs['fs_id'].">" .$rs['subject_name']. "</option>";	
				}
				
				
		}
	
	
	
		private function sanitize($str){
				
				if(function_exists("mysqli_real_escape_string")){
						$ret = mysqli_real_escape_string($this->conn,$str);
				} else $ret = addslashes($str);
				
				return $ret;
		}
	
	}//Class Faculty




?>