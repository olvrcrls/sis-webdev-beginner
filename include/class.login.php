<?php

	require('config.php');
	require('init.php');
	require('class.phpmailer.php');
	include_once('class.utility.php');

	
	$l = new Log();
	Class Log{
	private $conn;
	private $user;
	private $pass;
	
		function __construct(){
			$this->conn = mysqli_connect(db_server,db_user,db_password,db_database);
			
		}
		function __destruct(){
			mysqli_close($this->conn);
		}
		
		
		
		private function sanitize($str){
			if(function_exists("mysqli_real_escape_string")){
				$ret = mysqli_real_escape_string($this->conn,$str);
			} else $ret = addslashes($str);
			
			return $ret;
		}
		
		public function Login($u,$p){
			$obj = new Utility();
			if(empty($u) || empty($p)){
				$obj->msg('Invalid input.');
				return false;
			}
			
			$this->user = $obj->cleanString($u);
			$this->pass = $obj->cleanString($p);
			$this->user = $this->sanitize($this->user);
			$this->pass = $this->sanitize($this->pass);
			
			if(!$this->dbLogin()){
				$obj->msg('Incorrect username or password.');
				return false;
			}
			$this->saveLog();
			return true;
		}
		
		
		public function requestPassword($e,$t,$u){
			$obj = new Utility();
			$t = strtoupper($t);
			if(!$this->checkEmailDb($e,$t,$u)){
				return false;
			}
			
			$mail = new PhpMailer;
			
			$sql = "SELECT account_password FROM tblAccount WHERE account_email = '" .$e. "'";
			$result = mysqli_query($this->conn,$sql);
			while($rs = mysqli_fetch_array($result)){
			$password = $rs['account_password'];
			}
			
			$body = "Hello! We have received your password retrieval request.<br/>
					Upon receiving this message gives verification that
					your email is for an authenticated SJNHS SIS account.<br/>
					For retrieval purposes, your password is '".$password."'<br/><br/>
					We recommend changing your password upon reconnecting to the system.
					And we also recommend upon deleting this email message after retrieval.

					<br/><br/><br/>Thank you for your time.<br/><br/><br/><br/>
					- SJNHS Development Team.";

				$subject = "SJNHS Account Password Retrieval";
				$clientName = $this->retrieve_email;
				$mail->SMTPDebug = 2;
    			$mail->CharSet = 'utf-8';
				$mail->isSMTP();
				$mail->SMTPAuth = true;
    			$mail->Host = 'tls://smtp.gmail.com:587';
    			$mail->Port = 587;
    			$mail->Username = "sjnhs.sis.system@gmail.com";
    			$mail->Password = "sanjuannationalhighschool2016";
    			$mail->SMTPSecure = 'tls';
    			$mail->setFrom("sjnhs.sis.system@gmail.com","San Juan National High School SIS Account Administrator");
    			$mail->addReplyTo('sjnhs.sis.system@gmail.com', 'SJNHS Admin');
    			$mail->Subject = $subject;
    			$mail->AltBody = "We have received your password retrieval request.<br/>
    												Your account password is '".$password."'";
    			$mail->Body = $body;
    			$address = $e;
    			$mail->AddAddress($address, $clientName);

          if(!$mail->Send()){
            $obj->msg("Cannot send password request to e-mail address.");
            return false;
          }
            else{
              $obj->msg('Password retrieval sent. Please check your email now.');
			  return true;
            }
		}
		
		private function checkEmailDb($e,$t,$u){
			$obj = new Utility();
			$t = strtoupper($t);
			$email = $obj->cleanString($e);
			$type = $obj->cleanString($t);
			$username = $obj->cleanString($u);
			$email = $this->sanitize($email);
			$type = $this->sanitize($username);
			$username = $this->sanitize($email);
			$sql = "SELECT account_email FROM tblAccount WHERE account_type = '" .$type. "' AND account_username = '" .$username. "'
			 AND account_email = '" .$email. "'";
			$result = mysqli_query($this->conn,$sql);
			$rs = mysqli_fetch_array($result);
			if(!$result || mysqli_num_rows($result) < 0 ){
				$obj->msg('Email account is not registered to given information.');
				return false;
			}
			
			return true;
			
		}
		
		
		private function dbLogin(){
			
			$sql = "SELECT account_number, account_username, account_type FROM tblAccount WHERE account_username = '" .$this->user. "' AND account_password = '" .$this->pass. "'";
			$result = mysqli_query($this->conn,$sql);
			if(!$result || mysqli_num_rows($result) <= 0){
				return false;
			}
			$rs = mysqli_fetch_array($result);
			
			if(!$_SESSION){
				session_start();
			}
			
			
			$_SESSION['id'] = $rs['account_number'];
			$_SESSION['type'] = $rs['account_type'];
			$_SESSION['user'] = $rs['account_username'];
			$_SESSION['log'] = true;
			
			
			return true;
		}
			
			
			
		private function saveLog(){
			$ip = $_SERVER['REMOTE_ADDR'];
			$sqlInsert = "INSERT INTO tblLog(log_user,log_ip) VALUES (?,?)";
			$stmt = mysqli_prepare($this->conn,$sqlInsert);
			mysqli_stmt_bind_param($stmt,'ss',$this->user,$ip);
			mysqli_stmt_execute($stmt);
			mysqli_close($stmt);
		}
	}//class log
?>