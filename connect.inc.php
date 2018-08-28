<?php

$conn_err='Could not connect to database';

$mysql_server='mysql9.000webhost.com';
$mysql_user='a6117478_nitesh';
$mysql_pass='library123';

$mysql_db='a6117478_test1';

if(!mysql_connect($mysql_server,$mysql_user,$mysql_pass) || !mysql_select_db($mysql_db))
	die($conn_err);


?>

