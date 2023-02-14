<?php 
    include 'database.php';
    session_start();

    if (!isset($_POST['username'])) {
        $_SESSION['error'] = "Cannot Bypass, Enter Credentials";
        header('LOCATION: ../admin-login.php');
        die();
    }
    
    $connection = new DataConnector();
    $result = $connection->select('admin_account', 'username = "'.$_POST['username'].'"');
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        if ($_POST['password'] == $row['password']) {
            $_SESSION['logged'] = $_POST['username'];
            unset($_SESSION['error']);
            header('LOCATION: adminDashboard.php');
            die();
        } else {
            $_SESSION['error'] = "Password Doesn\'t Match";
            header('LOCATION: ../admin-login.php');
            die();
        }
    } else {
        $_SESSION['error'] = "Invalid Credentials";
        header('LOCATION: ../admin-login.php');
        die();
    }
    