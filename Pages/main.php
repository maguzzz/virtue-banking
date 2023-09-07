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
    <link rel="stylesheet" href="../Styles/Main.css">

</head>

<body>

    <a href="Logout.php">Logout</a>

    <div class="accountNameContainer">
        <a class="accountName">
            <?php echo $row["name"] ?>
        </a>
    </div>

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
                <td id="userName">Markus</td>
                <td>sent</td>
                <td>23/05/2023</td>
                <td>pending</td>
                <td>$320,800</td>
            </tr>
        </table>
    </div>
</body>

</html>