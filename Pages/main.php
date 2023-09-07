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
    <title>main</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../Styles/Main.css">

    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="../Javascripts/Main.js"></script>
</head>

<body>
    <h1><?php echo $row["user_name"] ?></h1>
    <div class="container">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Arrival</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php

                    $idTransaction = $_SESSION["id"];
                    $searchResult = mysqli_query($connect, "SELECT * FROM transactions WHERE sender = '$idTransaction' OR receiver = '$idTransaction'");



                    if (mysqli_num_rows($searchResult) > 0) {

                        while ($row = mysqli_fetch_assoc($searchResult)) {

                            $otherPerson = mysqli_query($connect, "SELECT user_name FROM user WHERE id != '$id' AND id = $row[receiver]  AND id != '$id' OR id = $row[sender] AND id != '$id'");
                            $otherPersonName = mysqli_fetch_assoc($otherPerson);

                            echo "<td>" . $otherPersonName["user_name"] . "</td>";

                            if ($id != $row["receiver"]) {
                                echo "<td> sent </td>";
                            } else {
                                echo "<td> received </td>";
                            };

                            echo "<td>" . $row["datum"] . "</td>";
                            if($row["value"] < 25){
                                echo "<td> Complete </td>";
                            }else{
                                echo "<td> Pending </td>";
                            };
                            if ($id != $row["receiver"]) {
                                echo "<td> -" . $row["value"] . "€</td>";
                            } else {
                                echo "<td> +" . $row["value"] . "€</td>";
                            };
                            
                            echo "</tr>";
                        }

                    } else {
                        echo "No transactions found.";
                    }
                    ?>
                </tr>


                </tfoot>
        </table>

        <h1>
            <?php $result ?>
        </h1>
    </div>
    <a href="Logout.php">Logout</a>


</body>

</html>