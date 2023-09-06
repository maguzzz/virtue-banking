<?php
require '../config.php';

if(!empty($_SESSION["id"])){
    header("Location: ../Main/main.php");
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: ../Main/main.php");

        } else {
            echo "<script>alert('Wrong Password');</script>";
        }

    } else {
        echo "<script>alert('Email not registered');</script>";
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
</head>

<body>

    <div class="container">

        <section class="regiPage">
            <h1>Welcome back!</h1>
            <h2>Good to see you!</h2>

            <form class="formContainer" action="" method="post" autocomplete="off">
                <input class="inputBoxes" type="text" name="email" id="email" required value=""placeholder=" Email"><br>
                <input class="inputBoxes" type="text" name="password" id="password" required value="" placeholder=" Password"> <br>
                <button class="submitButton" type="submit" name="submit">Login</button> <br>
                <a>Don't have an account? </a>
                <a href="#createAccount">Create one</a>
            </form>
        </section>
    </div>
</body>

</html>