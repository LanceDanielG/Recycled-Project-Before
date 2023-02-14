<?php
    include 'database.php';
    session_start();
    $data = new DataConnector();
    $SQL = "DELETE FROM subjectlist WHERE subCode=?";
    $statement = $data->connection->prepare($SQL);
    $statement->bind_param('s', $_POST['subToDelete']);
    $statement->execute();
    header("LOCATION: classes.php");
    die();

?>
