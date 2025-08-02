<?php
if (!isset($_SESSION["User_logged_in"]) || $_SESSION["User_logged_in"] != "Yes") {
    if (isset($_COOKIE["remember_me_key"])) {
        $host = "127.0.0.1";
        $port = "3306";
        $username = "root";
        $password = "";
        $database = "TailorEase";

        $connection = new mysqli($host, $username, $password, $database, $port);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $cookie_value = $connection->real_escape_string($_COOKIE["remember_me_key"]);
        $query = "SELECT * FROM Users WHERE Remember_login_key = '$cookie_value'";
        $db_response = $connection->query($query);

        if ($db_response && $db_response->num_rows > 0) {
            $row = $db_response->fetch_assoc();
            $_SESSION["user_id"] = $row["UserID"];
            $_SESSION["user_Email"] = $row["Email"];
            $_SESSION["User_logged_in"] = "Yes";
            header("Location: http://127.0.0.1/MyProject/dashBoard.php");
            exit();
        } else {
            // Cookie key invalid
            header("Location: http://127.0.0.1/MyProject/SignIn.php");
            exit();
        }
    } else {
        // No session and no cookie
        header("Location: http://127.0.0.1/MyProject/SignIn.php");
        exit();
    }
}
?>
