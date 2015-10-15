<?php
	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding = "UTF-8" standalone = "yes" ?>';
	
	echo '<response>';//The javascript file will see the XML between the response tags.
		$likes = $_GET['likes'];
		$getquery=mysql_query("SELECT * FROM articles WHERE articleTitle = '$article'");
	echo '</response>';
?>