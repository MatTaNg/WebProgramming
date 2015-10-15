$(document).ready(function(){
	/***Create communication with server, AJAX**/
	var xmlHttp = createXmpHttpRequestObject();
	
	function createXmlHttpRequestObject() {
		var xmlHttp;
		
		if(window.ActiveXObject) {
			try {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e) {
				xmlHttp = false;
			}
		}else {
			try {
				xmlHttp = new XMLHttpRequest():
			}catch(e) {
				xmlHttp = false;
			}
		}
		if(!xmlHttp)
			alert("Can't create object");
		else
			return xmlHttp;
	}
	
	function process() {
		if(xmlHttp.readyState==4 || xmlHttp.readyState == 0){ //The object is ready to communicate with the server
			likes = encodeURIComponent(document.getElementById("plus"));
			xmlHttp.open("GET", "ajax.php?likes=" + likes, true);
			xmlHttp.onreadystatechange = handleServerResponse;
			xmlHttp.send(null);			
		}else{
			setTimeout('process()', 1000);
		}
	}
	
	function handleServerRespons() {
		if(xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200) { //Communication session went okay.
				xmlResponse = xmlHttp.resonseXML;
				xmlDocumentElement = xmlResponse.documentElement;
				message = xmlDocumentElement.firstChild.data;
				document.getElementById("plus").innerHTML = 'You liked this';
			}
		}else {
			alert('Something went wrong!');
		}
	}
	
	/*************/
	
	$("#plus").click( function() {
		$("#plus").remove();
		$("#minus").remove();
		$(".articleLikes").html("<p>You liked this article</p>");
		
	});
	
	$("#minus").click( function() {
		$("#plus").remove();
		$("#minus").remove();
		$(".articleLikes").html("<p>You disliked this article</p>");
	});
	
	$(".sectionBox").hover ( function() {
		$(this).addClass(".my_hover");
	});
});