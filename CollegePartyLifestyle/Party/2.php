<?php
//Change $page variable to the specific page number.
include('SubscribeForm/core/init.inc.php');

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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<!--Replace link with good web font you want.<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css' /> - See more at: http://www.newthinktank.com/2011/09/how-to-layout-a-website/#sthash.lWAaNgcS.dpuf -->

<link rel="stylesheet" type="text/css" href="CPLS_Stylesheet.css">

<title>CollegePartyLifestyle</title>

</head>

<body>

	<div id="content">
		
		<div id="header">
			<img src="./images/cplswebsitebanner.pdf" alt="Insert logo here" width="100%"
		height="109px" id="Logo" />
			<a href="facebook.com"><img src="images/Facebook.jpg" alt="Insert logo here" width="40"
		height="40px" id = "facebook"/></a>
			<a href="instagram.com"><img src="images/instagram.jpg" alt="Insert logo here" width="40"
		height="40px" id = "instagram"/></a>
			<a href="twitter.com"><img src="images/twitter.jpg" alt="Insert logo here" width="40"
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
					
					<p class ="sidebarExcerpt"><img src="./images/CPLS_Logo.fw" alt="Logo"
								width="73px" height="73px" id="logo" /><br />Here is some textHere is some text	Here is some textHere is some textHere is some textHere is some text
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
			</div> <!--End of left sidebar-->
				<div class = "articleMiddleColumn">
					<div class = "articleMiddleBannerTitle">PARTY</div>
					

				
					<?php
					$page = 2;
					$articles_per_page = 3;
					$offset = $page * $articles_per_page;
					
					//Print out articles						
						
					    $query = mysql_query("SELECT * FROM party")
							or die(mysql_error());
						$count = mysql_num_rows($query); //returns an int
						$number_of_pages = intval($count / $articles_per_page);
						$iterations = 1;
						if($count % 3 == 0)
							$number_of_pages -= 1;
						$min_count = ($number_of_pages * $articles_per_page) - $offset;
						$max_count = $min_count + $articles_per_page;
						
						while($row = mysql_fetch_array($query)){
						$title = $row['articleTitle'];
						$date = $row['date'];
						$id = $row['article_id'];
						$summary = $row['articleSummary'];
						//$count = count($row);

						if ($iterations > $min_count && $iterations <= $max_count) {
					//	echo $iterations;
						echo '<div class = "article">';
						echo '<div class = "articleTitle"><a href="' . $title . '">' . $title . '</a></div>';
						echo '<div class = "articleDate">' . $date . '</div>';
						echo '<img src = "' . $title . '" alt="Inset Image here" width="150"
							height="130px" class="articleImage" /><p>';
						echo $summary . '<a href = "' . $title . '">Read More...</a>
						</div><div class="articlehorzRule"></div>';

						}
						if($iterations == $max_count){
							echo '<div class = "pageNav"><a href = "party_' . ($page - 1) . '.php">Previous Page</a> | 
								<a href = "party_' . ($page + 1) . '.php">Next Page</a></div>';
							break;
							}
						$iterations = $iterations + 1;
						}
						
					?>
					

				</div> <!--End of middleColumn-->				

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
			</div><!--End of whats Hot-->
			</div><!--End of rightSidebar"-->
		</div><!--End of contentBackground-->
	</div> <!--End of content-->

</body>
</html>