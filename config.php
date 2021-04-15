<?php

class config {

    public static function connect(){

        $dsn = 'mysql:host=localhost;dbname=ca2database';
        $username = 'root';
        $password = '';
        $message = "";
        
        try {
            $con = new PDO($dsn,$username,$password);

            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

        }catch(PDOException $error){
            $message = $error->getMessage();
        }

        return $con;
    }
}

?>