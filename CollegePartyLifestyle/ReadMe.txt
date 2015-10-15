How to add an article:
 1.  Enter the article under the 'article' section of the database.
 2.  Create a new page for that article, copy and paste the code from another article.
 3.  Change the '$article' variable to the corresponding article name.
 4.  The image corresponding to the article summary must be called the name of the article.
 
How to add an article for girls:
1.  The name of the article must match the folder where the picture are.
2.  The pictures go inside a folder named 'images' inside the folder of the section.
3.  The first picture in the folder for each article should be the picture displayed as the preview
	and should be named '0.jpg'.  The pictures after should increment the previous article name by 1.
4.  The width and height of each image must be recorded into the database.
5.  Note the width of the article div is about 650 pixels.  The width should NOT exeed this.
6.  To change the number of articles displayed on each page go into Core.init.inc and change the variable '$girls_per_page'

How to add an article for Memes:
1.  Just add the picture into the memes/images folder with the corresponding increments.
2.  Then change the $num_of_memes variable in Core/init.inc.php to the number of pictures there are.
3.  Similar to the articles for girls the article div is about 650 pixels so do not exeed that.
 
How to add more pages to sections:
1.  Create a new page, and change the '$page' variable.
2.  Be sure the new page is called #.php(ex 1.php, 2.php etc...) or things will mess up.
3.  The first and last pages you must manually change the quick nav at the bottom so it doesn't say 'Next | Prev'.
4.  To change the number of articles displayed on each page go into Core.init.inc and change the variable '$articles_per_page'

Bugs/Notes:
1.  The articleSummary MUST be 275 characters otherwise the <hr> tags will mess up.
2.  Views increments twice per view.
3.  Likes/dislikes do not record clicks yet.
4.  Entering in an empty search will search for ALL articles.
5.  Cannot send emails out until an actual web server is established.  It also has not been tested.
6.  The folder structure must go as such: the article section then a folder entitled 'Article'; otherwise the search results will not link correctly.
	ex: party/Article.
7.  If a page does not have an $article variable it will not beable to post comments.