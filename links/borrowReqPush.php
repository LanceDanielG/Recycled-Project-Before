<?php
    session_start();
    include_once 'database.php';
    if (isset($_POST['borrowReq'])){
        $connector = new DataConnector();
        $sql = "INSERT INTO requests VALUES (?, ?, ?, 'PENDING');";
        $statement = $connector->connection->prepare($sql);
        $date = date_create();
        $statement->bind_param("sss", $_POST['borrowReq'], $_SESSION['username'], date_format($date, "d-m-Y"));
        $statement->execute();
    }
    $_SESSION['success'] = "Sent borrowing request";
    header('LOCATION: borrowing.php');
    die();
?>
