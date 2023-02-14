<?php
    include_once 'database.php';
    session_start();

    if (!isset($_POST['username'])) {
        $_SESSION['error'] = "Cannot Bypass, Enter Credentials";
        header("LOCATION: /Mommy/index.php");
        die();
    }

    $connection = new DataConnector();
    $result = $connection->select("user", "1");
    while ($row = $result->fetch_assoc()) {
        if ($_POST['username'] == $row['Username'] && $_POST['password'] == $row['Password']) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['studentName'] = $row['StudName'];
            unset($_SESSION['error']);
            header('LOCATION: userProfile.php');
            die();
        } else {
            $_SESSION['error'] = "Invalid Credential";
            header("LOCATION: /Mommy/index.php");
        }
    }
?>
