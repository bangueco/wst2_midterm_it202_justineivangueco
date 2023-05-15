<?php
require_once('../class/accounts.class.php');
require_once('../class/chatroom.class.php');

$Accounts = new Accounts;
$Chatroom = new Chatroom;

if ($_GET['action'] == 'login') echo $Accounts->login($_POST);
if ($_GET['action'] == 'register') echo $Accounts->register($_POST);
if ($_GET['action'] == 'logout') echo $Accounts->logout();
if ($_GET['action'] == 'send') echo $Chatroom->send($_POST);
if ($_GET['action'] == 'fetch') echo $Chatroom->fetchMsg();