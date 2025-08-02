<?php
session_start();
$currentPage = "signin";
include "HeaderFile.php";

// If session is already active, redirect to dashboard
if (isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] === "Yes") {
    header("Location: http://127.0.0.1/MyProject/dashBoard.php");
    exit();
}

// If session not set but remember_me cookie exists
if (isset($_COOKIE["remember_me_key"])) {
    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "TailorEase";
    $connection = new mysqli($host, $user, $password, $database);

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
        $_SESSION["User_logged_in"] = "yes";
        header("Location: http://127.0.0.1/MyProject/dashBoard.php");
        exit();
    }
}
?>

<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  <style>
   body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f0f4fc;
  margin: 0;
  padding: 0;
}

.container {
  display: flex;
  justify-content: center;
  padding-top: 100px; /* spacing from header */
}

    .signin-form {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }

    .signin-form h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #333;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      background-color: #f9f9f9;
      transition: 0.3s;
    }

    input:focus {
      border-color: rgb(10, 235, 21);
      background-color: #fff;
      outline: none;
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .options label {
      display: flex;
      align-items: center;
      font-weight: normal;
      color: #444;
    }

    .options input[type="checkbox"] {
      margin-right: 6px;
      accent-color: rgb(48, 245, 74);
    }

    .options a {
      color: #007bff;
      text-decoration: none;
    }

    .options a:hover {
      text-decoration: underline;
    }

    input[type="submit"] {
      background-color: rgba(29, 243, 22, 0.99);
      color: white;
      padding: 12px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      width: 100%;
      transition: 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: rgb(13, 129, 29);
    }
  </style>
</head>
<body>
    <?php if(isset($_GET["error"])):?>
            <?php $errorCode = $_GET["error"];?>
            <?php if($errorCode):?>
                <h4 style= "color: red;">UserName or Password is invalid</h4>
            <?php endif;?>
        <?php endif;?>

<div class="container">
  <form class="signin-form" action="sigIn_post.php" method="post">
    <h2>Sign In</h2>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required placeholder="you@gmil.com">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required placeholder="Your password">

    <div class="options">
      <label><input type="checkbox" name="remember"> Remember Me</label>
      <a href="reset_password.php">Forgot Password?</a>
    </div>

    <input type="submit" value="Sign In">
  </form>
</div>

 <footer>
    &copy; 2025 TailorEase. Beta Version.
  </footer>

</body>
</html>
