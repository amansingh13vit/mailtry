<?php

    $msg = "";
    if(isset($_POST['submit'])){
    	require 'phpmailer/PHPMailerAutoload.php';
    	function sendemail($to, $from, $fromName, $body, $attachment){
    		$mail = new PHPMailer();
    		$mail ->setFrom($from, $fromName);
    		$mail ->addAddress($to);
    		$mail ->addAttachment($attachment);
    		$mail ->Subject = " Contact Form";
    		$mail -> Body = $body;
    		$mail -> isHTML( false);
    		return $mail ->send();
    	}
    	$name = $_POST['name'];
    	$email = $_POST['email'];
    	$body = $_POST['body'];

    	$file = "attachment/" . basename($_FILES['attachment']['name']);
    	if(move_uploaded_file($_FILES['attachment']['tmp_name'], $file)){
    		if(sendemail('aman76079@gmail.com',$email, $name, $body, $file))
    			$msg = "email sent";
    			else 
    				$msg = "email failed";

    	}else
    	$msg =  "plese check your attachment";
    }

?>





<!DOCTYPE html>
<html>
<head>
	<title>
		Php mailer
	</title>
</head>
<body style="text-align: center;">
	<form method="post" action="index.php" enctype="multipart/form-data">
		<input type="type" name="name" placeholder="Name" required=""><br>
		<input type="email" name="email" placeholder="Email" required=""><br>
		<textarea name="body" placeholder="Message" required=""></textarea><br>
		<input type="file" name="attachment" required=""><br>
		<input type="submit" name="submit" value="Send">
		
	</form>
	<br><br>
	<?php  echo "$msg"; ?>

</body>
</html>