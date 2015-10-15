<?php
include('core/init.inc.php');

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'])) {
	$errors = array();
	
	if(preg_match('/^[a-z]+$/i', $_POST['firstname']) === 0) {
		$errors[] = 'Your first name must contain only letters.';
	}	//Check to see if the forms contain letters
	
	if(preg_match('/^[a-z]+$/i', $_POST['school']) === 0) {
		$errors[] = 'Your school must contain only letters.';
	}	//Check to see if the forms contain letters

	if(preg_match('/^[a-z]+$/i', $_POST['lastname']) === 0) {
		$errors[] = 'Your last name must contain only letters.';
	}	//Check to see if the forms contain letters
	
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'The email address is invalid.';
		}
		
		if (empty($errors)) {
			if(add_user($_POST['firstname'], $_POST['lastname'], $_POST['school'], $_POST['email']) === false) {
				$errors[] = "Your email is already in our database."; //This may not be true.
			}
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<body>

	<div>
		<?php
		
		if(empty($errors) === false) { //Have errors
	/*		echo '<ul>';
			
			echo '<li>';
			
			echo implode('<li> <li>', $errors);
			
			echo '</li>';
			
			echo '</ul>';*/
		} else if(isset($errors) === false) { //Have submitted an empty form
			echo 'Please fill in your information to subscribe.';
		} else{ //Submitted form and no errors
			echo 'You have subscribed to College Party Lifestyle!';
		}
		?>
	</div>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />

	<form action = "" method="post">
		<p>
		<label for="firstname">First name</label>
		<input type = "text" name = "firstname" id = "firstname" size="20" /><br>
		</p>
		<p>
		<label for="lastname">Last name</label>
		<input type = "text" name = "lastname" id = "lastname" size="20" /><br>
		</p>
		<p>
		<label for="school">School</label>
		<input type = "text" name = "school" id = "school" size="20" /><br>
		</p>
		<p>
		<label for="email">Email</label>
		<input type="text" name="email" id = "email" size="20" /><br>
		</p>
		<p>
		<input type="submit" value="Submit" />
		</p>
	</form>
<!--value =<?php //if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>-->
</body>
</head>				
</body>
</html>	