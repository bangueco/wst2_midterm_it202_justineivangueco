<?php
    // Check if session does exists and if it does it will redirect to chatroom
    session_start();
    if (isset($_SESSION['auth'])) header("Location: chatroom.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | E-Chat</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/all.css">
</head>
<body>
    <main class="d-flex justify-content-center align-items-center">
        <form id="register-form">
            <a class="btn btn-danger mb-3" href="../../../../index.php"> <i class="fa-solid fa-arrow-left"></i> Back</a>
            <div class="form-group mb-3">
                <input type="text" name="name" id="name" class="form-control form-control-lg" placeholder="Name">
            </div>
            <div class="form-group mb-3">
                <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Email">
            </div>
            <div class="form-group mb-3">
                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password">
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-success btn-lg register mb-4">Register</button>
                <div class="registration-status">
                    <div class="name-status-container">
                        <input type="checkbox" id="name-status">
                        <label>Name must be 5 characters long!</label>
                    </div>
                    <div class="email-status-container">
                        <input type="checkbox" id="email-status">
                        <label>Email must be 3 characters long!</label>
                    </div>
                    <div class="password-status-container">
                        <input type="checkbox" id="password-status">
                        <label>Password must be 5 characters long!</label>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="../../js/jquery.js.js"></script>
    <!-- <script src="../../js/index.js"></script> -->
    <script src="../../js/register-validation.js"></script>
</body>
</html>