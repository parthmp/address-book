<?php

    class App{

        /* Initiate the app */
        public function startApp(){

            $parsed = $this->parseUrl();
            //echo '<pre>',print_r($parsed),'</pre>';
            //die();
            $parsed['lastTwoSegments'] = array_filter($parsed['lastTwoSegments']);
            
            $controller_file_name = 'Main';
            if(isset($parsed['lastTwoSegments'][0])){
                $controller_file_name = ucfirst($parsed['lastTwoSegments'][0]);
            }

            $method_name = 'index';
            if(isset($parsed['lastTwoSegments'][1])){
                $method_name = $parsed['lastTwoSegments'][1];
            }
            
            $controller_file = '.'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.''.$controller_file_name.'.php';
            //die($controller_file);
            if(!file_exists($controller_file)){
                die('Error 404');
            }

            require_once $controller_file;

            $namespace = '\\Controllers';
            
            $className = $namespace.'\\'.$controller_file_name;
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

        private function parseUrl() {

            $protocol = $this->getProtocol();
            $full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $url_parts = parse_url($full_url);
            $baseUrl = $url_parts['scheme'].'://'.$url_parts['host'].$url_parts['path'];
            $get_variables = isset($url_parts['query']) ? $url_parts['query'] : ''; 

            $root_url = \Libs\Helper::getRootURL();

            $filtered_url = str_ireplace($root_url, '', $baseUrl);
            $filtered_url = trim($filtered_url, '/');

            $filtered_url_array = explode('/', $filtered_url);

            $last_segments = [];

            if(isset($filtered_url_array[0])){
                array_push($last_segments, $filtered_url_array[0]);
            }
            if(isset($filtered_url_array[1])){
                array_push($last_segments, $filtered_url_array[1]);
            }

            $last_segments = array_filter($last_segments);
            
            return [
                'fullUrl' => $full_url,
                'root_url' => $root_url,
                'filtered_url' => $filtered_url,
                'baseUrl' => $baseUrl,
                'getVariables' => $get_variables,
                'lastTwoSegments' => $last_segments
            ];

        }

        /*private function parseUrl() {
            $protocol = $this->getProtocol();
            $full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            
            $url_parts = parse_url($full_url);
            $baseUrl = $url_parts['scheme'].'://'.$url_parts['host'].$url_parts['path'];
            $get_variables = isset($url_parts['query']) ? $url_parts['query'] : '';
            
            // Remove the root URL
            $path = str_ireplace(\Libs\Helper::getRootURL(), '', $baseUrl);
            $path = str_ireplace(['http:', 'https:'], '', $path);
            
            // Split the path into segments and remove empty values
            $segments = array_filter(explode('/', trim($path, '/')), 'strlen');
            
            // Get the last two segments if they exist
            $last_segments = [];
            //if (count($segments) >= 2) {
                // Remove any numeric segments at the end (like IDs)
                $filtered_segments = array_filter($segments, function($segment) {
                    return !is_numeric($segment);
                });
                
                // Convert to array to reset keys
                $filtered_segments = array_values($filtered_segments);
                
                // Get last two non-numeric segments
                $count = count($filtered_segments);
                $last1 = '';
                if(isset($filtered_segments[$count - 1])){
                    $last1 = $filtered_segments[$count - 1];
                }
                $last2 = '';
                if(isset($filtered_segments[$count - 2])){
                    $last2 = $filtered_segments[$count - 2];
                }
               // if ($count >= 2) {
                    $last_segments = [
                        $last2,  // Second to last segment
                        $last1   // Last segment
                    ];
                //}
           // }
            $last_segments = array_filter($last_segments);
            $root_url = trim(\Libs\Helper::getRootURL(), '/\\');
            $baseUrl = trim($baseUrl, '/\\');
            
            // Check if we're at the root URL
            if ($baseUrl == $root_url) {
                $last_segments = [];
            }
            
            return [
                'fullUrl' => $full_url,
                'baseUrl' => $baseUrl,
                'getVariables' => $get_variables,
                'lastTwoSegments' => $last_segments
            ];
        }*/


    }