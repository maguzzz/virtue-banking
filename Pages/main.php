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
    <link rel="stylesheet" href="../Styles/All.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Styles/Main.css?v=<?php echo time(); ?>">


</head>

<body>
    <div id="virtueName"> <button onclick="window.location.href= '/virtue-banking/Pages/Startpage.php';"> <h1>virtue</h1></button></div>
    <a href="Logout.php">Logout</a>

    <div class="infoContainer">
        <a class="accountName">
            <?php echo $row["user_name"] . "<br> <a class='moneyInfo'>" . $row['balance'] . "€</a>" ?>
        </a>
    </div>

    <form class="formContainer" action="" method="post" autocomplete="on">
        <input type="number" name="cardNumber" required value="" placeholder="cardNumber"><br>
        <input type="number" min="1" name="balance" required value="" placeholder="balance"> <br>

        <button type="submit" name="submit">Submit</button>
    </form>



    <div class="container">
        <table class="tableContainer">
            <div class="headColorer">
                <tr>
                    <th>Nam</th>
                    <th>Arrival</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Value</th>
                </tr>
            </div>
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
                    echo "<a class='noFoundMessage'>No transactions found.</a>";
                }

                ?>
            </tr>
        </table>
    </div>


    <script src="../Javascripts/Main.js"></script>
</body>

</html>