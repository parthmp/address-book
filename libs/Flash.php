<?php

	namespace Libs;
	
	class Flash{
		
		public static function make($string, $indie = ERROR_MSG){
			
			if($indie == ERROR_MSG){
				$html = '<div class="alert alert-danger error_msg">
							<strong><i class="fa fa-close"></i>&nbsp;Error!</strong>
							
							'.$string.'
						</div>';
			}else if($indie == SUCCESS_MSG){
				$html = '<div class="alert alert-success error_msg">
							<strong><i class="fa fa-check"></i>&nbsp;Success!</strong>
							
							'.$string.'
						</div>';
			}else if($indie == WARNING_MSG){
				$html = '<div class="alert alert-warning error_msg">
							<strong><i class="fa fa-exclamation-triangle"></i>&nbsp;Warning!</strong>
							
							'.$string.'
						</div>';
			}else if($indie == INFO_MSG){
				$html = '<div class="alert alert-info error_msg">
							<strong><i class="fa fa-check-circle-o"></i>&nbsp;Info!</strong>
							
							'.$string.'
						</div>';
			}
			
			$_SESSION['FLASH_MSG'] = $html;
			
		}
		
		public static function show(){
			if(isset($_SESSION['FLASH_MSG'])){
				echo $_SESSION['FLASH_MSG'];
				unset($_SESSION['FLASH_MSG']);
			}
		}

		public static function store($post_fields){
			$_SESSION['post'] = $post_fields;
		}

		public static function check($field){
			if(isset($_SESSION['post'][$field])){
				return true;
			}else{
				return false;
			}
		}

		public static function use($key){
			$temp = $_SESSION['post'][$key];
			unset($_SESSION['post'][$key]);
			return $temp;
		}

		public static function release(){
			unset($_SESSION['post']);
		}
		
	}