<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blood Bank</title>
    <link rel="stylesheet" href="../../assets/css/index.css" />
    <link rel="stylesheet" href="../../assets/css/login.css" />
</head>
<body>
<div id="bodydiv">
    <header>
    <li><a href="signup.php">Don't have an account "Signup"</a></li>
    </header>

    <div id="logindiv">
    <form action="../../index.php" method=POST>
        <input type="text" name="username" placeholder="EMAIL" />
        <input type="password" name="password" placeholder="PASSWORD" /><br>
        <input type="submit" name="submitlogin" value="Login" id="registerbutton">
    </form>
    </div>
</div>
</body>
</html>