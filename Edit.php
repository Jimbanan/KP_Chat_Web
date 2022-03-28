<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>WEB Chat KР</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>

<body>
<div class="wrapper">
    <section class="form signup">
        <header>WEB - Чат</header>

        <?php
        include_once "php/config.php";
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
        }
        ?>

        <form action="#">
            <div class="error-txt"></div>
            <div class="name-details">
                <div class="field input">
                    <label>Имя</label>
                    <input type="text" name="fname" value="<?php echo $row['fname'] ?>">
                </div>
                <div class="field input">
                    <label>Фамилия</label>
                    <input type="text" name="lname" value="<?php echo $row['lname'] ?>">
                </div>
            </div>
            <div class="field input">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $row['email'] ?>">
            </div>
            <div class="field input">
                <label>Пароль</label>
                <input type="text" name="password" value="<?php echo $row['password'] ?>" >
                <i class="fas fa-eye"></i>
            </div>
            <div class="field image">
                <label>Выберите фото профиля</label>
                <input type="file" name="image">
            </div>
            <div class="field button">
                <input type="submit" value="Изменить данные">
            </div>

        </form>
    </section>
</div>

<script src="javascript/pass_show_hide.js"></script>
<script src="javascript/signup.js"></script>

</body>
</html>