<?php
    session_start();
    include_once 'database.php';
    
    foreach ($_POST as $key => $value) {
		$_SESSION['info'][$key] = $value;
	}

    if (!isset($_POST['username'])) {
        header('LOCATION: register.php');
        die();
    }

    $connector = new DataConnector();
    $sql = "INSERT INTO user (Username, Password, StudName, ContactNo, StudID, BDay, Year, Course, Section) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = $connector->connection->prepare($sql);
    $statement->bind_param(
        "sssssssss",
        $_SESSION['info']['username'],
        $_SESSION['info']['password'],
        $_SESSION['info']['studentname'],
        $_SESSION['info']['contactNumber'],
        $_SESSION['info']['studentID'],
        $_SESSION['info']['birthdate'],
        $_SESSION['info']['yearlevel'],
        $_SESSION['info']['course'],
        $_SESSION['info']['section']
    );
    $statement->execute();
    header("LOCATION: /Mommy/index.php");
    $_SESSION['success'] = "Registered Sucessfully";

    unset($_SESSION['info']);
    die();
?>
