<?php 
require_once("../utils/server.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>LOGIN PAGE</h1>
    <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
        <input type="hidden" name="type" value="login">
        <input type="text" name="usersEmail" placeholder="Email Address">
        <input type="password" name="usersPwd" placeholder="Password">
        <button type="submit" name="login-button">Log In</button>
    </form>

    <div class="form-sub-msg"><a href="./reset.php">Forgotten Password?</a></div>
</body>

</html>