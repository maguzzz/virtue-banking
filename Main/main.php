<?php
require '../config.php';

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($connect, "SELECT * FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("Location: ../Login/Login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
</head>
<body>
    <h1>Hello <?php echo $row["name"]?> <h1>
    <h1>CardNumber |<?php echo $row["cardNumber"]?> <h1>
    <h1>Pin | <?php echo $row["pin"]?> <h1>
    <a href="../Logout/Logout.php">Logout</a>
</body>
</html>