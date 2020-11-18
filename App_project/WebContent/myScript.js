$(document).ready(function() {
	$(function() {

		$("#footer").load("../footer.html");
	});
	$(function() {

		$("#footer").load("footer.html");
	});
	$('#signupbtn').click(function() {

		var result = signupValidate();
		if (result == true) {
			$.ajax({
				type : "POST",
				url : "php-files/signup.php",
				data : {
					name : $("#name").val(),
					email : $("#email").val(),
					psw : $("#psw").val(),
					cn : $("#cn").val()
				},
				success : function(result, status, xhr) {
					$("#message").html(result);

					$('#signupform')[0].reset();
				},
				error : function(xhr, status, error) {
					$("#message").html(error);
				}
			});
		}
		return false;
	});
	$('#loginbn').click(function() {
		var id = $("#eid").val()
		var result1 = loginValidate();
		if (result1 == true) {

			$.ajax({
				type : "POST",
				url : "php-files/logindb.php",
				data : {
					email : $("#eid").val(),
					pswd : $("#pswd").val()
				},
				success : function(result1, status, xhr) {

					// window.location.href = "welc.php"
					if (result1 == 'loginsuccess') {
						window.location.href = "php-files/welc.php?eid=" + id;

					} else {
						$("#loginmessage").html(result1);
					}

				},
				error : function(xhr, status, error) {
					$("#loginmessage").html(error);
				}
			});
		}
		return false;
	});

	function EmailValidate() {
		var numericExpression = /^\w.+@[a-zA-Z_-]+?\.[a-zA-Z]{2,3}$/;
		var elem = $("#email").val();
		if (elem.match(numericExpression))
			return true;
		else
			return false;
	}

	function signupValidate() {
		var errorMessage = "";

		if ($("#name").val() == '')
			errorMessage += " Enter your Name<br/>";

		if ($("#email").val() == '')
			errorMessage += " Enter your Email Address<br/>";
		else if (!(EmailValidate()))
			errorMessage += " Invalid Email Address<br/>";

		if ($("#psw").val() == '')
			errorMessage += " Password should not be empty<br/>";

		if ($("#cn").val() == '')
			errorMessage += " Enter your Contact Number<br/>";
		else if (!($("#cn").val().length == 10)) {
			errorMessage += " Please Enter Valid Contact number<br/>";
		}

		$("#message").html(errorMessage);
		if (errorMessage.length == 0)
			return true;
		else
			return false;
	}
	function logEmailValidate() {
		var numericExpression1 = /^\w.+@[a-zA-Z_-]+?\.[a-zA-Z]{2,3}$/;
		var elem1 = $("#eid").val();
		if (elem1.match(numericExpression1))
			return true;
		else
			return false;
	}
	function loginValidate() {
		var errorMessage1 = "";

		if ($("#eid").val() == '')
			errorMessage1 += " Enter your Email Address<br/>";
		else if (!(logEmailValidate()))
			errorMessage1 += " Invalid Email Address<br/>";
		if ($("#pswd").val() == '')
			errorMessage1 += " Password should not be empty<br/>";
		$("#loginmessage").html(errorMessage1);
		if (errorMessage1.length == 0)
			return true;
		else
			return false;
	}
});

function openNav() {
	document.getElementById("mySidenav").style.width = "500px";
}

function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
}

$('#paybtn').click(function() {

	alert("");
});
