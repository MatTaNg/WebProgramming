<?php

include('core/init.inc.php');

if(isset($_POST['subject'], $_POST['body'])){
	echo email_all($_POST['subject'], $_POST['body'], 'From: ng5280@hotmail.com');
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>

<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<!--Replace link with good web font you want.<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css' /> - See more at: http://www.newthinktank.com/2011/09/how-to-layout-a-website/#sthash.lWAaNgcS.dpuf -->
	
	<form action = "" method="post">
		<b>subject</b>
		<input type = "text" name = "subject" size="20"/><br />
		<b>body</b>
		<input type = "text" name = "body"/><br />		
		<input type="submit" value="Submit" />
				</form>

</body>
</html>