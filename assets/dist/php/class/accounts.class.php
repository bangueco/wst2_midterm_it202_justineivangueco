<?php

class Accounts {
    public function login($data) {
        session_start();
        $connect = new PDO("mysql:host=localhost;dbname=echat", "admin", "root");
        $query = "SELECT id, name, username, password, type FROM accounts WHERE username=:username and password=:password";

        $login = $connect->prepare($query);
        $login->bindValue('username',$data['username']);
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
        
        $query = "SELECT * FROM accounts WHERE username=:username";

        $dup_check = $connect->prepare($query);
        $dup_check->bindValue('username', $data['username']);
        $dup_check->execute();

        $records = $dup_check->fetchAll();

        if(count($records)) {
            echo "Username Does Exist";
        } else {
            $query = "INSERT INTO accounts(name, username, password) VALUES(:name, :username, :password)";
    
            $register = $connect->prepare($query);
            $register->bindValue('name',$data['name']);
            $register->bindValue('username',$data['username']);
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