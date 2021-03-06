<?php
session_start();
        ini_set('display_errors', 'Off');

if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $data = mysqli_real_escape_string($conn, $_POST['data']);

    $output = "";

    $sql_ = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$incoming_id}");
    if (mysqli_num_rows($sql_) > 0) {
        $row = mysqli_fetch_assoc($sql_);
        $img = $row['img'];
    }

    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id=messages.incoming_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";

    if($data != ""){

        $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id=messages.incoming_msg_id
            WHERE data >= '$data' 
            OR 
                  (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            AND 
                  (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id ";
    }

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                <div class="details">
                    <p>' . $row['msg'] . '</p>
                </div>
            </div>';
            } else {
                $output .= '<div class="chat incoming">
                <img src="Resources/' . $img . '" alt="">
                <div class="details">
                    <p>' . $row['msg'] . '</p>
                </div>
            </div>';
            }
        }
        echo $output;
    }

} else {
    header("../login.php");
}