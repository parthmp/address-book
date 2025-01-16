<?php
    
    namespace Libs;

    class Helper{

        public static function view($view, $var = []){

            $view_file = '.'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$view.'.php';
            
            if(!file_exists($view_file)){
                die('View file does not exist');
            }

            require_once $view_file;

        }

        public static function makeModel($name){

            $model_file = '.'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.$name.'.php';
            if(file_exists($model_file)){
                require_once $model_file;
            }
        }

        public static function getRootURL(){

            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            
            $host = $_SERVER['HTTP_HOST'];
            
            $base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
            
            $rootUrl = $protocol.'://'.$host.$base_path;
            
            return $rootUrl;

        }

        public static function link($url){  

            $root_url = Self::getRootURL();
            return $root_url.'/'.$url;

        }

        public static function redirect($url, $permanent = false){
            if (headers_sent() === false){
                header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
            }

            exit();
        }

    }