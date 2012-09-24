<?php session_start();
	foreach (array("main","base") as $key) { 
		$f='class/class_'.$key.'.php'; 
		if (file_exists($f)) { include_once($f); } 
	}
	if (class_exists("main")) { 
		$main=new main;	
		echo $main->engine(); 
		unset($main);
	}
?>
