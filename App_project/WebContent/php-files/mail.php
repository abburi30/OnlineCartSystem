<html>
<head>
<link rel="stylesheet" type="text/css"
	href="../style-sheet/payment-style.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="../myScript.js"></script>
<link rel="stylesheet" type="text/css"
	href="../style-sheet/htmlfooter.css" />
<style>
img {
	margin-left: 400px;
	margin-top: 100px;
}

h3 {
	font-family: cursive;
	color: #c91043;
	margin-left: 600px;
}
</style>
</head>
<body>


	<div id="page-container">
		<div id="content-wrap">
			<a href="logout.php" id="logoutbtn1"><img src="../images/signout.jpg"
				alt="logout" /></a>
<?php
session_start();
$mailto = $_GET["eid"];
$mailSub = "Order Review!";
$mailMsg = "Payment is processed. Items will be recieved mean while. \n <h3>Thank you for shopping with us.</h3>";
require '../PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->IsSmtp();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "abburi30@gmail.com";
$mail->Password = "";
$mail->SetFrom("abburi30@gmail.com");
$mail->Subject = $mailSub;
$mail->Body = $mailMsg;
$mail->AddAddress($mailto);

if (! $mail->Send()) {
    echo "Mail Not Sent";
} else {
    echo '<img id="tq" src="../images/thankyou.png" />';
    echo '<h4>Please check Your mail for Invoice</h4>';
}
?>
  </div>
		<div id="payment-fot">
			<footer id="footer"></footer>
		</div>

	</div>
</body>
</html>