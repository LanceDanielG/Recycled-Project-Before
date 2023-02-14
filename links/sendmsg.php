<?php
    session_start();
    include_once 'database.php';
    if (isset($_POST['receiver'])) {
        $data = new DataConnector();
        $sql = "INSERT INTO messages VALUES (?, ?, ?)";
        $statement = $data->connection->prepare($sql);
        $link = $_SESSION['username'] . "-" . $_POST['receiver'];
        $msgDate = date_format(date_create(), "d-m-Y");
        $statement->bind_param("sss", $_POST['messages'], $link ,$msgDate);
        $statement->execute();
        echo $data->connection->error;
    }
    header("LOCATION: chats.php");
    die();
?>
