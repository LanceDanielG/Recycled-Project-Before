<?php
    include 'database.php';
    session_start();

    if (!isset($_POST['submit'])) {
        $_SESSION['error'] = "Cannot Bypass, Unauthorize Access";
        header('LOCATION: classes.php');
        die();
    }

    $SQL = "INSERT INTO subjectlist VALUES (?, ?, ?, ?, ?, ?)";
    $data = new DataConnector();
    $statement = $data->connection->prepare($SQL);
    $temp = date_create_from_format('Y-m-d', $_POST['subdate']);
    $temp = date_format($temp, "d-m-Y");
    $statement->bind_param("ssssss", $_POST['subdesc'], $_POST['subcode'], $_POST['subunits'], $temp, $_POST['subtime'], $_POST['subsection'], );
    $statement->execute();
    header("LOCATION: classes.php");
    die();
?>
