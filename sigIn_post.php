<?php
    session_start();
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "TailorEase";
    $connection = new mysqli($host, $user, $password, $database);
    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error);
    }


    $email = $_POST["email"];
    $password = $_POST["password"];


    $query = "SELECT * FROM Users WHERE Email = '$email' AND password = '$password'";

    $db_response = $connection->query($query);
    if($db_response->num_rows > 0){
        $_SESSION["User_logged_in"] = "Yes";
        $user_id = 0;
        while($row = $db_response->fetch_assoc()){
            $_SESSION["user_id"] = $user_id = $row["UserID"];
            $_SESSION["user_Email"] = $row["Email"];

            $_SESSION["user_data"] = $row;
        }

        // check if user enable Remember me
        if($_POST["remember"] == "on"){
            // Generate a random key
            $timestamp = time();
            $remember_key = hash('sha256', $user_id."_".$timestamp);  // md5($user_id."_".$timestamp)
            $expiry = $timestamp + (60 * 60 * 24 * 10);
            // Set Cookie
            setcookie("remember_me_key", $remember_key, $expiry, "/");
            $query = "UPDATE Users SET Remember_login_key = '$remember_key' WHERE UserID = $user_id";
            $connection->query($query);
        }
        header("Location: http://127.0.0.1/MyProject/dashBoard.php");
        exit();
    }else{
        header("Location: http://127.0.0.1/MyProject/SignIn.php?error=1");
    }


?>