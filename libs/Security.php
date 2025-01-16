<?php

	namespace Libs;

	class Security{
		
		public static function strip($string, $trim = true){
			
			$string = strip_tags($string);
			$string = stripslashes($string);
			if($trim == true){
				$string = trim($string);
			}
			return $string;
			
		}
		
	}