<?php

	require('queryFuncs.php');

	$punctuation = array(".", ",", ";", ":", "!", "?", "/", "<", ">", "@", "#", "$", "%", "^", "&", "*", "-", "_", "=", "+", "~", "`", "|", "{", "}", "[", "]", "(", ")", "'");
	$greet = array("sup", "hi", "hello", "hey");
	$bye = array("bye", "cya", "later", "pce", "peace", "night", "leaving so soon?");
	$notSure = array("I'm not too sure what you're trying to say",
					"I don't understand",
					"What?");
	$questions = array("who", "what", "when", "where", "why", "how", "do", "is", "you", "know", "many");
	$vowel = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
				
	$question;
	$beer;
	$brewery;
	$style; 
    $glassware;
	$secondWord; //many, is, can
	$thirdWord; //Special circumstances
	$pluralNoun;

	//Matt Ng
	//Standardizes input for processing			
	function parseString($input) {
		for($x = 0; $x < count($GLOBALS["punctuation"]); $x++)
			$input = trim($input, $GLOBALS["punctuation"][$x]);//Trim the punctuation.
		if(in_array(strtolower($input), $GLOBALS["greet"]) || 
		in_array(strtolower($input), $GLOBALS["questions"]) || 
		in_array(strtolower($input), $GLOBALS["bye"])) {
			$input = strtolower($input);
		}
		$input = trim($input);
		$input = strip_tags($input);//Strip PHP and HTML tags in string
		return $input;
	}

	//Matt Ng
	function isQuestion($input){
		if(in_array($input, $GLOBALS["questions"])) {//in_array is similar to .contains, case sensitive.
			return true;
		}
	}
	
	//Matt Ng
	function isGreeting($input){
		if(in_array($input, $GLOBALS["greet"])) {//in_array is similar to .contains, case sensitive.
			return true;
		}
	}
	
	//Dakota Pollitt
	//Begin interpreting string, check first word, pop, and pass
	//Returns true if receives and empty array from a given method
	//Returns false if a method returns NULL, signifying incorrect grammar
	function interpret($input){
		if(count($input) > 3) {
			$GLOBALS['secondWord'] = $input[1];
			$GLOBALS['thirdWord'] = $input[3];
		}
		switch($input[0]) {
			case 'Who':
				if(validateIndex($input, 3)) {
					$GLOBALS['question'] = "who";
					$input = pop($input);
					$input = who($input);
				}
				else {	$input = NULL;	}
				break;
			case 'Is':
				$GLOBALS['question'] = "is";
				if(validateIndex($input, 4)) {
					$input = pop($input);
					$input = is($input);
				}
				break;
			case 'When':
				if(validateIndex($input, 4)) {
					$GLOBALS['question'] = "when";
					$input = pop($input);
					$input = when($input);
				}
				else {	$input = NULL;	}
				break;
			case 'Where':
				if(validateIndex($input, 3)) {
					$GLOBALS['question'] = "where";
					$input = pop($input);
					$input = where($input);
				}
				else {	$input = NULL;	}
				break;
			case 'What':
				if(validateIndex($input, 3)) {
					$GLOBALS['question'] = "what";
					$input = pop($input);
					$input = what($input);
				}
				else {	$input = NULL;	}
				break;
			case 'How':
				if(validateIndex($input, 3)){
					$GLOBALS['question'] = "how";
					$input = pop($input);
					$input = how($input);
				}
				else {	$input = NULL;	}
				break;
			case 'Do':
				$GLOBALS['question'] = "do";
				if(validateIndex($input, 2))
					$input = does($input);
				else { $input = NULL; }
				break;
			case 'Does':
				$GLOBALS['question'] = "does";
				if(validateIndex($input, 2))
					$input = does($input);
				else { $input = NULL; }
				break;
			case 'Name':
				$GLOBALS['question'] = "name";
				if(validateIndex($input, 2)){
					$input = pop($input);
					$input = namephrase($input);
				}
				else { $input = NULL; }
				break;
		}

		if(count($input) == 0)
			return respond();
		if(is_null($input)) {
			return NULL;
		}
	}

	//Dakota Pollitt
	//Decide on how to reply based on GLOBAL flags
	//Could use some cleaning
	function respond(){
		//DONE
		//(INT)
		//(DONE) How many beers MYSQL call beers(); and count rows 
		//(DONE) How many breweries MYSQL call breweries(); and count rows
		//(DONE) How many styles MYSQL call styles(); and count rows
		//(DONE) How many beers {brewery} MYSQL call beerOfBrewery("brewery"); and count rows
		//(DONE) How many styles {brewery} MYSQL call stylesByBrewery("brewery"); and count rows
		//(DONE) How many {style} MYSQL call specificStyle("style"); and count rows
		//(DONE) How many {style} {brewery} MYSQL call beersOfStyleFrom("style", "brewery"); and count rows

		//(SPECIFIC)
		//(DONE) How many breweries {brewery} (I like this sentence, but I think we both know it doesn't make much sense) 
		//(DONE) How can (Go to the store)
		//(DONE) How is (I don't know, I don't have taste buds)
		if($GLOBALS['question'] == 'how') {
			switch($GLOBALS['secondWord']) {
				case "many":
					if(isset($GLOBALS['pluralNoun']) && isset($GLOBALS['brewery'])){ //How many styles does Dogfish Head make?
						if($GLOBALS['pluralNoun'] == 'breweries')
							return 'I like this sentence, but I think we both know it doesn\'t make much sense';
						if($GLOBALS['pluralNoun'] == 'styles')
							return mysql_num_rows(qStylesByBrewery($GLOBALS['brewery']));
						return mysql_num_rows(qBeersByBrewery($GLOBALS['brewery']));
					}
					if(isset($GLOBALS['style']) && isset($GLOBALS['brewery']))
						return mysql_num_rows(qBeerOfStyleFrom($GLOBALS['style'], $GLOBALS['brewery']));
					if(isset($GLOBALS['style'])) //How many IPAs do you know
						return mysql_num_rows(qBeerOfStyle($GLOBALS['style']));
					if(isset($GLOBALS['pluralNoun'])) //How many beers do you know
						return mysql_num_rows(qGetAll($GLOBALS['pluralNoun']));
					break;
				case "can":
					return "Go to the store"; //How can I get beer
					break;
				case "is":
					return "I am not sure my Operating System does not allow me to drink alcohol";
					break;
			}
		}
	
		
		//TEST
		//(LIST OF STRINGS)
		//(DONE) What beers MYSQL call beers();
		//(DONE) What beers {brewery} MYSQL call beersByBrewery("brewery");
		//(DONE) What breweries MYSQL call breweries();
		//(DONE) What styles MYSQL call styles();
		//(DONE) What styles {brewery} MYSQL call stylesByBrewery("brewery");
		//(DONE) What {style} MYSQL call specificStyle("style");
		//(DONE) What {style} {brewery} MYSQL call beersOfStyleFrom("style", "brewery");

		//(BEER STRING, CAN BE MULTIPLE)
		//(DONE) What highest beer MYSQL call highestABV();
		//(DONE) What lowest beer MYSQL call lowestABV();
		//(DONE) What highest beer {brewery} MYSQL call highestABVFrom(" brewery");
		//(DONE) What lowest beer {brewery} MYSQL call lowestABVFrom("brewery");
		//(DONE) What highest {style} MYSQL call highestStyle("style");
		//(DONE) What lowest {style} MYSQL call lowestStyle("style");
		//(DONE) What highest {style} {brewery} MYSQL call highestStyleFrom("style", "brewery");
		//(DONE) What lowest {style} {brewery} MYSQL call lowestStyleFrom("style", "brewery");

		//(STYLE STRING)
		//(DONE) What style {beer} MYSQL call getStyle("beer");

		//(GLASSWARE STRING)
		//(DONE) What {glassware} {beer} MYSQL call beerGlass("beer");
		//(DONE) What {glassware} {style} MYSQL call styleGlass("style");

		//(ABV FLOAT)
		//What ABV {beer} MYSQL call ABV("beer");

		//(SPECIFIC)
		//What breweries {brewery} (This kind of thing still doesn't work)
		if($GLOBALS['question'] == 'what') {
			if(isset($GLOBALS['pluralNoun'])) {
				if($GLOBALS['pluralNoun'] == "beers" && isset($GLOBALS['brewery']) == true) {
					$result = "I know alot of beers, but here are just a couple...<br>";
					for($x = 0; $x < 4; $x++) {
						$rand = rand(0, mysql_num_rows(qBeersByBrewery($GLOBALS['brewery'])));
						$result = $result . mysql_fetch_array(qGetABeer($rand))['beername'] . "<br>";
					}
						return $result;
				}
				if($GLOBALS['pluralNoun'] == "styles" && isset($GLOBALS['brewery'])) {
					$result = "I know alot of beers, but here are just a couple...<br>";
					for($x = 0; $x < 4; $x++) {
						$rand = rand(0, mysql_num_rows(qStylesByBrewery($GLOBALS['brewery'])));
						$result = $result . mysql_fetch_array(qGetABeer($rand))['beername'] . "<br>";
					}
						return $result;
				}
				$result = "I know alot of beers, but here are just a couple...<br>";
					for($x = 0; $x < 4; $x++) {
						$rand = rand(0, mysql_num_rows(qGetAll($GLOBALS['pluralNoun'])));
						$result = $result . mysql_fetch_array(qGetABeer($rand))['beername'] . "<br>";
					}
					return $result;
				return qGetAll($GLOBALS['pluralNoun']);
			}
			if(isset($GLOBALS['style']) && $GLOBALS['secondWord'] == "is") { //What IPAs do you know
				if(isset($GLOBALS['breweries'])) { //What IPAs do you know from Dogfish Head
					$result = "I know alot of IPAs, but here are just a couple...<br>";
					for($x = 0; $x < 4; $x++) {
						$rand = rand(0, mysql_num_rows(qBeersOfStyleFrom($GLOBALS['styles'], $GLOBALS['brewery'])));
						$result = $result . mysql_fetch_array(qGetABeer($rand))['beername'] . "<br>";
					}
						return $result;
				}
				else {
				$result = "I know alot of IPAs, but here are just a couple...<br>";
				for($x = 0; $x < 4; $x++) {
					$rand = rand(0, mysql_num_rows(qSpecificStyle($GLOBALS['style'])));
					$result = $result . mysql_fetch_array(qGetABeer($rand))['beername'] . "<br>";
				}
					return $result;
				}
			}
			if(isset($GLOBALS['glassware'])) {
				if(isset($GLOBALS['beer'])) {
					return mysql_fetch_array(qBeerGlass($GLOBALS['beer']))['glassware'];
				}
				if(isset($GLOBALS['style']))
					return mysql_fetch_array(qBeerGlass($GLOBALS['style']))['glassware'];
			}
			switch($GLOBALS['secondWord']) {
				case "is":
					if(isset($GLOBALS['beer'])) {
							return qABV($GLOBALS['beer']);
					}
					break;
				case "highest":
					if(isset($GLOBALS['beer'])){
						if(isset($GLOBALS['brewery']))//Not being set...?
							return mysql_fetch_array(qHighestABVFrom($GLOBALS['brewery']))['beername'];
						return mysql_fetch_array(qHighestABV())['beername'];
					}
					if(isset($GLOBALS['style'])) {
						if(isset($GLOBALS['brewery']))
							return mysql_fetch_array(qHighestABVFrom($GLOBALS['brewery']))['beername'];
						return mysql_fetch_array(qHighestStyle($GLOBALS['style']))['beername'];
					}
					if(isset($GLOBALS['brewery'])){
						return mysql_fetch_array(qHighestABVFrom($GLOBALS['brewery']))['beername'];
						}
					break;
				case "lowest":
					if($GLOBALS['thirdWord'] == "beer") {
						if(isset($GLOBALS['brewery'])) //not being set...?
							return mysql_fetch_array(qLowestABVFrom($GLOBALS['brewery']))['beername'];
						return mysql_fetch_array(qLowestABV())['beername'];
					}
					if(isset($GLOBALS['style'])) {
						if(isset($GLOBALS['brewery']))
							return mysql_fetch_array(qLowestABVFrom($GLOBALS['brewery'])['beername']);
						return mysql_fetch_array(qLowestStyle($GLOBALS['style'])['beername']);
					}
						if(isset($GLOBALS['brewery']))
							return mysql_fetch_array(qLowestBrewery($GLOBALS['brewery']))['beername'];
					break;
				case "style":
					if(isset($GLOBALS['beer']))
						return mysql_fetch_array(qGetStyle($GLOBALS['beer']))['stylename'];
					break;
			}
		//END OF WHAT
		}


		//TEST
		//(DONE)Name beer qGetAll('beers'); pick randomly
		//(DONE)Name beer {brewery} qBeersByBrewery("brewery"); pick randomly
		//(DONE)Name {style} qBeerOfStyle("style"); pick randomly
		//(DONE)Name {style} {brewery} qBeerOfStyleFrom("style", "brewery"); pick randomly
		if($GLOBALS['question'] == 'name') {
			if(isset($GLOBALS['brewery']) && isset($GLOBALS['style'])) {
					$res = qBeerOfStyleFrom($GLOBALS['style'], $GLOBALS['brewery']);
					$max = mysql_num_rows($res);
					$pick = rand(0, $max - 1);
					for($x = 0; $x <= $pick; $x++)
						$row = mysql_fetch_array($res)['beername'];
					if(is_null($row))
						return 'I don\'t know any '.$GLOBALS['style'].'s from '.$GLOBALS['brewery'];
					return $row.' is a(n)'.$GLOBALS['style'].' by '.$GLOBALS['brewery'];
			}
			if(isset($GLOBALS['brewery']) && isset($GLOBALS['secondWord'])) {
					$res = qBeersByBrewery($GLOBALS['brewery']);
					$max = mysql_num_rows($res);
					$pick = rand(0, $max - 1);
					for($x = 0; $x <= $pick; $x++)
						$row = mysql_fetch_array($res)['beername'];
					if(is_null($row))
						return 'I don\'t know any beers from '.$GLOBALS['brewery'];
					return $row.' is a beer by '.$GLOBALS['brewery'];
			}
			if(isset($GLOBALS['style'])){
				$res = qBeerOfStyle($GLOBALS['style']);
				$max = mysql_num_rows($res);
				$pick = rand(0, $max - 1);
				for($x = 0; $x <= $pick; $x++)
					$row = mysql_fetch_array($res)['beername'];
				return $row.' is a(n) '.$GLOBALS['style'];
			}
			if(isset($GLOBALS['secondWord'])){
				$res = qGetAll('beers');
				$max = mysql_num_rows($res);
				$pick = rand(0, $max - 1);
				for($x = 0; $x <= $pick; $x++)
					$row = mysql_fetch_array($res)['beername'];
				return $row.' is a beer';
			}
		}


		//(Y/N)
		//(DONE) Does {brewery} {beer} MYSQL call beersByBrewery("brewery"); and check if {beer} is there
		//(DONE) Does {brewery} {style} MYSQL call stylesByBrewery("brewery"); and check if {style} is there

		//(SPECIFIC)
		//Does {brewery} {brewery} (See, I like this sentence. But we can both agree it doesn't make much sense)
		if($GLOBALS['question'] == 'does') {
			if(isset($GLOBALS['brewery'])) {
				if(isset($GLOBALS['beer']))
					return qBeersByBrewery($GLOBALS['brewery']);
				if(isset($GLOBALS['style']))
					return qStylesByBrewery($GLOBALS['brewery']);
				return "See, I like this sentence. But we can both agree it doesn't make much sense";
			}
		}

		//IMPLEMENT
		//(Y/N)
		//(DONE) Do {beer} MYSQL call beers(); and check for {beer}
		//(DONE) Do {brewery}	MYSQL call breweries(); and check for {brewery}
		//(DONE) Do {style} MYSQL call styles(); and check for {style}
		if($GLOBALS['question'] == 'do') {
			if(isset($GLOBALS['beer']))
				return qGetAll("beers");
			if(isset($GLOBALS['brewery']))
				return qGetAll("breweries");
			if(isset($GLOBALS['style']))
				return qGetAll("styles");
		}


		//HUMANIZED
		//(LOCATION STRING)
		//(DONE)Where {brewery} MYSQL call getLocation("brewery");
		if($GLOBALS['question'] == 'where') {
			if(isset($GLOBALS['brewery'])){
				$res = mysql_fetch_array(qGetLocation($GLOBALS['brewery']))['location'];
				return $GLOBALS['brewery'].' was founded in '. $res. ', which is the only location I keep track of.';
			}
		}

		//HUMANIZED
		//(FOUNDED INT)
		//(DONE)When {brewery} MYSQL call getFounded("brewery");
		if($GLOBALS['question'] == 'when') {
			if(isset($GLOBALS['brewery'])){
				$res = mysql_fetch_array(qGetFounded($GLOBALS['brewery']))['founded'];
				return $GLOBALS['brewery'].' was founded in '. $res .'.';
			}
		}

		//HUMANIZED
		//(Y/N)
		//(DONE) Is {beer} {style} MYSQL call beerOfStyle("style"); and check if {beer} is there
		//(DONE) Is {beer} {brewery} MYSQL call beersByBrewery("brewery"); and check if {beer} is there
		if($GLOBALS['question'] == 'is'){
			if(isset($GLOBALS['beer'])){
				if(isset($GLOBALS['style'])){
					$res = qBeerOfStyle($GLOBALS['style']);
					$max = mysql_num_rows($res) - 1;
					for($x = 0; $x < $max; $x++){
						$row = mysql_fetch_array($res)['beername'];
						if($GLOBALS['beer'] == $row)
							return 'Yes, '.$GLOBALS['beer'].' is a(n) '.$GLOBALS['style'];
					}
					return 'No, '.$GLOBALS['beer'].' is not a(n) '.$GLOBALS['style'];
				}
				if(isset($GLOBALS['brewery'])){
					$res = qBeersByBrewery($GLOBALS['brewery']);
					$max = mysql_num_rows($res) - 1;
					for($x = 0; $x < $max; $x++){
						$row = mysql_fetch_array($res)['beername'];
						if($GLOBALS['beer'] == $row)
							return 'Yes, '.$GLOBALS['beer'].' is brewed by '.$GLOBALS['brewery'];
					}
					return 'No, '.$GLOBALS['beer'].' is not brewed by '.$GLOBALS['brewery'];
				}
			}
		}

		//HUMANIZED
		//(BREWERY STRING)
		//(DONE)Who {beer} MYSQL call getBrewer("beer");
		if($GLOBALS['question'] == 'who'){
			if(isset($GLOBALS['beer'])){
				$res = mysql_fetch_array(qGetBrewer($GLOBALS['beer']))['brewername'];
				return $GLOBALS['beer'].' is brewed by '. $res;
			}
		}

	}


	//Matt Ng
	function who($input) {
		if(!(is_null($temp = presentTense($input)))) {
			return beer($temp);
		}
		if(!(is_null($input = pastTense($input)))) {
			return beer($input);
		}
		return NULL;
	}
	
	//Matt Ng
	function is($input) {
		if(!(is_null($input = beer($input)))) {
			if(!(is_null(pastTense($input)))) {
				$input = pastTense($input);
				if($input[0] == "by") {
					$input = pop($input);
					return brewery($input);
				}
			}
				return specifier($input);
			}
		return NULL;
	}
	
	//Dakota Pollitt
	//Follows the grammar for approved when phrases
	function when($input) {
		if($input[0] == 'was'){
			$input = pop($input);//was is ok, pop it
			$input = brewery($input); //Pop if brewery is good
			if($input[0] == 'founded' || $input[0] == 'started' || $input[0] == 'created')
				return pop($input); //If its good, pop it
		}
		else
			return NULL;
	}
	
	//Matt Ng
	function where($input) {
		if($input[0] == "is") {
			$input = pop($input); //is is ok, pop it
			return brewery($input);//Pop if brewery is good
		}
		if($input[0] == "was") {
			return when($input); //When can handle this
		}
		return NULL;			
	}
	
	//Matt Ng
	function what($input) {
		if(!(is_null(style($input)))) {
			$input = style($input);
			return doPhrase($input);
		}
		if(!(is_null(pluralNoun($input)))){
			$input = pop($input);
			return doPhrase($input);
		}

		if($input[0] == "is") {
			$input = pop($input);
			if($input[0] == "the") {
				$input = pop($input);
				if($input[0] == "ABV" && $input[1] == "of"){
					$input = pop(pop($input));
					return beer($input);
				}
				if(!(is_null($input = degree($input)))) {
					if($input[0] == "ABV") {
						$input = pop($input); 
						if($input[0] == "beer" || !(is_null(style($input)))) {
							$GLOBALS['thirdWord'] = "beer";
							$input = pop($input);
							if(count($input) == 0) {
								return $input;
							}
							return fromClause($input);
						}
					}
				}
				if($input[0] == "ABV" && $input[1] == "of") {
					$input = pop(pop($input)); 
						return beer($input);
				}	
			}
		}
		if($input[0] == "style" && $input[1] == "is") {
			$input = pop(pop($input)); 
				return beer($input);
		}
		if(!is_null($input = glassware($input))) {
			if($input[0] == "drink") {
				$input = pop($input);
				if(!(is_null(beer($input)))) {
					$input = beer($input);
					if ($input[0] == "from")
						return pop($input);
				}
				if(!(is_null(style($input)))){
					$input = style($input);
					if ($input[0] == "from")
						return pop($input);
				}
			}
		}
		return NULL;
	}

	//Matt Ng
	function how($input) {
		if($input[0] == "is") {
			$GLOBALS['secondWord'] = $input[0];
			$input = pop($input);
			return beer($input);
		}
		if($input[0] == "can") {
			$GLOBALS['secondWord'] = $input[0];
			$input = pop($input);
			if(!(is_null(pronoun($input)))) {
				$input = pop($input);
				if($input[0] == "get") {
					$input = pop($input);
					return beer($input);
				}
			}
		}
		if($input[0] == "many") {
			$GLOBALS['secondWord'] = $input[0];
			$input = pop($input);
			if(!(is_null($temp = pluralNoun($input)))) //Check for plural noun before modifying DP
				return dophrase($temp);
			$input = stringSplit($input); //Need to prep for propernoun DP
			$modified = str_split($input[0]);
			if($modified[count($modified) - 1] == "s"){ //Updated trimming DP
				$input[0] = rtrim(implode("", $modified), "s");
			}
			if(!(is_null(style($input))) || !(is_null(pluralNoun($input)))) {
				$input = pop($input);
				return doPhrase($input);
			}
		}
		return NULL;
	}
	
	//Matt Ng
	function does($input) {
		$input = doPhrase($input);
		if(!(is_null($input))) {
			if(!(is_null(beer($input)))) {
				return beer($input);
			}
			if(!(is_null(brewery($input)))) {
				return brewery($input);
			}
			if(!(is_null(specifier($input)))) {
				return specifier($input);
			}
		return NULL;
		}
		return $input; //Should be NULL.
	}
	
	//Matt Ng
	function doPhrase($input) {
		$input[0] = strtolower($input[0]);
		if(count($input) > 2) {
			if($input[0] == "do" && $input[1] == "you" && $input[2] == "know") {
				$input = pop($input);
				$input = pop($input);
				$input = pop($input);
				return $input;
			}
			if($input[0] == "does") {
				$input = pop($input);
					if(!(is_null($input = brewery($input)))) {
						if(!(is_null($input = infinitiveCreate($input)))) {
							return $input;				
				}
				}
			}
		}
		return NULL;
	}
	
	//Dakota Pollitt
	function namePhrase($input) {
		if(($input[0] == "a" || $input[0] == "any") && $input[1] == "beer"){
			$GLOBALS['secondWord'] = $input[1];
			if(count(pop(pop($input))) > 0) //From clause check
				return fromClause(pop(pop($input)));
			else
				return pop(pop($input));
		}
		if(!(is_null($input = specifier($input))))
			if(count($input) > 0) //From clause check
				return fromClause($input);
			else
				return $input;
		return NULL;
	}

	
	//Dakota Pollitt
	//Pops an element from the remaining sentence input if
	//it is a recognized beer
	function beer($input) {
		if(count($input) == 0)
			return NULL;
		$input = stringSplit($input);
		$query = qGetAll('beers');
				
		while($row = mysql_fetch_array($query)){
			$beer = $row['beername'];
			if($input[0] == $beer) {
				$GLOBALS['beer'] = $beer;
				return pop($input);
			}
		}
		return NULL;
	}
	
	//Dakota Pollitt
	//Pops an element from the remaining sentence input if
	//it is a recognized brewery
	function brewery($input) {
		if(count($input) == 0)
			return NULL;
		$input = stringSplit($input);
		$query = qGetAll('breweries');
				
		while($row = mysql_fetch_array($query)){
			$brewery = $row['brewername'];
			if($input[0] == $brewery) {
				$GLOBALS['brewery'] = $brewery;
				return pop($input);
			}
		}
		return NULL;
	}
	
	//Dakota Pollitt
	//Pops an element from the remaining sentence input if
	//it is a recognized style
	function style($input) {
		$input = stringSplit($input); //Need to prep for propernoun DP
		$modified = str_split($input[0]);
		if($modified[count($modified) - 1] == "s"){ //Updated trimming DP
			$input[0] = rtrim(implode("", $modified), "s");
		}
		$query = qGetAll('styles');

		while($row = mysql_fetch_array($query)){
			$style = $row['stylename'];
			if($input[0] == $style) {
				$GLOBALS['style'] = $style;
				return pop($input);
				}
		}
		return NULL;
	}
	
	//Matt Ng
	function validateIndex($input, $str) {
		return count($input) >= $str;
	} 
	
	//Dakota Pollitt
	function pluralNoun($input) {
			if($input[0] == "beers" || $input[0] == "breweries" || $input[0] == "styles") {
				$GLOBALS['pluralNoun'] = $input[0];
				return pop($input);
			}
			else
				return NULL;
	}

	//Matt Ng
	//Checks for appropriate use of a, an, and any for styles, if not return NULL
	function specifier($input) { //Only takes on input now DP
		$temp = pop($input);
		$temp = stringSplit($temp)[0];
		if($input[0] == "any") { //Check if its plural first DP
			$input = pop($input);
			$input = stringSplit($input);
			$temp = str_split($input[0]);
			if($temp[count($temp) - 1] == "s") {
				$input[0] = trim($input[0], "s");
				if(!(is_null($input = style($input))))
					return $input;
				else
					return NULL;
			}
		}
		if($input[0] == "a" && !(in_array($temp[0], $GLOBALS["vowel"]))) {
			$input = pop($input);
			if(!(is_null($input = style($input))))
				return $input;
			else
				return NULL;
		}
		if($input[0] == "an" && in_array($temp[0], $GLOBALS["vowel"])) {
			$input = pop($input);
			if(!(is_null($input = style($input))))
				return $input;
			else
				return NULL;
		}
	}

	//Matt Ng
	function pastTense($input) {
		if($input[0] == "made")
			return pop($input);
		if($input[0] == "brewed")
			return pop($input);
		return NULL;
	}

	//Matt Ng
	function presentTense($input) {
		if($input[0] == 'makes')
			return pop($input);
		if($input[0] == 'brews')
			return pop($input);
		return NULL;
	}

	//Dakota Pollitt
	function pronoun($input) {
		if($input[0] == 'I' || $input[0] == 'he' || $input[0] == 'she' ||
		   $input[0] == 'we' || $input[0] == 'they' || $input[0] == 'you')
			return pop($input);
		else
			return NULL;
	}

	//Dakota Pollitt
	function glassware($input) {
		if($input[0] == 'should') {
			$input = pop($input);
			$GLOBALS['glassware'] = true;
			return pronoun($input);
		}
		if($input[0] == 'do' && $input[1] == 'I'){
			$GLOBALS['glassware'] = true;
			return pop(pop($input));
		}
		return NULL;
	}


	//Matt Ng
	function fromClause($input) {
			if($input[0] == "from") {
				$input = pop($input);
				return brewery($input); 
			}
			return NULL;
	}

	//Matt Ng
	function infinitiveCreate($input) { //Called by doPhrase
		if($input[0] == "make" || $input[0] == "brew")
			return pop($input);
		return NULL;
	}
	
	//Matt Ng
	function degree($input) { //Called by What
		if($input[0] == "highest" || $input[0] == "lowest") {
			$GLOBALS['secondWord'] = $input[0];
			return pop($input);
		}
	}
	
	//Matt Ng
	//If the first letter of the string is capital append characters to a string
	//until it find a string with a lower case character.
	//If the first letter is lower case return the parameter.
	//This function assumes thats the parameter array has at least two indexes.
	function stringSplit($input) {
		$result = "";
		$split = $input;
		for($i = 0; $i < count($input); $i++){
			$split = str_split($input[$i]);
			if(ctype_upper($split[0])) {
				$result = $result . $input[$i] . " ";
			}
			elseif(!(ctype_upper($split[0])))
				break;

		}

		$result = trim($result, " ");
		$size = count(explode(" ", $result)); //Count the number of words in result.
		if($size == 0) {
			return NULL; //Returns NULL if user forgot to capitalize
		}
		for($i = 0; $i < $size; $i++ ) { //unset all the indecies of the array matching the # of words
			unset($input[$i]);
		}
		if(!(is_null($input)))
			array_unshift($input, $result); //Prepends new element to the front of the list, fixed reversal DP
		return $input; //Return in
	}

	//Matt Ng
	//Pops the first element in the array
	function pop($input) {
		unset($input[0]); //An array is NULL if it has been unset()...
		if(!(is_null($input)))
			return array_values($input); //If this is empty we are done, return true;
		else
			return NULL;
	}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<!--Replace link with good web font you want.<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css' /> - See more at: http://www.newthinktank.com/2011/09/how-to-layout-a-website/#sthash.lWAaNgcS.dpuf -->

