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

            if($name != '' && $first_name != '' && $email != '' && $street != '' && $zip != '' && $city != '' && filter_var($email, FILTER_VALIDATE_EMAIL)){
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

        public function edit(){
            
            $address_id = Helper::getSegmentId();
            
            if($address_id == ''){
                Helper::redirect(Helper::link('main/index'));
            }

            $op = new DBOperations();

            $address = $op->fetchAddressByID($address_id);

            if(empty($address)){
                Helper::redirect(Helper::link('main/index'));
            }
            
            $data['cities'] = $op->fetchCities();
            $data['address'] = $address;
            
            return Helper::view('edit', $data);

        }

        public function edit_submit(){

            if(!isset($_POST['address_id'])){
                Helper::redirect(Helper::link('main/index'));
            }

            $address_id = $_POST['address_id'];

            $op = new DBOperations();

            $address = $op->fetchAddressByID($address_id);

            if(empty($address)){
                Helper::redirect(Helper::link('main/index'));
            }

            if($this->validateForm($_POST)){

                $op = new DBOperations();
                $op->updateAddress($_POST, $address_id);

                Flash::make('Address updated successfully.', 1);
                Helper::redirect(Helper::link('main/index'));

            }else{
                
                Flash::store($_POST);
                Flash::make('Please enter valid details.');
                Helper::redirect(Helper::link('main/edit/'.$address_id));
            }

        }

        public function delete(){

            $address_id = Helper::getSegmentId();
            
            if($address_id == ''){
                Helper::redirect(Helper::link('main/index'));
            }

            $op = new DBOperations();

            $address = $op->fetchAddressByID($address_id);

            if(empty($address)){
                Helper::redirect(Helper::link('main/index'));
            }

            $op->deleteAddressByID($address_id);

            Flash::make('Address removed successfully.', 1);
            Helper::redirect(Helper::link('main/index'));


        }

        public function export_xml(){

            $op = new DBOperations();

            $results = $op->fetchAddresses();

            $xml = new \DOMDocument('1.0', 'UTF-8');
            $xml->formatOutput = true;
            
            
            $root = $xml->createElement('data');
            $root = $xml->appendChild($root);
            
            
            foreach($results as $row) {
                $record = $xml->createElement('record');
                foreach($row as $key => $value) {
                    $node = $xml->createElement($key);
                    $nodeText = $xml->createTextNode(htmlspecialchars($value));
                    $node->appendChild($nodeText);
                    $record->appendChild($node);
                }
                $root->appendChild($record);
            }
            
            
            header('Content-Type: application/xml');
            header('Content-Disposition: attachment; filename="export.xml"');
            header('Content-Length: ' . strlen($xml->saveXML()));
            header('Cache-Control: no-cache');
            header('Pragma: no-cache');
            
            
            echo $xml->saveXML();

        }

        public function export_json(){

            $op = new DBOperations();

            $results = $op->fetchAddresses();

            $jsonData = json_encode(
                [
                    'data' => $results
                ], 
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            );
            
            
            // Set headers for download
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="export.json"');
            header('Content-Length: ' . strlen($jsonData));
            header('Cache-Control: no-cache');
            header('Pragma: no-cache');
            
            // Output JSON
            echo $jsonData;

        }

    }
