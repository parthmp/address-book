<?php

    namespace Models;

    use \Libs\Connection;
    use \Libs\Security;

    class DBOperations extends Connection{

        public function fetchCities(){
			
			$sql = $this->query("SELECT * FROM `cities` ORDER BY `city_name` ASC");
			
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
            
		}


        public function addNewAddress($temp_post){

            $name = Security::strip($temp_post['name'], true);
            $first_name = Security::strip($temp_post['first_name'], true);
            $email = Security::strip($temp_post['email'], true);
            $street = Security::strip($temp_post['street'], true);
            $zip = Security::strip($temp_post['zip'], true);
            $city = Security::strip($temp_post['city'], true);

            $this->query("INSERT INTO `addresses` VALUES(null, :city_id, :t_name, :first_name, :email, :street, :zip, now(), now())", ['city_id' => $city, 't_name' => $name, 'first_name' => $first_name, 'email' => $email, 'street' => $street, 'zip' => $zip]);

        }

        public function fetchAddresses(){

            $sql = $this->query("SELECT * FROM `addresses` ORDER BY `id` DESC");
			
            return $sql->fetchAll(\PDO::FETCH_ASSOC);

        }

    }