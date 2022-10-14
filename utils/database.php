<?php
global $mysqli;

$mysqli = new mysqli("localhost", "root", "", "sis_cdsp");

if ($mysqli->connect_errno) {
    echo "Error Connecting: " . $mysqli->connect_error;
    exit();
}