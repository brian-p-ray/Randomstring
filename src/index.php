<?php
	function __autoload($class_name) {
	    include 'Randomstring.php';
	}
	use monodesigns\Randomstring;

	print_r(Randomstring::generate());