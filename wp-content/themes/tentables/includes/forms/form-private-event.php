<?php

require_once('recaptchalib.php');
$privatekey = "6LcB-uYSAAAAAKM3N2HDXi-9MQqF-lzNkd8_hyTh";

/************************************************************************************
GENERIC FORM
include this file in your template before the header.
/************************************************************************************/
global $message;
global $failed;

$failed = false;

if(isset($_POST['email'])) {

	$resp = recaptcha_check_answer ($privatekey,
	$_SERVER["REMOTE_ADDR"],
	$_POST["recaptcha_challenge_field"],
	$_POST["recaptcha_response_field"]);
	if ($resp->is_valid) {

		// only one of these errors should output
		$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
		if(empty($_POST['restaurant'])) { died('You did not pick a restaurant location.', $message); }
		if(empty($_POST['realname'])) { died('You did not enter your name.', $message); }
		if(empty($_POST['phone'])) { died('You did not enter your phone number.', $message); }
		if(empty($_POST['guests'])) { died('You did not enter the number of guests.', $message); }
		if(empty($_POST['eventtype'])) { died('You did not enter an event type.', $message); }
		if(empty($_POST['eventdate'])) { died('You did not enter an event date.', $message); }
		if(!eregi($email_exp,$_POST['email'])) { died('Enter a valid email address.', $message); }

		// we submit the form only on success
		if ($failed == false) {
			
			$email_to = "10tablescambridge@gmail.com";
			$email_from = clean_string($_POST['email']);
			$email_subject = "Private Event Form Submission";

			$realname = $_POST['realname'];
			$restaurant = $_POST['restaurant']; 
			$email = $_POST['email']; 
			$phone = $_POST['phone'];
			$guests = $_POST['guests'];
			$eventtype = $_POST['eventtype'];
			$eventdate = $_POST['eventdate'];

			$email_message .= "Location: ".clean_string($restaurant)."\n";
			$email_message .= "First Name: ".clean_string($realname)."\n";
			$email_message .= "Email: ".clean_string($email)."\n";
			$email_message .= "Phone Number: ".clean_string($phone)."\n";
			$email_message .= "# of Guests: ".clean_string($guests)."\n";
			$email_message .= "Type of Event: ".clean_string($eventtype)."\n";
			$email_message .= "Date of Event: ".clean_string($eventdate)."\n";

			// create email headers
			$headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n".'X-Mailer: PHP/' . phpversion();
			@mail($email_to, $email_subject, $email_message, $headers);
			
		}
	} else {
		died("The reCAPTCHA wasn't entered correctly. Go back and try it again.");
	}
}

/************************************************************************************
IMPORTANT: Take the below code and place it where
you would like the error/success message to appear.
/************************************************************************************

<?php if (isset($_POST['email'])) { ?>
	<?php if ($failed == true) { ?> 
			<p class="error">We're sorry, but there were error(s) found with the form you submitted.</p>
			<ul class="error"><?php echo $message; ?></ul>
	<?php } else { ?>
			<p class="success">Thank you for your message. We will get back to you soon.</p>
	<?php } ?>
<?php } ?>