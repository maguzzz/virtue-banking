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

    <a href="Logout.php">Logout</a>

    <div class="infoContainer">
        <a class="accountName"><?php echo $row["user_name"]. "<br>". $row["cardNumber"]?></a>
    </div>

    <form class="formContainer" action="" method="post" autocomplete="off">
        <input type="text" placeholder="Cardnumber">
        <input type="text" placeholder="Amount">
        <button type="button" name="submit">Submit</button>
    </form>


    <div class="container">
        <table class="tableContainer">
            <div class="headColorer">
                <tr>
                    <th>Name</th>
                    <th>Arrival</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Value</th>
                </tr>
            </div>
            <tr>
            <tr>
                <?php

                $idTransaction = $_SESSION["id"];
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
                        if ($row["value"] < 25) {
                            echo "<td> Complete </td>";
                        } else {
                            echo "<td> Pending </td>";
                        }
                        ;
                        if ($id != $row["receiver"]) {
                            echo "<td> -" . $row["value"] . "€</td>";
                        } else {
                            echo "<td> +" . $row["value"] . "€</td>";
                        }
                        ;

                        echo "</tr>";
                    }

                } else {
                    echo "<a class='noFoundMessage'>No transactions found.</a>";
                }
                ?>
            </tr>



            </tr>
        </table>
    </div>
</body>

</html>