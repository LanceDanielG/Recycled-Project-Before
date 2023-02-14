<?php
    session_start();
    include_once 'database.php';
    if (isset($_POST['approvalFormAction'])) {
        $connector = new DataConnector();
        $sql = "UPDATE requests SET status=? WHERE itemName=? AND username=? AND date=?;";
        $statement = $connector->connection->prepare($sql);
        $statement->bind_param("ssss", $_POST['approvalFormAction'], $_POST['approvalFormObject'], $_POST['approvalFormSender'], $_POST['approvalFormDate']);
        $statement->execute();
    }
    header("Location: requests.php");
    die();
?>
