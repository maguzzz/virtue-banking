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
    <div class="loadingScreen">
    </div>

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

        <main class="table">
            <section class="table__header">
                <h1>Customer's Orders</h1>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <td> Name </td>
                            <td> Arrival </td>
                            <td> Date </td>
                            <td> Status </td>
                            <td> Value</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Albin </td>
                            <td> Kizhakkedath </td>
                            <td> This Company </td>
                            <td> 20/20/230 </td>
                            <td> 1231231 </td>
                        </tr>
                        <tr>
                            <td> Albin </td>
                            <td> Kizhakkedath </td>
                            <td> This Company </td>
                            <td> 20/20/230 </td>
                            <td> 1231231 </td>
                        </tr>
                        <tr>
                            <td> Albin </td>
                            <td> Kizhakkedath </td>
                            <td> This Company </td>
                            <td> 20/20/230 </td>
                            <td> 1231231 </td>
                        </tr>
                        <tr>
                            <td> Albin </td>
                            <td> Kizhakkedath </td>
                            <td> This Company </td>
                            <td> 20/20/230 </td>
                            <td> 1231231 </td>
                        </tr>
                        <tr>
                            <td> Albin </td>
                            <td> Kizhakkedath </td>
                            <td> This Company </td>
                            <td> 20/20/230 </td>
                            <td> 1231231 </td>
                        </tr>
                        <tr>
                            <td> Albin </td>
                            <td> Kizhakkedath </td>
                            <td> This Company </td>
                            <td> 20/20/230 </td>
                            <td> 1231231 </td>
                        </tr>

                    </tbody>
                </table>
            </section>
        </main>
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
    <script src="../Javascripts/Loadingscreen.js"></script>

</body>

</html>