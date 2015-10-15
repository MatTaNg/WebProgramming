<?php

	include('core/init.inc.php');
	$query = mysql_query("SELECT * FROM cpls_confessions ORDER BY id DESC")
							or die(mysql_error());
$id = $_GET['id'];					
echo $id;				
		//$content = $_POST['id'];
	if(isset($_GET['id'])) {
		$insert=mysql_query("UPDATE cpls_confessions SET hide = '0' WHERE id = '$id'");
	}
		if(isset($_POST['submit']))
		{
			$select=mysql_query("SELECT * cpls_confessions WHERE hide = '0'");
			while($row = mysql_fetch_array($query)) {
			$content = $row['content'];
			$hide = $row['hide'];
			if($hide == 1) {
				$insert=mysql_query("DELETE FROM cpls_confessions WHERE content = '$content'");
				}
			}
		}
	$iterator = 0;
	while($row = mysql_fetch_array($query)){
		$hide = $row['hide'];
		if($hide == 1) {
		$content = $row['content'];
		$submit_date = $row['submit_date'];
		$post_date = "";
		$id = $row['id'];
		$delete = $id;
		echo 		$content;

		echo 		'<a href = "confessions_submit.php?id=' . $id . '">Submit</a>';
				echo 		'<a href = "confessions_submit.php?id=' . $delete . '">Delete</a>';
				



		}
	}
			echo 		'<form action="" method="POST">';
		echo 		'<table>';
	echo '<tr><td colspan="2"><input type="submit" name="submit" value="DELETE ALL"></td></tr>';
			echo		'</table>';
		echo		'</form>';
?>