<?php

if (! function_exists('getId')) {
	function getId($str){
		$i = 0;
		for($x = 0;$x < strlen($str);$x++){
			if($str[$x]=='-'){
				$i = $x;
			}
		}
		return substr($str,$i+1);
	}
}