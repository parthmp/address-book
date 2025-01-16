<?php

    namespace Controllers;

    use \Models\DBOperations;
    use Libs\Helper;
    use Libs\Security;
    use Libs\Flash;

    class Main{

        public function index(){
            
            $op = new DBOperations();
            $data['addresses'] = $op->fetchAddresses();

            Helper::view('index', $data);

        }

        public function create(){

            $op = new DBOperations();
            $data['cities'] = $op->fetchCities();
            
            return Helper::view('create', $data);

        }

        private function validateForm($temp_post){

            if(!isset($temp_post['name']) || !isset($temp_post['first_name']) || !isset($temp_post['email']) || !isset($temp_post['street']) || !isset($temp_post['zip']) || !isset($temp_post['city'])){
                return false;
            }

            $name = Security::strip($temp_post['name'], true);
            $first_name = Security::strip($temp_post['first_name'], true);
            $email = Security::strip($temp_post['email'], true);
            $street = Security::strip($temp_post['street'], true);
            $zip = Security::strip($temp_post['zip'], true);
            $city = Security::strip($temp_post['city'], true);

            if($name != '' && $first_name != '' && $email != '' && $street != '' && $zip != '' && $city != '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $zip >= 10000 && $zip <= 999999){
                return true;
            }else{
                return false;
            }

        }

        public function create_submit(){

            if($this->validateForm($_POST)){
                
                $op = new DBOperations();
                $op->addNewAddress($_POST);

                Flash::make('Address added successfully.', 1);
                Helper::redirect(Helper::link('main/index'));

            }else{
                
                Flash::store($_POST);
                Flash::make('Please enter valid details.');
                Helper::redirect(Helper::link('main/create'));
            }
            
        }

    }
