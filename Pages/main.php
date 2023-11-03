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
            <a class="logoutButton" href="Logout.php">Log out</a>
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
                <h1>Transactions</h1>
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
                <?php



                $idTransaction = $_SESSION["id"];
                $currentDateTime = date('Y-m-d');

                if (isset($_POST["submit"])) {
                    $cardNumber = $_POST["cardNumber"];
                    $value = $_POST["balance"];

                    //preventing SQL injection
                    $cardNumber = mysqli_real_escape_string($connect, $cardNumber);
                    $value = mysqli_real_escape_string($connect, $value);

                    // Getting the receivers card number
                    $result = mysqli_query($connect, "SELECT * FROM user WHERE cardNumber = '$cardNumber'");

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row) {
                            $receiveId = $row["id"];
                            $status = "complete";

                            $logedAccount = mysqli_query($connect, "SELECT * FROM user WHERE id = '$id'");
                            $logedRow = mysqli_fetch_assoc($logedAccount);

                            if($row["cardNumber"] != $logedRow["cardNumber"]){

                            
                            $accSenderBalance = $logedRow["balance"] - $value;
                            $accReceiverBalance = $row["balance"] + $value;

                            mysqli_query($connect, "UPDATE user SET balance = $accSenderBalance WHERE id = $id ");
                            mysqli_query($connect, "UPDATE user SET balance = $accReceiverBalance WHERE id = $receiveId");


                            //Insert the transaction into the database
                            $query = "INSERT INTO transactions (sender, receiver, datum, tra_value, tra_status) VALUES ($idTransaction, $receiveId, '$currentDateTime', $value, '$status')";

                            if (mysqli_query($connect, $query)) {
                                echo "<h1>" . $row["user_name"] . "</h1>";
                            }
                        }else{

                            //ERROR for not sending money to your self
                        }
                        } else {
                            //ERROR cardnumber not found (no user found)
                        }
                    }

                    header("Location: main.php");
                    exit();
                }

                $searchResult = mysqli_query($connect, "SELECT * FROM transactions WHERE sender = '$idTransaction' OR receiver = '$idTransaction'");

                if (mysqli_num_rows($searchResult) > 0) {

                    while ($row = mysqli_fetch_assoc($searchResult)) {

                        $otherPerson = mysqli_query($connect, "SELECT user_name FROM user WHERE id != '$id' AND id = $row[receiver]  AND id != '$id' OR id = $row[sender] AND id != '$id'");
                        $otherPersonName = mysqli_fetch_assoc($otherPerson);

                        echo "<td id='userName'>" . $otherPersonName["user_name"] . "</td>";

                        if ($id != $row["receiver"]) {
                            echo "<td> sent </td>";
                        } else {
                            echo "<td> received </td>";
                        }
                        ;

                        echo "<td>" . $row["datum"] . "</td>";
                        if ($row["tra_value"] < 25) {
                            echo "<td> Complete </td>";
                        } else {
                            echo "<td> Pending </td>";
                        }
                        ;
                        if ($id != $row["receiver"]) {
                            echo "<td> -" . $row["tra_value"] . "€</td>";
                        } else {
                            echo "<td> +" . $row["tra_value"] . "€</td>";
                        }
                        ;

                        echo "</tr>";
                    }

                } else {
                    echo "<div class='noFoundMessageContainer'><a class='noFoundMessage'>No transactions found.</a></div>";
                }

                ?>
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