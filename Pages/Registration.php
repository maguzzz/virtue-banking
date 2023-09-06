<?php
require 'config.php';


function cardNumGen($x)
{
    while (true) {
        $cardGen = mt_rand(1000000000000000, 9999999999999999);
        $diplicateCheck = mysqli_query($x, "SELECT * FROM user WHERE cardNumber = '$cardGen'");
        if (mysqli_num_rows($diplicateCheck) > 0) {
            continue;
        }else{
            echo "<script>alert('$cardGen');</script>";
            return $cardGen;
        }
    }
}


if (!empty($_SESSION["id"])) {
    header("Location: main.php");
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $pin = mt_rand(1000, 9999);
    $cardNumber = cardNumGen($connect);
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
    <link rel="stylesheet" href="../Styles/RegiAndLogin.css?v=<?php echo time(); ?>">
</head>

<body>
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
                <a class="alreadyAccount" href="/virtue-banking/Pages/Login.php">Log in</a>
            </form>
        </section>
    </div>
</body>

</html>