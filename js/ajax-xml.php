<?php
include_once("./include/config_user.php");
header("Content-Type: text/xml");
echo "<?xml version = '1.0' encoding = 'UTF-8' standalone = 'yes' ?>";
echo "<response>";
  $account_number = $_GET['account_number'];
  if(!$objModel->dbConnection()){
    return null;
  }
  $sqlAccountNumber = "SELECT account_number FROM tblAccount";
  

echo "</repsponse>";
?>
