<?php
define("DATABASE_HOST", "localhost");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "CDTJD49E42FHM");
define("DATABASE_NAME", "cplssubscriptions");

mysql_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD)

//mysql_connect('localhost', 'root', 'CDTJD49E42FHM', 'cplssubscriptions')
    or die('Error connecting to the database.');
//mysql_select_db('cplssubscriptions')
mysql_select_db(DATABASE_NAME)
    or die('Error');

$path = dirname(__FILE__);//__FILE__ gives the full path to init.inc.php

include("{$path}/inc/mail.inc.php");

?>