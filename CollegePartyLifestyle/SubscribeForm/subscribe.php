
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
		<img src="images/cplswebsitebanner.pdf" alt="Insert logo here" width="1000"
		height="109px" />
		
		<a href="facebook.com"><img src="Images/Facebook.jpg" alt="Insert logo here" width="40"
		height="40px" id = "facebook"/></a>
		<a href="instagram.com"><img src="images/instagram.jpg" alt="Insert logo here" width="40"
		height="40" id = "instagram"/></a>
		<a href="twitter.com"><img src="images/twitter.jpg" alt="Insert logo here" width="40"
		height="40px" id = "twitter"/></a>
		
        <div id = "searchBar">

<form action="search.php" method="post">
	<input type = "text" name="search" placeholder= "search" />
    <input type = "submit" value="Search" />
</form>
</div><!--End of SearchBar-->

        
		</div>
		
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
					
					<p class ="sidebarExcerpt"><img src="Images/CPLS_Logo.JPG" alt="Logo"
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
<?php

$dbc = mysqli_connect('localhost', 'root', 'CDTJD49E42FHM', 'cplssubscriptions')
	or die ('Error connecting to the database. ');
	
$name = $_POST['name'];
$school = $_POST['school'];
$email = $_POST['email'];
	
    //	$searchq = preg_replace("#[^0-9a-z]#i", "", $searchq); replace everything thats NOT in the first ""(cuz of 'i' with everything in the seond "".
    $query = mysql_query("SELECT * FROM mailing_list WHERE email = $email") or die(mysql_error());//may need to limit search if database is too big.  Uses firstname & lastname to search.
    $count = mysql_num_rows($query); //returns an int
    if($count == 0){ //No info in the table
    $query = "INSERT INTO mailing_list (name, school, email)" .
	"VALUES('$name', '$school', '$email')"; 
	echo subscribed;
	//header ('Location: subscribed.html');
}
    else {	
	echo not subscribed;
		//header ('Location: notSubscribed.html');

	}

mysqli_query($dbc, $query)
	or die('Error querying the database');
	
mysqli_close($dbc);

?>



<div id = "rightSidebar">
			
			<div class = "rightContainer">
			
				<div class="rightBannerTitle"><h4>SUBSCRIBE NOW!</h4></div>
				
				<p id= "ebookForm">
                <form action="subscribe.php" method="post">
					<b>NAME:</b>
					<input type = "text" name = "name" size="20" /><br />
					<b>SCHOOL:</b>
					<input type = "text" name = "school" size="20" /><br />
					<b>EMAIL:</b>
					<input type="text" name="email" size="20" /><br />
					<input type="submit" value="Submit" />
                 </form>
				</p>
			</div><!--End of rightContainer-->
			
			<div class = "whatsHot">
				<div class = "rightBannerTitle"><h4>Whats Hot!</h4></div>
				
			</div><!--End of Whats Hot-->
			
			</div><!--End of rightSidebar"-->
		</div><!--End of contentBackground-->
	</div> <!--End of content-->


</body>
</html>