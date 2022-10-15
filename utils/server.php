<?php
session_start();
include('database.php');
$errors = array();
$success = array();
date_default_timezone_set('Asia/Hong_Kong'); //remove mo to kapag nilagay mo na sa hosting sites

if (isset($_POST['login-button'])) {
    $email    = $mysqli->real_escape_string($_POST['usersEmail']);
    $password = $mysqli->real_escape_string($_POST['usersPwd']);

    $check_email = "SELECT * FROM userdetails WHERE username = '$email'";
    $result = $mysqli->query($check_email);

    if ($result) {
        if ($result->num_rows > 0) {
            $fetch = $result->fetch_assoc();
            $fetch_ID = $fetch['userID'];
            $fetch_email = $fetch['username'];
            $fetch_password = $fetch['password'];
            $fetch_role = $fetch['role'];

            if ($fetch_password !== $password) {
                $errors['password'] = "Incorrect Password.";
            } else {
                $_SESSION['ID'] = $fetch_ID;
                if ($fetch_role == "student") {
                    header('Location: ../student/dashboard.php');
                } elseif ($fetch_role == "admin") {
                    header('Location: ../admin/dashboard.php');
                } elseif ($fetch_role == "faculty") {
                    header('Location: ../faculty/dashboard.php');
                }
            }
        }
    } else {
        echo "error" . $mysqli->error;
    }
}

if (isset($_POST['verifyStudentNumber'])) {
    $studentNumber = $_POST['studentNumber'];

    $check_studentNumber = "SELECT * FROM studentrecord WHERE SR_number = '$studentNumber'";
    $result = $mysqli->query($check_studentNumber);

    if ($result) {
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $sr_num = $data['SR_number'];
            $_SESSION['student_num'] = $sr_num;
            header('Location: signup.php');
        } else {
            echo "error" . $mysqli->error;
        }
    }
}

if (isset($_POST['register-button'])) {
    $email = $mysqli->real_escape_string($_POST['usersEmail']);
    $password  = $mysqli->real_escape_string($_POST['usersPwd']);

    $check_email = "SELECT * FROM userdetails WHERE username = '$email'";
    $result = $mysqli->query($check_email);

    if ($result->num_rows === 0) {
        $studentNumber = $_SESSION['student_num'];
        $signup = "UPDATE student (user_name, password) VALUES('$email', '$password') WHERE SR_number = '$studentNum'";
        $result = $mysqli->query($signup);

        if ($result) {
            if ($result->affected_rows >= 0) {
                header('Location: auth/login.php');
            } else {
                $errors['unknown'] = "Error inputting Data";
            }
        } else {
            $errors['unknown'] = "Error inputting Data";
        }
    } else {
        $errors['email'] = "Email already in use." . $email;
        echo "error" . $mysqli->error;
    }
}

if (isset($_POST['present'])) {
    $qrCode = $_POST['qrcode_input'];
    $time = date("Y-m-d H:i:s");

    $verify_qr = "SELECT * FROM studentrecord WHERE SR_number = '$qrCode'";
    $result = $mysqli->query($verify_qr);

    if ($result) {
        $data = $result->fetch_assoc();
        $getStudentNumber = $data['SR_number'];

        if ($getStudentNumber == $qrCode) {

            $check_timeIN = ("SELECT * FROM attendance WHERE SR_number = '$getStudentNumber'");
            $result = $mysqli->query($check_timeIN);

            if ($result) {
                if ($result->num_rows >= 0) {
                    $data = $result->fetch_assoc();
                    $timeIN = $data['A_time_in'];
                    $timeOUT = $data['A_time_out'];

                    if ($timeIN == null) {
                        $insertAttendance = ("INSERT INTO attendance (SR_number, A_time_in) VALUES ('$getStudentNumber', '$time')");
                        $result = $mysqli->query($insertAttendance);

                        if ($result) {
                            header('Location: ../faculty/scanQR.php');
                            echo "Success " . $getStudentNumber . " " . $time;
                        } else {
                            echo $mysqli->error;
                        }
                    } elseif ($timeIN != null && $timeOUT == null) {
                        $insertTimeout = ("UPDATE attendance SET A_time_out = '$time' WHERE SR_number = '$getStudentNumber'");
                        $result = $mysqli->query($insertTimeout);

                        if ($result) {
                            header('Location: ../faculty/scanQR.php');
                            echo "Success " . $getStudentNumber . " " . $time;
                        } else {
                            echo $mysqli->error;
                        }
                    } elseif ($timeIN != null && $timeOUT != null) {
                        echo "Student already checked out";
                    }
                }
            }
        } else {
            echo "Invalid Student Number or Student does not exist";
        }
    }
}

if (isset($_POST['regStudent'])) {
    $SR_number    = $mysqli->real_escape_string($_POST['SR_number']);

    $SR_fname = $mysqli->real_escape_string($_POST['SR_fname']);
    $SR_mname    = $mysqli->real_escape_string($_POST['SR_mname']);
    $SR_lname = $mysqli->real_escape_string($_POST['SR_lname']);
    $SR_gender = $mysqli->real_escape_string($_POST['SR_gender']);

    $SR_age    = $mysqli->real_escape_string($_POST['SR_age']);
    $SR_birthday = $mysqli->real_escape_string($_POST['SR_birthday']);

    $SR_address    = $mysqli->real_escape_string($_POST['SR_address']);
    $SR_guardian = $mysqli->real_escape_string($_POST['SR_guardian']);
    $SR_contact    = $mysqli->real_escape_string($_POST['SR_contact']);

    $SR_grade = $mysqli->real_escape_string($_POST['SR_grade']);
    $SR_section    = $mysqli->real_escape_string($_POST['SR_section']);

    $regStudent = "INSERT INTO studentrecord(SR_number, SR_fname, SR_mname, SR_lname, SR_gender, 
                    SR_age, SR_birthday, SR_grade, SR_section, SR_address, SR_guardian, SR_contact)
                    VALUES('$SR_number', '$SR_fname', '$SR_mname', '$SR_lname', '$SR_gender', 
                     '$SR_age', '$SR_birthday', '$SR_grade', '$SR_section', '$SR_address',
                     '$SR_guardian', '$SR_contact'
                    )";
    $result = $mysqli->query($regStudent);

    if ($result) {
        header('Location: ../admin/addStudent.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
