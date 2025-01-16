<?php

    namespace Models;

    use \Libs\Connection;

    class testModel extends Connection{

        public function testme(){
			
			
			
			$sql = $this->query("SELECT * FROM `testtable`");
			
            return $sql->fetch(\PDO::FETCH_ASSOC);
            
		}

    }