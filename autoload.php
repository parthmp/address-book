<?php

    require_once 'config.php';
    require_once '.'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Connection.php';
    require_once 'app.php';

    autoload('libs');
    autoload('models');
	
    function autoload($dir){
		
		global $_GLOBAL;
		global $_DB;
		
		if(is_dir($dir) && file_exists($dir)){
			
			$handle = opendir($dir);
		
			while($file = readdir($handle)){
				$file = trim($file);
				if($file != '' && $file != '.' && $file != '..'){
					require_once $dir.'/'.$file;
				}
			}
			
		}

	}