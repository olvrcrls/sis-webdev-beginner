<?php

	$obj = new Utility();
	Class Utility{
		public function redirect($url){
			header("Location: $url");
			die();
			}


		public function cleanString($str){
			
			$ret = trim($str);
			$ret = htmlentities($str);
			
			return $ret;
		}
		
		public function getFullName($fname,$mname,$lname){
			$name = $fname.' '.$mname.' '.$lname;
			return $name;
		}
		
		public function msg($msg){
			echo "<script>alert('$msg');</script>";
		}
		
		
		public function generatePassword($length = 8){
			
		  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-#@!$%^*(/\s";
		  $password = substr( str_shuffle( $chars ), 0, $length );
			
			return $password;
		}
	
	
		public function dateFormat($date){
			$datecreate = date_create($date);
			$ret = date_format($datecreate, "Y-m-d");
			return $ret;
		}
	}//class utility

?>