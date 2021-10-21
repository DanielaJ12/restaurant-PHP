<?php

function input($data)
{
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}

$name=input($_POST['name']);
$email=input($_POST['email']);
$message=input($_POST['message']);


$to_email = "restaurantonlinegalati@gmail.com";
$subject = $name;
$body = $message;
$headers = "From: ".$name;


$sentmail=mail($to_email, $subject, $body, $headers);

if ($sentmail) 
{
	 echo '<script>alert("Multumim!Email-ul a fost trimis.")
	 window.location.href="contact.php"</script>';
	
    
} 
else 
{
	
   echo '<script>alert("Email sending failed") window.location.href="contact.php"</script>';
    
}

?>