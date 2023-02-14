<?php
    include_once 'database.php';
    session_start();
    if (isset($_POST['violation'])) {
        $connector = new DataConnector();
        $sql = "INSERT INTO violations (violationNumber, violationUser, violationDate) VALUES (?, ?, ?);";
        $statement = $connector->connection->prepare($sql);
        $date = date("d-m-Y");

        $statement->bind_param("sss", $_POST['violation'], $_SESSION['selectedUser'], $date);
        $statement->execute();
    }
    $_SESSION['success'] = "Violation Added";
    header("LOCATION: adminControls.php");
    die();
?>
