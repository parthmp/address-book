<?php

    namespace Controllers;

    use \Models\testModel;

    class Main{

        public function index(){
            //echo '<pre>',print_r($_GET),'</pre>';

            /* testing models */
            //\Helper::makeModel('testModel');
            $t1 = new testModel();
            $rows = $t1->testme();

            
            return \Helper::view('test_view', $rows);
        }

    }
