<?php

function add_user($firstname, $lastname, $school, $email) {
	$firstname = mysql_real_escape_string($firstname);
	$lastname = mysql_real_escape_string($lastname);
	$school = mysql_real_escape_string($school);
	$email = mysql_real_escape_string($email);
	
	$result = mysql_query("INSERT INTO mailing_list (firstname, lastname, school, email)
		VALUES ('$firstname', '$lastname', '$school', '$email')");
		
	return ($result !== false) ? true : false;
}

function remove_user($email) {
	$email = mysql_real_escape_string($email);
	
	mysql_query("DELETE FROM 'mailing_list' WHERE 'email' = '{$email}'");
}

function email_all($subject, $message, $headers) {
	$users = mysql_query("SELECT 'firstname', 'email' FROM mailing_list");
	
	while(($user = mysql_fetch_assoc($users)) !== false) {
		//$body = "Dear, {$user['firstname']}\n\n{$message}\n\nUnsubscribe: ";
		
		mail($user['email'], $subject, $message, $headers);
		return $message;
	}
}
?>