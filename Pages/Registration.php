<?php
require 'config.php';
require 'Alert.php';

AlertMsg('','', false);

//Fcuntion to generate Random Card number (no duplicates)
function cardNumGen($x)
{
    while (true) {
        $cardGen = mt_rand(1000000000000000, 9999999999999999);
        $diplicateCheck = mysqli_query($x, "SELECT * FROM user WHERE cardNumber = '$cardGen'");
        if (mysqli_num_rows($diplicateCheck) > 0) {
            continue;
        }else{
            return $cardGen;
        }
    }
}


if (!empty($_SESSION["id"])) {
    header("Location: Main.php");
}

if (isset($_POST["submit"])) {
    $user_name = $_POST["user_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    //Making sure there us no SQL injection
    $user_name = mysqli_real_escape_string($connect, $user_name);
    $email = mysqli_real_escape_string($connect, $email);
    $password = mysqli_real_escape_string($connect, $password);
    $confirmpassword = mysqli_real_escape_string($connect, $confirmpassword);


    $pin = mt_rand(1000, 9999);
    $balance = 250;
    $cardNumber = cardNumGen($connect);

    $duplicate = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        //ERROR Account Already Registered

        AlertMsg("Email Already Registered","Red", true);
    } else {
        if ($password == $confirmpassword) {
            //ERROR Account Created
            AlertMsg("Account Created","Green", true);
            mysqli_query($connect, "INSERT INTO user VALUES('','$user_name','$email','$password','$pin','$cardNumber','$balance')"); 
            header("Location: login.php");
            exit();
        } else {
            //ERROR Password Not Identical
            AlertMsg("Password Not Identical","Red", true);
        }
    }

    header("Location: registration.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../Styles/All.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Styles/RegiAndLogin.css?v=<?php echo time(); ?>">
</head>

<body>
    <div id="virtueName"> <button onclick="window.location.href= '/virtue-banking/Pages/Startpage.php';"> <h1>virtue</h1></button></div>
    <div class="container">
        <section class="regiPage">
            <h1>Welcome!</h1>
            <h2>Good to see you!</h2>
            

            <img class="Blob1" src="../Images/Blob1.png">
            <img class="Blob2" src="../Images/Blob2.png">
            <img class="Blob3" src="../Images/Blob3.png">
            
            <form class="formContainer" action="" method="post" autocomplete="off">
                <br> <br>
                <input class="inputBoxes" type="text" name="user_name" id="name" required value="" placeholder="Name"> <br>                
                <input class="inputBoxes" type="text" name="email" id="email" required value="" placeholder="Email"><br>
                <input class="inputBoxes" type="text" name="password" id="password" required value="" placeholder="Password"> <br>
                <input class="inputBoxes" type="text" name="confirmpassword" id="confirmpassword" required value="" placeholder="Confirm Passoword"> <br>
                <br> <br> <br>
                <button class="submitButton" type="submit" name="submit">Register</button> <br> <br>
                <a class="textAlreadyAccount">Already have an account? </a>
                <a class="alreadyAccount" href="Login.php">Log in</a>
            </form>
        </section>
    </div>
</body>

</html>