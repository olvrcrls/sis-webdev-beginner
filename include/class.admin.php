<?php
	include_once('class.utility.php');
	require('config.php');
	$a = new Admin();
	Class Admin{
		private $conn;
		private $type;
		
		function __construct(){
			$obj = new Utility();
			$this->conn = mysqli_connect(db_server,db_user,db_password,db_database);
			$this->type = 'ADMINISTRATOR';
			if(!$this->checkDatabase($_SESSION['id'])){
				$obj->redirect('login.php');
			}
		}
		
		function __destruct(){
			
			mysqli_close($this->conn);
		}
		
		
		
		
		
		
		public function updateAccount($acct,$e,$p){
			$obj = new Utility();
			$e = $obj->cleanString($e);
			$p = $obj->cleanString($p);
			$acct = $obj->cleanString($acct);
			
			if(empty($acct)){
				$obj->msg('Please select an account user.');
				return false;
			}
			
			if(empty($e) && empty($p)){
				$obj->msg('No input to be update.');
				return false;
			}
			
			if(empty($e)){
				$updateSQL = "UPDATE tblAccount SET account_password = ? WHERE account_number = '" .$acct. "'";
			}
			
			if(empty($p)){
				$updateSQL = "UPDATE tblAccount SET account_email = ? WHERE account_number = '" .$acct. "'";
			}
			
			$email = $this->sanitize($e);
			$password = $this->sanitize($p);
			$acct = $this->sanitize($acct);
			
			$stmt = mysqli_prepare($this->conn,$updateSQL);
			if(empty($e))
			mysqli_stmt_bind_param($stmt,'s',$password);
			
			else if(empty($p))
			mysqli_stmt_bind_param($stmt,'s',$email);
		
		
			if(!mysqli_stmt_execute($stmt)){
				$obj->msg('Cannot update user account.');
				mysqli_stmt_close($stmt);
				return false;
			}
			
			mysqli_stmt_close($stmt);
			return true;
		}

		
		public function addAccount($u,$e,$t){
			$obj = new Utility();
			if(empty($u) || empty($e) || empty($t)){
				$obj->msg('Fill in all fields.');
				return false;
			}
			$t = strtoupper($t);
			if($t != 'ADMINISTRATOR' && $t != 'STUDENT' &&
				$t != 'REGISTRAR' && $t != 'FACULTY'){
					$obj->msg('Invalid input.');
					echo $t;
					return false;
				}
			$username = $obj->cleanString($u);
			$email = $obj->cleanString($e);
			$type = $obj->cleanString($t);
			
			$username = $this->sanitize($username);
			$email = $this->sanitize($email);
			$password = $obj->generatePassword();
			$type = $this->sanitize($type);
			
			
			$prepareSQL = "INSERT INTO tblAccount(account_username,account_password,account_type,account_email)
							VALUES (?,?,?,?)";
			
			$stmt = mysqli_prepare($this->conn,$prepareSQL);
			mysqli_stmt_bind_param($stmt,'ssss',$username,$password,$type,$email);
			if(!mysqli_stmt_execute($stmt)){
				$obj->msg('Cannot create user account.');
				mysqli_stmt_close($stmt);
				return false;
			}

			mysqli_stmt_close($stmt);
			
			return true;
		}
		
		
		private function checkDatabase($id){
			
			$sql = "SELECT account_number from tblAccount WHERE account_number = '" .$_SESSION['id'] . "'";
			$result = mysqli_query($this->conn,$sql);	
			if(!$result || mysqli_num_rows($result) < 0){
				return false;
			}
			else
			return true;
		}
	
	
		private function sanitize($str){
			
			if(function_exists("mysqli_real_escape_string")){
				$ret = mysqli_real_escape_string($this->conn,$str);
			} else $ret = addslashes($str);
			
			
			return $ret;
		}
		
		
	
	
		public function selectAccount(){
			$selectSQL = "SELECT account_number, account_username FROM tblAccount";
			$result = mysqli_query($this->conn,$selectSQL);
			while($rs = mysqli_fetch_array($result)){
				
				echo "
						<option value = " .$rs['account_number']. ">(user" .$rs['account_number']. ") " .$rs['account_username']. "</option>
					";
			}
		}
	
	
		public function getLogs(){
			$sqlSelect = "SELECT * from tblLog";
			$result = mysqli_query($this->conn,$sqlSelect);
			while($rs = mysqli_fetch_array($result)){
				echo "<tr>
						<td> ".$rs['log_number']." </td>
						<td> ".$rs['log_user']." </td>
						<td> ".$rs['log_ip']." </td>
						<td> ".$rs['log_datetime']." </td>
						</tr>";
			}
		}
		
	}//class Admin


?>