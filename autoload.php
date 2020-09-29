<?php

spl_autoload_register(function ($class) {

	$prefix   = 'Amautor\\';
	$base_dir = __DIR__ . '/includes/';
	$len      = strlen($prefix);

	if( strncmp($prefix, $class, $len) !== 0 ){
		return;
	}

	$relative_class = strtolower( substr($class, $len) ) ;
    $relative_class = str_replace( '_', '-', $relative_class );

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

	if( file_exists($file) ){
		require_once $file;
	}
});