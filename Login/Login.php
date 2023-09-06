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
                <input class="inputBoxes" type="text" name="pin" id="pin" required value="" placeholder=" PIN"> <br>
                <input class="inputBoxes" type="text" name="cardNumber" id="cardNumber" required value="" placeholder=" Card Number"> <br>
                <button class="submitButton" type="submit" name="submit">Login</button> <br>
                <a>Don't have an account? </a>
                <a href="#createAccount">Create one</a>
            </form>
        </section>
    </div>
</body>

</html>