<?php
    session_start();
    $connect = new PDO("mysql:host=localhost;dbname=echat", 'admin', 'root');
    $query = "SELECT id, name, email, password, type FROM accounts WHERE email=:email";

    $profile = $connect->prepare($query);
    $profile->bindValue('email',$_GET['profile']);
    $profile->execute();

    $records = $profile->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        if ($records[0]['id'] == $_SESSION['auth'][0]['id']) {
            echo 'Your';
        } else {
            echo $records[0]['name'].'\'s';
        }
    ?> Profile</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/profile.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center profile container">
        <div class="profile-container p-3">
            <?php
                if ($records[0]['id'] == $_SESSION['auth'][0]['id']) {
                    echo '<h1>Your Profile Information</h1>';
                } else {
                    echo '<h1>'.$records[0]['name'].'\'s Profile'.' Information</h1>';
                }
            ?>
            <div class="profile-info text-center">
                <p>Full Name: <?php 
                if ($records[0]['id'] == $_SESSION['auth'][0]['id']) {
                    echo $_SESSION['auth'][0]['name'];
                } else {
                    echo $records[0]['name'];
                }?>
                </p>
                <p>Email: <?php if ($records[0]['id'] == $_SESSION['auth'][0]['id']) {
                    echo $_SESSION['auth'][0]['email'];
                } else {
                    echo $records[0]['email'];
                }?></p>
                <a class="btn btn-danger" href="chatroom.php">Back</a>
            </div>
        </div>
    </div>
</body>
</html>