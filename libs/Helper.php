<?php

    class Helper{

        public static function view($view, $var){

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

    }