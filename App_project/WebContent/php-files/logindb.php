<?php

$password=$_POST["pswd"];
$email=$_POST["email"];

$user = 'root';
$pass='';
$db='abburi';
$sn="localhost";
$conn = new mysqli($sn, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_chkem = "SELECT * FROM usercred WHERE emailid='$email'";
$res_chk = mysqli_query($conn, $sql_chkem);
if(mysqli_num_rows($res_chk) == 0){
  	  echo "User does not exists! Please Register"; 	
  	}
else{
$sql_email = "SELECT * FROM usercred WHERE emailid='$email' and password='$password' ";
$res_e = mysqli_query($conn, $sql_email);
if(mysqli_num_rows($res_e) > 0){
  	  echo "loginsuccess"; 	
  	}else{
	echo "Please check password!";
	}
}


$conn->close();
?>