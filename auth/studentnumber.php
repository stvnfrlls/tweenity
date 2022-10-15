<?php
require_once("../utils/server.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>REGISTER PAGE</h1>
    <a href="../index.php">Home</a>
    2022-00011-SP
    <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
        <h1>Enter Student Number</h1>
        <input type="text" name="studentNumber" placeholder="Student Number">
        <input type="submit" name="verifyStudentNumber"></input>
    </form>
</body>

</html>