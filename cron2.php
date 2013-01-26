<?php

require 'app/Mage.php';

if (! Mage::isInstalled ()) {
	echo "Application is not installed yet, please complete install wizard first.";
	exit ();
}
Mage::app ();

if (php_sapi_name () !== 'cli') {
	echo "This can be run only with command-line.";
	exit ();
}

if ($argc < 3) {
	echo "Using {$argv[0]} modelClass method [param] [param] ... ";
	exit ();
}
$argc -= 3;
$modelClass = $argv [1];
$method = $argv [2];
array_splice ( $argv, 0, 3 );

call_user_func ( array (
		Mage::getModel ( $modelClass ),
		$method 
), $argv, $argc );

?>
DONE