<?php
require '../config.php';

if(!empty($_SESSION["id"])){
    header("Location: ../Main/main.php");
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $pin = $_POST["pin"];
    $cardNumber = $_POST["cardNumber"];
    $duplicate = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Email has Already been registered');</script>";
    } else {
        if ($password == $confirmpassword) {
            mysqli_query($connect, "INSERT INTO user VALUES('','$name','$email','$password','$pin','$cardNumber')");
            echo "<script> alert('Registration Complete'); </script>";
        } else {
            echo "<script> alert('Passwords not identical'); </script>";
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="Registration.css?v=<?php echo time(); ?>">
</head>

<body>

    <div class="navbar">
        <div id="logo">
            <a id="logo" href="#virtue">virtue</a>
        </div>
        <a href="#about">About</a>
        <a href="#pricing">Pricing</a>
        <a href="#buisness">Buisness</a>
    </div>

    <div class="container">
        <section class="regiPage">
            <h1>Welcome!</h1>
            <h2>Good to see you!</h2>

            <form class="formContainer" action="" method="post" autocomplete="off">
                <br> <br>
                <input class="inputBoxes" type="text" name="name" id="name" required value="" placeholder="Name"> <br>                
                <input class="inputBoxes" type="text" name="email" id="email" required value="" placeholder="Email"><br>
                <input class="inputBoxes" type="text" name="password" id="password" required value="" placeholder="Password"> <br>
                <input class="inputBoxes" type="text" name="confirmpassword" id="confirmpassword" required value="" placeholder="Confirm Passoword"> <br>
                <br> <br> <br>
                <button class="submitButton" type="submit" name="submit">Register</button> <br> <br>
                <a class="textAlreadyAccount">Already have an account? </a>
                <a class="alreadyAccount" href="/Login/Login.php">Log in</a>
            </form>
        </section>
    </div>
</body>

</html>