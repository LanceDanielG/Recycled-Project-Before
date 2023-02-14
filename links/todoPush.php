<?php
    session_start();
    include_once 'database.php';
    if(isset($_POST['todoDesc'])){
        $connector = new DataConnector();
        $sql = "INSERT INTO todo VALUES (?, ?, 'FALSE')";
        $statement = $connector->connection->prepare($sql);
        $statement->bind_param("ss", $_SESSION['username'], $_POST['todoDesc']);
        $statement->execute();
    }
    header('LOCATION: todo.php');
    die();
?>
