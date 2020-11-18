<?php
$name=$_POST["name"];
$password=$_POST["psw"];
$email=$_POST["email"];
$cellno=$_POST["cn"];
$user = 'root';
$pass='';
$db='abburi';
$sn="localhost";
$conn = new mysqli($sn, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_email = "SELECT * FROM usercred WHERE emailid='$email'";
$res_e = mysqli_query($conn, $sql_email);
if(mysqli_num_rows($res_e) > 0){
  	  echo "Sorry... Email already exists"; 	
  	}


else{
$sql = "INSERT INTO usercred (username,emailid,password,cellno)
VALUES ('$name', '$email', '$password','$cellno')";

if ($conn->query($sql) === TRUE) {
    echo "We registered you! Please login.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}	

$conn->close();
?>