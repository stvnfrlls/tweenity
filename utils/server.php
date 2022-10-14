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

            if ($fetch_password !== $password) {
                $errors['password'] = "Incorrect Password.";
            } else {
                $_SESSION['ID'] = $fetch_ID;
                header('Location: ../student/dashboard.php');
            }
        }
    } else {
        echo "error" . $mysqli->error;
    }
}

if (isset($_POST['signup-button'])) {
    $email = $mysqli->real_escape_string($_POST['usersEmail']);
    $password  = $mysqli->real_escape_string($_POST['usersPwd']);

    $check_email = "SELECT * FROM userdetails WHERE username = '$email'";
    $result = $mysqli->query($check_email);

    if ($result->num_rows === 0) {
        $signup = "INSERT INTO userdetails (user_name, password) VALUES('$email', '$password')";
        $result = $mysqli->query($signup);

        if ($result) {
            header('Location: auth/login.php');
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