<link rel="stylesheet" type="text/css" href="stylesheet.css">

<!--<div class='error' style='display:none'>Event Created</div>-->

<title>Beer Bot</title>

</head>

<body bgcolor="#000">
	<div id = "content">
		<div class = "center">
			<img src = "beerBotPicture.JPG" width = "182px" height = "200px" id = "img"/>
			<table style = "width: 100%">
			<?php

			if(isset($_POST['inputbox'])) {
				$input = $_POST['inputbox'];
				print ('<tr> <td><span style = "color: green; font-weight: bold">User: </span></td> <td>' . $input . '</td> </tr>');

				if(ctype_upper($input)) {
					print('<tr> <td><span style = "color: red; font-weight: bold">Beer Bot: </span></td> <td> Stop yelling at me! </td> </tr>');
				}
				$input = trim($input);
				$arrayInput = explode(" ", $input);//explode is similar to .split(" ")
				for($x = 0; $x < count($arrayInput); $x++) {
					$arrayInput[$x] = parseString($arrayInput[$x]);//Format the string
				}
				$arrayInput[0] = ucfirst($arrayInput[0]);//Make the first letter uppercase

				if(!(is_null($result = interpret($arrayInput)))){
					print('<tr> <td><span style = "color: red; font-weight: bold">Beer Bot: </span></td> <td>' . $result . ' </td> </tr>' );
				}
				else {
					if($input == ""){
						print('<tr> <td><span style = "color: red; font-weight: bold">Beer Bot: </span></td> <td> You said nothing...absolutely nothing... </td> </tr>' );
						}
						elseif(in_array($input, $GLOBALS["greet"])) {
						print '<tr> <td><span style = "color: red; font-weight: bold">Beer Bot: </span></td> <td>' . $greet[rand(0, count($greet) - 1)] . ' </td> </tr>' ;
						}
						elseif(in_array($input, $GLOBALS["bye"])) {
							print '<tr> <td><span style = "color: red; font-weight: bold">Beer Bot: </span></td> <td>' . $bye[rand(0, count($bye) - 1)] . ' </td> </tr>' ;
						}
						else
							print('<tr> <td><span style = "color: red; font-weight: bold">Beer Bot: </span></td> <td>' . $notSure[rand(0, count($notSure) - 1)]) . ' </td> </tr>' ;//Randomize a not sure response.
				}

			}

			?>
			</table>
			
			<form action = "" method="POST">
				<input type = "text" name = "inputbox" size="30%" />
				<input type = "submit" value="Submit" />
			</form>
				</div>
				
				<div id = "howTo">
					<div id = "title">Hello, I am Beer Bot.</div>
					<span style = "font-weight: bold; font-size: 14pt;">User Instructions: </span>
					<br>
					Beer Bot is a highly intelligent robot with a large knowledge base of beers.  
					Unfortunetely he does not have a large knowledge of anything else.  
					If you try to ask it anything else you most likely just confuse it, it will mostly answer your questions about beer.
					It is also very picky about grammer!
					<br><br>
					<span style = "font-size:14pt;">Here are some valid inputs:</span>
					<br>
					Where is Dogfish Head. <br>
					When was DuClaw founded? <br>
					Where was Samuel Adams started? <br>
					Who makes Sixty-One? <br>
					What IPAs does Dogfish Head make? <br>
					<br>
					<span style = "font-style: italic"> Keep your inputs along these lines and Beer Bot should understand! </span>
					<br><br>
					<span style = "font-style: italic">Created by Matthew Ng, Dakota Pollitt</span>
					</div>
		</div>
	</div>
	
</body>

</html>
