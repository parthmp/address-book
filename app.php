<?php

    class App{

        /* Initiate the app */
        public function startApp(){

            $parsed = $this->parseUrl();
           
            $parsed['lastTwoSegments'] = array_filter($parsed['lastTwoSegments']);
            
            
            $controller_file_name = 'main';
            if(isset($parsed['lastTwoSegments'][0])){
                $controller_name = $parsed['lastTwoSegments'][0];
            }

            $method_name = 'index';
            if(isset($parsed['lastTwoSegments'][1])){
                $method_name = $parsed['lastTwoSegments'][1];
            }
            
            $controller_file = '.'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.''.$controller_file_name.'.php';
            
            if(!file_exists($controller_file)){
                die('Error 404');
            }

            require_once $controller_file;

            $namespace = '\\Controllers';
            $controller_name = 'Main';

            $className = $namespace . '\\' . $controller_name;
            $obj = new $className;

            if(!method_exists($obj, $method_name)){
                die('Error 404');
            }

            parse_str($parsed['getVariables'], $_GET);
            
            call_user_func([$obj, $method_name]);
            
        }

        private function getProtocol(){

            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            return $protocol;

        }

        private function getRootURL(){

            $protocol = $this->getProtocol();
            
            $host = $_SERVER['HTTP_HOST'];
            
            $base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
            
            $rootUrl = $protocol.'://'.$host.$base_path;
            
            return $rootUrl;

        }

        private function parseUrl(){

            $protocol = $this->getProtocol();

            $full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            
            $url_parts = parse_url($full_url);
            $baseUrl = $url_parts['scheme'].'://'.$url_parts['host'].$url_parts['path'];
            $get_variables = isset($url_parts['query']) ? $url_parts['query'] : '';
            
            $path1_ray = str_ireplace($this->getRootURL(), '', $baseUrl);
            
            $segments = explode('/', trim($path1_ray, '/'));
            $last_segments = array_slice($segments, -2);
            
            return [
                'fullUrl' => $full_url,
                'baseUrl' => $baseUrl,
                'getVariables' => $get_variables,
                'lastTwoSegments' => $last_segments
            ];

        }


    }