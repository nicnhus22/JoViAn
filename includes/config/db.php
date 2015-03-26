<?php 

$whitelist = array(
    '127.0.0.1',
    'localhost',
    '::1'
);

if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	$dbHost = '127.0.0.1';
	$dbDatabase = 'kgc353_4';
	$dbUser = 'root';
	$dbPass = 'root';
} else {
	$dbHost = 'clipper.encs.concordia.ca';
	$dbDatabase = 'kgc353_4';
	$dbUser = 'kgc353_4';
	$dbPass = 'janv001';
}

?>