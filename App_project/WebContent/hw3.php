<?php
if (isset($_POST['test'])) {
    testfun();
}

function testfun()
{
    echo "hello praveen";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CS 5130 HW 3</title>
</head>
<body>
	<h1>Feedback Form</h1>
	<p>Please fill out this form to help us improve our site.</p>




	<form method="post">
		<input type="submit" name="test" id="test" value="RUN" />
	</form>

</body>
</html>



