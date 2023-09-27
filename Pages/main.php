<?php
require 'config.php';

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($connect, "SELECT * FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: Login.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="../Styles/Main.css?v=<?php echo time(); ?>">


</head>

<body>


    <div class="wrapper">
        <div class="container1">
            <a class="logoutButton" href="Logout.php">Logout</a>
            <div class="box1">
                <div class="col1">
                    <h1>
                        <?php echo $row["user_name"] . "<br> <a class='moneyInfo'>" . $row['balance'] . "€</a>" ?>
                    </h1>
                </div>

                <div class="col2">
                    <div class="transactionBox">
                        <h1>Transfer</h1>
                        <form class="formContainer" action="" method="post" autocomplete="on">
                            <div class="labelBox">
                                <a>Your cardnumber:
                                    <?php echo $row["cardNumber"] ?>
                                </a>
                                <input class="firstInput" type="number" name="cardNumber" required value=""
                                    placeholder="Cardnumber"><br>
                                <input class="blapinInput" type="number" min="1" name="balance" required value=""
                                    placeholder="Balance">
                                <input class="blapinInput" type="number" name="pin" required value="" placeholder="Pin">
                                <button type="submit" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




        </div>
        <div class="container2">
            <div class="box2">
                <h1>Transactions</h1>
                <div class="border">
                    <table>
                        <thead>
                            <th>Name</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

































    <!--
    <a class="logoutButton" href="Logout.php">Logout</a>
    <div class="container">
        <div class="col1">
            <h1 class="accountName">
            <?php echo $row["user_name"] . "<br> <a class='moneyInfo'>" . $row['balance'] . "€</a>" ?>
            </h1>
        </div>
    </div>-->
    <!--<form class="formContainer" action="" method="post" autocomplete="on">
    <input type="number" name="cardNumber" required value="" placeholder="cardNumber"><br>
    <input type="number" min="1" name="balance" required value="" placeholder="balance"> <br>

    <button type="submit" name="submit">Submit</button>
</form>-->
    <!--
    <div class="tabelContainer">

        <table>
            <thead>
                <h1>Transactions</h1>
                    <tr class="headerBorder">
                        <th><a>Name</a></th>
                        <th><a>Arrival</a></th>
                        <th><a>Date</a></th>
                        <th><a>Status</a></th>
                        <th><a>Money</a></th>
                    </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
-->

</body>

</html>