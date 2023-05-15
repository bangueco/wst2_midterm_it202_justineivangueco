<?php

class Database {
    public function createDatabase(string $dbname) {
        $connect = new PDO("mysql:host=localhost;", "admin", "root");
        $query = "CREATE DATABASE IF NOT EXISTS $dbname";
        $query_execute = $connect->prepare($query);
        $query_execute->execute();
    }

    public function createTable(string $table) {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $connect = new PDO("mysql:host=localhost;dbname=echat", "admin", "root", $options);

        if ($table == "accounts") {
            $sql = "CREATE TABLE IF NOT EXISTS $table (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(100) NOT NULL,
                password VARCHAR(100) NOT NULL,
                name VARCHAR(100) NOT NULL,
                type enum('user','admin') DEFAULT 'user',
                timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            $connect->exec($sql);
        } else if ($table == "messages") {
            $sql = "CREATE TABLE IF NOT EXISTS $table (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                account_ID INT NOT NULL,
                message VARCHAR(255),
                timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT fk_chats_accounts_id FOREIGN KEY (account_ID) REFERENCES accounts(id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            $connect->exec($sql);
        }
    }

    public function deleteMsg($message_id) {
        $connect = new PDO("mysql:host=localhost;dbname=echat", "admin", "root");
        $sql = "DELETE FROM messages WHERE messages.id = :message_id";

        $delete = $connect->prepare($sql);
        $delete->bindValue('messsage_id', $message_id);
        $delete->execute();

        echo $message_id;
    }
}