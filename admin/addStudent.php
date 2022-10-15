<?php 
    require_once("../utils/server.php");
    $get_userID = ("SELECT COUNT(userID) FROM studentrecord");
    $result = $mysqli->query($get_userID);
    $count = $result->fetch_assoc();
    $studentCounter = $count["COUNT(userID)"] + 1;
    $format_StudentCounter = sprintf("%05d", $studentCounter);
    $year = date("Y");
    $studentNumber = $year."-".$format_StudentCounter."-SP";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>

<body>
    <h1>Add Student</h1>
    <a href="../index.php">Home</a>

    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        <div class="container">
            <h1>STUDENT INFORMATION</h1>
            <div class="row">
                <label for="SR_number">Student Number</label>
                <input type="text" name="SR_number" id="SR_number" value="<?php echo $studentNumber ?>" readonly>
            </div>
            <div class="row">
                <label for="SR_fname">First Name</label>
                <input type="text" name="SR_fname" id="SR_fname">
                <label for="SR_mname">Middle Name</label>
                <input type="text" name="SR_mname" id="SR_mname">
                <label for="SR_lname">Last Name</label>
                <input type="text" name="SR_lname" id="SR_lname">
            </div>
            <div class="row">
                <label for="SR_age">Age</label>
                <input type="number" name="SR_age" id="SR_age">
                <label for="SR_birthday">Birthday</label>
                <input type="date" name="SR_birthday" id="SR_birthday">
                <label for="SR_gender">Gender</label>
                <input type="text" name="SR_gender" id="SR_gender">
            </div>
            <div class="row">
                <label for="SR_address">Address</label>
                <input type="text" name="SR_address" id="SR_address">
                <label for="SR_guardian">Guardian</label>
                <input type="text" name="SR_guardian" id="SR_guardian">
                <label for="SR_contact">Contact</label>
                <input type="text" name="SR_contact" id="SR_contact">
            </div>

            <h1>SCHOOL INFORMATION</h1>
            <div class="row">
                <label for="SR_grade">Year Level</label>
                <input type="text" name="SR_grade" id="SR_grade">
                <label for="SR_section">Section</label>
                <input type="text" name="SR_section" id="SR_section">
            </div>
        </div>
        <input type="submit" name="regStudent" id="regStudent" value="Register Student">
    </form>
</body>

</html>