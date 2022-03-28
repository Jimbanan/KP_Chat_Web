<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $data = mysqli_real_escape_string($conn, date('d-m-Y'));
    $data = mysqli_real_escape_string($conn, date('d-m-Y'));


    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, data)
        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}','{$data}') ") or die();
    }
} else {
    header("../login.php");

}