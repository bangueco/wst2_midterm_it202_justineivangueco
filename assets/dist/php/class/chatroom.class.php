<?php

class Chatroom {
    public function send($data) {
        session_start();

        $id = $_SESSION['auth'][0]['id'];

        $connect = new PDO("mysql:host=localhost;dbname=echat", 'admin', 'root');
        $query = "INSERT INTO messages(account_id, message) VALUES(:account_ID, :message)";
        $send_msg = $connect->prepare($query);
        $send_msg->bindValue('account_ID', $id);
        $send_msg->bindValue('message', $data['message']);
        $send_msg->execute();
    }

    public function fetchMsg() {
        session_start();

        $id = $_SESSION['auth'][0]['id'];

        $connect = new PDO('mysql:host=localhost;dbname=echat', 'admin', 'root');
        $query = "SELECT accounts.id, accounts.name, accounts.email, accounts.type, messages.account_ID, messages.message, messages.timestamp FROM accounts INNER JOIN messages ON messages.account_ID = accounts.id;";
        $fetcher = $connect->prepare($query);
        $fetcher->execute();

        $info = $fetcher->fetchAll(PDO::FETCH_ASSOC);

        $html = '';

        foreach($info as $message) {
            if ($id == $message['account_ID']) {
                $html.='<div class="your-box">
                <div class="box-bg-you">
                    <div class="you">You</div>
                    <div id="delete"><i class="fa-solid fa-trash"></i></div>
                    <p class="your-message">'.$message['message'].'</p>
                    <p class="time-stamp">'.$message['timestamp'].'</p>
                </div>
            </div>';
            } else {
                $html.='
            <div class="others-box">
                <div class="box-bg-others">
                    <div class="others-username"><a href="profile.php?profile='.$message['email'].'">'.$message['name'].'</a></div>
                    <p class="others-message">'.$message['message'].'</p>
                    <p class="time-stamp">'.$message['timestamp'].'</p>
                </div>
            </div>
            ';
            }
        }

        echo $html;
    }
}