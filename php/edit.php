<?php
session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
}

if ($fname != $row['fname']) {
    $sql = mysqli_query($conn, "UPDATE users SET fname = '$fname' WHERE unique_id = {$row['unique_id']}");
}
if ($lname != $row['lname']) {
    $sql = mysqli_query($conn, "UPDATE users SET lname = '$lname' WHERE unique_id = {$row['unique_id']}");
}
if ($email != $row['email']) {
    $sql = mysqli_query($conn, "UPDATE users SET email = '$email' WHERE unique_id = {$row['unique_id']}");
}
if ($password != $row['password']) {
    $sql = mysqli_query($conn, "UPDATE users SET password = '$password' WHERE unique_id = {$row['unique_id']}");
}

if (isset($_FILES['image'])) {
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $img_explode = explode('.', $img_name);
    $img_ext = end($img_explode);

    $extensions = ['png', 'jpeg', 'jpg'];
    if (in_array($img_ext, $extensions) === true) {
        $time = time();
        $new_img_name = $time . $img_name;
        if (move_uploaded_file($tmp_name, "Resources/" . $new_img_name)) {

            if ($row['img'] != $new_img_name) {
                $sql = mysqli_query($conn, "UPDATE users SET img = '$new_img_name' WHERE unique_id = {$row['unique_id']}");
            }

        }

    }
}

echo "success";