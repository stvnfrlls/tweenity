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
    <a href="../index.php">Home</a>
    <?php
    if (count($errors) == 1) {
    ?>
    <div class="alert alert-danger text-center">
        <?php
            foreach ($errors as $showerror) {
                echo $showerror;
            }
            ?>
    </div>
    <?php
    } elseif (count($errors) > 1) {
    ?>
    <div class="alert alert-danger">
        <?php
            foreach ($errors as $showerror) {
            ?>
        <li>
            <?php echo $showerror; ?>
        </li>
        <?php
            }
            ?>
    </div>
    <?php
    }
    ?>
    <form method="post" action="<?php $_SERVER[" PHP_SELF"] ?>">
        <input type="hidden" name="type" value="login">
        <input type="text" name="usersEmail" placeholder="Email Address">
        <input type="password" name="usersPwd" placeholder="Password">
        <button type="submit" name="login-button">Log In</button>
    </form>

    <div class="form-sub-msg"><a href="./reset.php">Forgotten Password?</a></div>
</body>

</html>