<?php
    session_start();
    if (!isset($_SESSION['auth'])) header("Location: ../../../../index.php"); // if no session can't be accessed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom | E-Chat</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/chatroom.css">
    <link rel="stylesheet" href="../../css/all.css">
</head>
<body>
    <header class="bg-warning">
        <p class="logo">E-CHAT CHATROOM</p>
        <div class="left-links">
            <a href="profile.php?profile=<?php echo $_SESSION['auth'][0]['username']?>">Profile</a>
            <?php
                if ($_SESSION['auth'][0]['type'] == 'admin') echo '<a href="#">Admin Panel</a>'
            ?>
            <a href="#" id="logout">Logout</a>
        </div>
    </header>
    <main>

    </main>
    <footer>
        <input class="chat-box" type="text" name="chatbox">
    </footer>

    <script src="../../js/jquery.js.js"></script>
    <script src="../../js/index.js"></script>
    <script src="../../js/chatroom.js"></script>
</body>
</html>