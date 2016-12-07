<?php
	require_once('../include/config.php');
	header("Content-type: text/xml");

	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$selectSQL = "SELECT account_number, account_username, account_password, account_email, account_type FROM tblAccount";
	$result = mysqli_query($conn,$selectSQL);
	
	echo "<response>";
		while($rs = mysqli_fetch_array($result)){
			echo "<account>";
				echo "<accountnumber>" .$rs['account_number']. "</accountnumber>";
				echo "<username>" .$rs['account_username']. "</username>";
				echo "<password>" .md5($rs['account_password']). "</password>";
				echo "<email>" .$rs['account_email']. "</email>";
				echo "<type>" .$rs['account_type']. "</type>";
			echo "</account>";
		}//while
	echo "</response>";
	
	mysqli_close($conn);
?>