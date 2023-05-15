<?php

class Accounts {
    public function login($data) {
        session_start();
        $connect = new PDO("mysql:host=localhost;dbname=echat", "admin", "root");
        $query = "SELECT id, name, email, password, type FROM accounts WHERE email=:email and password=:password";

        $login = $connect->prepare($query);
        $login->bindValue('email',$data['email']);
        $login->bindValue('password',$data['password']);
        $login->execute();

        $records = $login->fetchAll();
        if(count($records) == 0 ){
            echo 'Invalid credentials';
        }else {
            $_SESSION['auth'] = $records;
            echo 'Login Success';
        }
    }

    public function register($data) {
        $connect = new PDO("mysql:host=localhost;dbname=echat", "admin", "root");
        
        $query = "SELECT * FROM accounts WHERE email=:email";

        $dup_check = $connect->prepare($query);
        $dup_check->bindValue('email', $data['email']);
        $dup_check->execute();

        $records = $dup_check->fetchAll();

        if(count($records)) {
            echo "Email Does Exist";
        } else {
            $query = "INSERT INTO accounts(name, email, password) VALUES(:name, :email, :password)";
    
            $register = $connect->prepare($query);
            $register->bindValue('name',$data['name']);
            $register->bindValue('email',$data['email']);
            $register->bindValue('password',$data['password']);
            $register->execute();
    
            echo 'Registration Success';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
    }
}