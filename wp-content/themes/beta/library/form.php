<?php session_start(); ?>

<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
</head>

<style type="text/css">

body {
	background: #159D9B;
	position: relative;
	height: 100%;
	width: 100%;
}
.marvel {
	font-family: Helvetica;
	font-size: 185px;
	position: absolute;
	left: 50%;
	top:40%;
	margin-left: -50px;
	color: #fff;
}
.unhappy {

	width: 100%;
	height: 185px;
	margin-top: 30px;
}
.happy {
	width: 100%;
	height: 225px;
	margin-top: 30px;
}
h2 {
	text-align: center;
	color: #fff;
	font-family: Helvetica, Arial;
	font-size: 52px;
	margin: 10px 0;
}
p.error {
	text-align: left;
	margin: 10px 0 30px 0;
	position: relative;
	color: #FEF8C9;
	font-family: Helvetica, Arial;
	font-size: 18px;
	padding: 0 0 0 10px;
	line-height: 28px;
	width: 600px;
	margin: auto;
	font-style: italic;
}
p.error:before {
	content: '';
	position: absolute;
	left: -11px;
	height: 18px;
	width: 18px;
	top: 4px;
	background: url(../images/x.png) no-repeat center left;
}

p.money {
	text-align: left;
	margin: 10px 0 30px 0;
	position: relative;
	color: #FEF8C9;
	font-family: Helvetica, Arial;
	font-size: 18px;
	padding: 0 0 0 10px;
	line-height: 28px;
	width: 600px;
	margin: auto;
	font-style: italic;
}
p.money:before {
	content: '';
	position: absolute;
	left: -11px;
	height: 18px;
	width: 18px;
	top: 4px;
	background: url(../images/check.png) no-repeat center left;
}
.mighty {
	color: #FFFFFF;
    font-size: 14px;
    margin: 20px 0;
    font-family: Helvetica, Arial;
    text-align: center;
}
</style>
<body>
		<?php
		
		if (isset($_POST['submit'])) {
		$error = "";
		
		$breaks = '<br /><br />';

		if (!empty($_POST['name'])) {
		$name = $_POST['name'];
		} else {
		$error .= "You didn't type in your name. <br />";
		}

		if (!empty($_POST['email'])) {
		$email = $_POST['email'];
		  if (!preg_match("/^[a-z0-9]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email)){ 
		  $error .= "<p class='error'>The e-mail address you entered is not valid. </p>";
		  }
		} else {
		$error .= "<p class='error'>You didn't type in an e-mail address. </p>";
		}
		
		$telephone = $_POST['tel'];
		
		$emailer = $_POST['emailer'];

		if (!empty($_POST['message'])) {
		$message = $_POST['message'];
		} else {
		$error .= "<p class='error'>You didn't type in a message. </p>";
		}

		if(($_POST['code']) == $_SESSION['code']) { 
		$code = $_POST['code'];
		} else { 
		$error .= "<p class='error'>The captcha code you entered does not match. Please try again. </p>";    
		}
		
		if (empty($error)) {
		$from = 'From: ' . $name . ' <' . $email . '>';
		$to =  ''.$emailer.'';
		$subject = 'Website Inquiry From: ' . $email;
		$content = "You have received an inquiry \n From: " . $name . "\n\n Telephone: " . $telephone ."\n\n Email: " . $email . "\n\nMessage:\n " . $message;
		$success = "<div class='happy'></div><h2>Well Said, My Friend</h2><br/><p class='money'>Your message was delivered successfully.<p class='mighty'>Back to your previous page in…</p>";
		mail($to,$subject,$content,$from);
		}
		}
		?>
	
		<div id="contactForm">
		
		
		
		<?php
			if (!empty($error)) {
			echo '<div class="unhappy"></div><h2>Sorry, My Friend, There Were Errors</h2><br/>' . $error . '<p class="mighty">Try again in…</p>';
			} elseif (!empty($success)) {
			echo $success;
			}
		?>
		
		<script type="text/javascript">
	var timeout = 4; // in seconds

		var msgContainer = $('<div />').appendTo('body'),
		    msg = $('<span />').appendTo(msgContainer),
		    dots = $('<span />').appendTo(msgContainer);
		
		var timeoutInterval = setInterval(function() {
		
		   timeout--;
		
		   msg.html('<h1 class="marvel">' + timeout + '</h1>');
		
		   if (timeout == 0) {
		       history.back(0);
		   }
		
		}, 1000);
		

			</script>
			
</body>