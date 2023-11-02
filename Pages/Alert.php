<?php


function AlertMsg($message, $level, $isAlert)
{
    $CookieMessage = "message";
    $CookieLevel = "level";

    if ($isAlert == true) {
        setcookie($CookieMessage, $message, time() + 5, "/"); // 5 = Seconds
        setcookie($CookieLevel, $level, time() + 5, "/"); // 5 = Seconds
        echo "<script>alert('Your message Here');</script>";
        echo "<script>console.log('Coockie Sett');</script>";

    } elseif ($isAlert == false) {
        if (isset($_COOKIE["message"]) && isset($_COOKIE["level"])) {
            $message = $_COOKIE["message"];
            $level = $_COOKIE["level"];
            echo "<dialog open class='AlerWindow'>" . $message . "</dialog>";
            echo "<script>console.log('Coockie Called');</script>";
        }
    }
}

?>