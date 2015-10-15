<?php
include('../../SubscribeForm/core/init.inc.php');

$article = 'How to party in college';									

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'])) {
	$errors = array();
	
	if(preg_match('/^[a-z]+$/i', $_POST['firstname']) === 0) {
		$errors[] = '<b>Your first name must contain only letters.</b>';
	}	//Check to see if the forms contain letters
	


	if(preg_match('/^[a-z]+$/i', $_POST['lastname']) === 0) {
		$errors[] = '<b>Your last name must contain only letters.</b>';
	}	//Check to see if the forms contain letters
	
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
		//filter_var filters a string, in this case the 'email'
		//The chosen filter is 'FILTER_VALIDATE_EMAIL' this checks to see if the string is a valid email.
			$errors[] = '<b>The email address is invalid.</b>';
		}
		}
if(isset($_POST['name'], $_POST['comment'], $_POST['submit'])) {
	$name=$_POST['name'];
	$comment=$_POST['comment'];
	$submit=$_POST['submit'];
 
	$dbLink = mysql_connect("localhost", "root", "CDTJD49E42FHM");
		mysql_query("SET character_set_client=utf8", $dbLink);
		mysql_query("SET character_set_connection=utf8", $dbLink);
	 
	if($submit)
		{
		if($name&&$comment)
		{
			$insert=mysql_query("INSERT INTO commenttable (name,comment, articleTitle) VALUES ('$name','$comment', '$article') ");
			}
			else
			{
				echo "please fill out all fields";
				}
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<!--Replace link with good web font you want.<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css' /> - See more at: http://www.newthinktank.com/2011/09/how-to-layout-a-website/#sthash.lWAaNgcS.dpuf -->

<link rel="stylesheet" type="text/css" href="../../Core/CPLS_Stylesheet.css">

<title>CollegePartyLifestyle</title>

</head>

<body>

	<div id="content">
		
		<div id="header">
		
		<img src="../../core/images/cplswebsitebanner.pdf" alt="Insert logo here" width="100%"
		height="109px" id="Logo" />
				<a href="facebook.com"><img src="../../core/images/Facebook.jpg" alt="Insert logo here" width="40"
		height="40px" id = "facebook"/></a>
			<a href="instagram.com"><img src="../../core/images/instagram.jpg" alt="Insert logo here" width="40"
		height="40px" id = "instagram"/></a>
			<a href="twitter.com"><img src="../../core/images/twitter.jpg" alt="Insert logo here" width="40"
		height="40px" id = "twitter"/></a>
		
		<div id = "searchBar">

	<form action="search.php" method="post">
		<input type = "text" name="search" placeholder= "Search Articles" />
		<input type = "submit" value="Search" />
	</form>

		</div><!--End of SearchBar-->
		
		</div><!--End of Header-->
		<div id = "menuBar">
		<a href ="#">Party</a> | 
		<a href = "#">Fashion</a> | 
		<a href = "#">Girls</a> | 
		<a href = "#">Memes</a>
		</div><!--End of menuBar-->
		
		<div id="contentBackground">
			<div id="leftSidebar">
				<div class="leftContainer">
					<div class = "bannerTitle"><h4>WHO WE ARE</h4></div>
					
					<p class ="sidebarExcerpt"><img src="../../core/images/CPLS_Logo.jpg" alt="Logo"
								width="73px" height="73px" id="logo" /><br />Here is some textHere is some text
								Here is some textHere is some textHere is some textHere is some text
								Here is some textHere is some textHere is some textHere is some text
					
					</p>
				</div><!-- End of leftContainer -->
				
				<div class = "recentArticles">
					<div class = "bannerRecentArticles"><h4>RECENT ARTICLES</h4></div>
					<div class = "ArticleTitle">ARTICLE 1</div>
						Here is some textHere is some textHere is some text
						<a href="#">Read More...</a>
				
				<div class = "horzRule"> </div>
				
									<div class = "ArticleTitle">ARTICLE 1</div>
						Here is some textHere is some textHere is some text
						<a href="#">Read More...</a>
				
				<div class = "horzRule"> </div>
				
											<div class = "ArticleTitle">ARTICLE 1</div>
						Here is some textHere is some textHere is some text
						<a href="#">Read More...</a>
				
				<div class = "horzRule"> </div>
				
									<div class = "ArticleTitle">ARTICLE 1</div>
						Here is some textHere is some textHere is some text
						<a href="#">Read More...</a>
				
				<div class = "horzRule"> </div>
				
									<div class = "ArticleTitle">ARTICLE 1</div>
						Here is some textHere is some textHere is some text
						<a href="#">Read More...</a>
			
				</div><!--End of recent articles-->
			</div> <!--End of left side bar-->
				<div class = "articleMiddleColumn">
					<div class = "articleMiddleBannerTitle"><?php echo $article?></div>
					
					<div class = "article">
					<div class = "articleTitle"><?php echo $article?></div>
						<img src="#" alt="Insert image here" width="150"
							height="130px" class="articleImage" />
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								<br />
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								<br />
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
								Here are words.Here are words.Here are words.Here are words.Here are words.
					</div> <!--End of article-->
					<hr>
								<?php
								
								$dbLink = mysql_connect("localhost", "root", "CDTJD49E42FHM");
								mysql_query("SET character_set_results=utf8", $dbLink);
								mb_language('uni');
								mb_internal_encoding('UTF-8');
								

								
								$getquery=mysql_query("SELECT * FROM commenttable WHERE articleTitle LIKE '$article' ORDER BY id DESC");
								while($rows=mysql_fetch_assoc($getquery))
								{
									$id=$rows['id'];
									$name=$rows['name'];
									$comment=$rows['comment'];
									echo '<div class = "commentBox"><div class = "commentName">' . $name . ':</div><br/>' .
										'<br/>' . $comment . '<br/>' . '<br/>' . '</div><hr size="1"/>';
									}
									?>
																
								<center>
									<form action="" method="POST">
									<table>
									<tr><td>Name: <br><input type="text" name="name"/></td></tr>
									<tr><td colspan="2">Comment: </td></tr>
									<tr><td colspan="5"><textarea name="comment" rows="10" cols="50"></textarea></td></tr>
									<tr><td colspan="2"><input type="submit" name="submit" value="Comment"></td></tr>
									</table>
									</form>
				
									<?php

										$query = mysql_query("SELECT * FROM party WHERE articleTitle LIKE '%$article'") 
											or die(mysql_error());
										$row = mysql_fetch_array($query);
										$title = $row['articleTitle'];
										$prev_id = $row['article_id'] - 1;
										$next_id = $row['article_id'] + 1;
										
										$query = mysql_query("SELECT * FROM party WHERE article_id LIKE '%$prev_id%'") 
											or die(mysql_error());
										$row = mysql_fetch_array($query);
										$prev_title = $row['articleTitle'];
										
										$query = mysql_query("SELECT * FROM party WHERE article_id LIKE '%$next_id%'") 
											or die(mysql_error());
										$row = mysql_fetch_array($query);
										$next_title = $row['articleTitle'];

										echo '<div class = "pageNav"><a href = "' . $prev_title . '.php">' . $prev_title . '</a> | 
											<a href = "' . $next_title . '.php">' . $next_title . '</a></div>';
								?>
				

				</div> <!--End of articleMiddleColumn-->
				
			<div id = "rightSidebar">
			
			<div class = "rightContainer">
			
				<div class="rightBannerTitle"><h4>SUBSCRIBE NOW!</h4></div>
				
				<div id= "ebookForm">
		<?php		
		if(empty($errors) === false && $_POST['submit']) { //Have errors
			//echo "<script>alert(''<ul>', '<li>',  implode('<li> <li>', $errors), '</li>', '</ul>'');</script>";
			echo "<p><b>Invalid input.</b></p>";
			//echo '<li>';
			
		//	echo implode('<li> <li>', $errors);
			
			//echo '</li>';
			
		//	echo '</ul>';
		
		} else if(!(isset($_POST['firstname'], $_POST['lastname'], $_POST['email'])) && isset($_POST['submit'])){ //Have submitted an empty form
			echo '<p><b>Please fill in the form</b></p>';
		} else{ //Submitted form and no errors
			if(isset($_POST['submit']))
				if(add_user($_POST['firstname'], $_POST['lastname'], $_POST['school'], $_POST['email']) === false) {
					echo "<b>You have already subscribed.</b>";
					$errors[] = "Your email is already in our database."; //This may not be true.
				}
			
			else{
			echo '<b>You have subscribed!</b><br>';
			}
		}

		?> 
		
	
	<form action = "" method="post">
		
		<label for="firstname">First name:</label>
		<input type = "text" name = "firstname" id = "firstname" size="20" /><br>
		<p>
		<label for="lastname">Last name:</label>
		<input type = "text" name = "lastname" id = "lastname" size="20" /><br>
		</p>
		<p>
		<label for="school">School:</label><br>
		<input type = "text" name = "school" id = "school" size="20" /><br>
		</p>
		<p>
		<label for="email">Email:</label> <br>
		<input type="text" name="email" id = "email" size="20" /><br>
		</p>
		<p>
		<input type="submit" name="submit" value="Submit" />
		</p>
	</form>
	</div>

				
			</div><!--End of rightContainer-->
			
			<div class = "whatsHot">
				<div class = "rightBannerTitle"><h4>Whats Hot!</h4></div>
			</div><!--End of rightSidebar"-->
		</div><!--End of contentBackground-->
	</div> <!--End of content-->

</body>
</html>