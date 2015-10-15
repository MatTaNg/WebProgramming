<?php

	//Dakota Pollitt
	//This file contains a list of all stored procedures from the database
	//They are here because calling the procedures themselves resulted in errors
	//The program should use mysqli (since mysql is deprecated) but converting at 
	//	this point in development would have cost time we don't have

	define("DATABASE_HOST", "localhost");
	define("DATABASE_USERNAME", "root");
	define("DATABASE_PASSWORD", "CDTJD49E42FHM");
	define("DATABASE_NAME", "beerbot");

	mysql_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD)
	    or die('Error connecting to the database.');
	mysql_SELECT_db(DATABASE_NAME)
	    or die('Error');

	//ALL RETURNS ARE IN QUERY FORM

	//Returns all {plural noun} in the DB
	function qGetAll($pluralnoun) {	
		if($pluralnoun == 'beers')
			return mysql_query('SELECT beername
								FROM beer;');
		if($pluralnoun == 'breweries')
			return mysql_query('SELECT brewername
								FROM brewery;');
		if($pluralnoun == 'styles')
			return mysql_query('SELECT stylename
								FROM style;');
	}

	//Returns the ABV of a given beer
	function qABV($beername) {
		return mysql_query('SELECT ABV
							FROM beer
							WHERE beername = "'.$beername.'";');
	}

	//Returns the glassware of a given beer
	function qBeerGlass($beername) {
		return mysql_query('SELECT glassware
							FROM style
							WHERE styleid in (
								SELECT styleid
								FROM beer
								WHERE beername = "'.$beername.'");');
	}

	//Returns the beers of a given style
	function qBeerOfStyle($stylename) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE styleid in (
								SELECT styleid
								FROM style
								WHERE stylename = "'.$stylename.'");');
	}

	//Returns the beers of a given style and brewery
	function qBeerOfStyleFrom($stylename, $brewername) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE styleid in (
								SELECT styleid
								FROM style
								WHERE stylename = "'.$stylename.'") and
							brewerid in (
								SELECT brewerid
								FROM brewery
								WHERE brewername = "'.$brewername.'");');
	}

	//Returns the beers of a given brewery
	function qBeersByBrewery($brewername) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE brewerid in (
								SELECT brewerid
								FROM brewery
								WHERE brewername = "'.$brewername.'");');
	}

	//Returns the brewer of a given beer
	function qGetBrewer($beername) {
		return mysql_query('SELECT brewername
							FROM brewery
							WHERE brewerid in (
								SELECT brewerid
								FROM beer
								WHERE beername = "'.$beername.'");');
	}

	//Returns the INT year that a given brewery was founded
	function qGetFounded($brewername) {
		return mysql_query('SELECT founded
							FROM brewery
							WHERE brewername = "'.$brewername.'";');
	}

	//Returns the location of a given brewery
	function qGetLocation($brewername) {
		return mysql_query('SELECT location
							FROM brewery
							WHERE brewername = "'.$brewername.'";');
	}

	//Returns the style of a given beer
	function qGetStyle($beername) {
		return mysql_query('SELECT stylename
							FROM style
							WHERE styleid in (
								SELECT styleid
								FROM beer
								WHERE beername = "'.$beername.'");');
	}

	//Returns the beers with the highest ABV in the DB
	function qHighestABV() {
		return mysql_query('SELECT beername
							FROM beer
							WHERE ABV = (
								SELECT max(ABV)
								FROM beer);');
	}

	//Returns the beers with the highest ABV of a given brewery
	function qHighestABVFrom($brewername) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE ABV = (
								SELECT max(ABV)
								FROM beer
								WHERE brewerid in (
									SELECT brewerid
									FROM brewery
									WHERE brewername = "'.$brewername.'"));');
	}

	//Returns the beers with the highest ABV of a given style
	function qHighestStyle($stylename) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE styleid in (
								SELECT styleid
								FROM style
								WHERE stylename = "'.$stylename.'") and
							ABV = (
								SELECT max(ABV)
								FROM beer
								WHERE styleid in (
									SELECT styleid
									FROM style
									WHERE stylename = "'.$stylename.'"));');
	}

	//Returns the beers with the highest ABV of a given style and brewery
	function qHighestStyleFrom($stylename, $brewername) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE brewerid in (
								SELECT brewerid
								FROM brewery
								WHERE brewername = "'.$brewername.'") and
							styleid in (
								SELECT styleid
								FROM style
								WHERE stylename = "'.$stylename.'") and
							ABV = (
								SELECT max(ABV)
								FROM beer
								WHERE styleid in (
									SELECT styleid
									FROM style
									WHERE stylename = "'.$stylename.'") and
								brewerid in (
									SELECT brewerid
									FROM brewery
									WHERE brewername = "'.$brewername.'"));');
	}

	//Returns the beers with the lowest ABV of a given style
	function qLowestStyle($stylename) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE styleid in (
								SELECT styleid
								FROM style
								WHERE stylename = "'.$stylename.'") and
							ABV = (
								SELECT min(ABV)
								FROM beer
								WHERE styleid in (
									SELECT styleid
									FROM style
									WHERE stylename = "'.$stylename.'"));');
	}

	//Returns the beers with the lowest ABV of a given style and brewery
	function qLowestStyleFrom($stylename, $brewername) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE brewerid in (
								SELECT brewerid
								FROM brewery
								WHERE brewername = "'.$brewername.'") and
							styleid in (
								SELECT styleid
								FROM style
								WHERE stylename = "'.$stylename.'") and
							ABV = (
								SELECT min(ABV)
								FROM beer
								WHERE styleid in (
									SELECT styleid
									FROM style
									WHERE stylename = "'.$stylename.'") and
								brewerid in (
									SELECT brewerid
									FROM brewery
									WHERE brewername = "'.$brewername.'"));');
	}

	//Returns the beers with the lowest ABV in the DB
	function qLowestABV() {
		return mysql_query('SELECT beername
							FROM beer
							WHERE ABV = (
								SELECT min(ABV)
								FROM beer);');
	}

	//Returns the beers with the lowest ABV of a given brewery
	function qLowestABVFrom($brewername) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE ABV = (
								SELECT min(ABV)
								FROM beer
								WHERE brewerid in (
									SELECT brewerid
									FROM brewery
									WHERE brewername = "'.$brewername.'"));');
	}

	//Returns the beers of the given style
	function qSpecificStyle($stylename) {
		return mysql_query('SELECT beername
							FROM beer
							WHERE styleid in (
								SELECT styleid
								FROM style
								WHERE stylename = "'.$stylename.'");');
	}

	//Returns the glassware of a given style
	function qStyleGlass($stylename) {
		return mysql_query('SELECT glassware
							FROM style
							WHERE stylename = "'.$stylename.'";');
	}

	//Returns the styles of a given brewery
	function qStylesByBrewery($brewername) {
		return mysql_query('SELECT stylename
							FROM style
							WHERE styleid in (
								SELECT styleid
								FROM beer
								WHERE brewerid in (
									SELECT brewerid
									FROM brewery
									WHERE brewername = "'.$brewername.'"));');
	}

	//Return a beer of the given ID
	function qGetABeer($id){
		return mysql_query('SELECT beername
							FROM beer
							WHERE beerid = '.$id.';');
	}
	//Return a brewery of the given ID
	function qGetABrewery($id){
		return mysql_query('SELECT brewername
							FROM brewery
							WHERE brewerid = '.$id.';');
	}
	//Return a style of the given ID
	function qGetAStyle($id){
		return mysql_query('SELECT stylename
							FROM style
							WHERE styleid = '.$id.';');
	}
?>