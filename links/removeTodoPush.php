<?php
    session_start();
    include_once 'database.php';
    if(isset($_POST['removeTodoPush'])){
        $connector = new DataConnector();
        $sql = "DELETE FROM todo WHERE todoUser=? AND todoDesc=?;";
        $statement = $connector->connection->prepare($sql);
        $statement->bind_param("ss", $_SESSION['username'], $_POST['removeTodoPush']);
        $statement->execute();
    }
    header('LOCATION: todo.php');
    die();
?>
