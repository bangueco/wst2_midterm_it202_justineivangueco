<?php

class Chatroom {
    public function send($data) {
        session_start();

        $id = $_SESSION['auth'][0]['id'];

        $connect = new PDO("mysql:host=localhost;dbname=echat", 'admin', 'root');
        $query = "INSERT INTO chats(account_id, message) VALUES(:account_ID, :message)";
        $send_msg = $connect->prepare($query);
        $send_msg->bindValue('account_ID', $id);
        $send_msg->bindValue('message', $data['message']);
        $send_msg->execute();
    }

    public function fetchMsg() {
        session_start();

        $id = $_SESSION['auth'][0]['id'];

        $connect = new PDO('mysql:host=localhost;dbname=echat', 'admin', 'root');
        $query = "SELECT accounts.id, accounts.name, accounts.username, accounts.type, chats.account_ID, chats.message FROM accounts INNER JOIN chats ON chats.account_ID = accounts.id;";
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
                </div>
            </div>';
            } else {
                $html.='
            <div class="others-box">
                <div class="box-bg-others">
                    <div class="others-username"><a href="profile.php?profile='.$message['username'].'">'.$message['username'].'</a></div>
                    <p class="others-message">'.$message['message'].'</p>
                </div>
            </div>
            ';
            }
        }

        echo $html;
    }
}