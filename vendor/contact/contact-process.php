<?php

// define("WEBMASTER_EMAIL", 'upgradeEx@gmail.com');
//$address = "example@themeforest.net";
$address = "upgradeEx@gmail.com";
if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

$error = false;
$fields = array( 'author', 'email', 'subject', 'comment', );

foreach ( $fields as $field ) {
	if ( empty($_POST[$field]) || trim($_POST[$field]) == '' )
		$error = true;
}

if ( !$error ) {

	$author = stripslashes($_POST['author']);
	$email = trim($_POST['email']);
	$subject = stripslashes($_POST['subject']);		
	$comment = stripslashes($_POST['comment']);
        $services= $_POST['services'];       
	
	$e_subject = 'You\'ve been contacted by ' . $author. '.';

	// Configuration option.
	// You can change this if you feel that you need to.
	// Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.

	$e_body = "You have been contacted by: $author" . PHP_EOL . PHP_EOL;
	$e_reply = "E-mail: $email" . PHP_EOL;
	$e_subject = "\r\nsubject: $subject"  . PHP_EOL;	
        $e_services = "\r\nservices: $services" . PHP_EOL;
	$e_content = "\r\nMessage: $comment";

	$msg = wordwrap( $e_body . $e_reply .$e_subject .$e_services  .$e_content , 70 );

	$headers = "From: $email" . PHP_EOL;
	$headers .= "Reply-To: $email" . PHP_EOL;
	$headers .= "MIME-Version: 1.0" . PHP_EOL;
	$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
	$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

	if(mail($address, $e_subject, $msg, $headers)) {

		// Email has sent successfully, echo a success page.

		echo 'Success';

	} else {

		echo 'ERROR!';

	}

}

?>