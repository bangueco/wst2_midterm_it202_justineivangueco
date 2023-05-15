<?php
    // Automatically Create Database but also need to create a user named admin defined with password root
    require_once("./assets/dist/php/class/database.class.php");
    $Database = new Database;
    $Database->createDatabase("echat"); // if database not exists, create
    $Database->createTable("accounts"); // if table not exists, create
    $Database->createTable("messages"); // if table not exists, create
?>

<?php
    // Check if session does exists and if it does it will redirect to chatroom
    session_start();
    if (isset($_SESSION['auth'])) header("Location: ./assets/dist/php/pages/chatroom.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Chat</title>

    <link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/dist/css/style.css">
</head>
<body>
    <main class="d-flex justify-content-around align-items-center">
        <div class="logo-container">
            <p class="logo">E-CHAT</p>
            <p class="desc">A public chatroom for everyone around the globe</p>
        </div>
        <form id="login-form">
            <p class="invi login-msg-status">P</p>
            <div class="form-group mb-3">
                <input class="form-control form-control-lg" type="text" name="username" id="user_name" placeholder="Username">
            </div>
            <div class="form-group mb-3">
                <input class="form-control form-control-lg" type="password" name="password" id="user_pass" placeholder="Password">
            </div>
            <div class="d-flex">
                <button type="button" class="align-self-start btn btn-success btn-lg login mb-4">Login</button>
            </div>
            <p class="register-desc">Don't have account yet? <span><a href="./assets/dist/php/pages/register.php">Register</a> here</span></p>
        </form>
    </main>

    <script src="./assets/dist/js/jquery.js.js"></script>
    <script src="./assets/dist/js/index.js"></script>
</body>
</html>