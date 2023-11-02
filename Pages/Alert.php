<?php

echo '<link rel="stylesheet" type="text/css" href="../Styles/Alerts.css"></head>';

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
            if($level == "Red"){
                echo "<dialog open class='AlertWindow AlertRed'><img src='../Images/ErrorIcons/Red.png'><a>" . $message . "</a></dialog>";
            }elseif($level == "Orange"){
                echo "<dialog open class='AlertWindow AlertOrange'><img src='../Images/ErrorIcons/Orange.png'><a>" . $message . "</a></dialog>";
            }
            elseif($level == "Green"){
                echo "<dialog open class='AlertWindow AlertGreen'><img src='../Images/ErrorIcons/Green.png'><a>" . $message . "</a></dialog>";
            }else{
                echo "<dialog open class='AlertWindow'><a> No Color Selected </a></dialog>";
            }
            echo "<script>console.log('Coockie Called');</script>";
        }
    }
}

?>