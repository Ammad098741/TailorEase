<?php
session_start();
$currentPage = "SearchCustomer";
include "HeaderFile.php";
$connection = new mysqli("127.0.0.1", "root", "", "TailorEase");
if ($connection->connect_error) 
        {
    die("Connection failed: " . $connection->connect_error);
}

    $results = [];
    $error = "";

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if(isset($_SESSION['user_id'])){
        $user_id =$_SESSION['user_id'];
     }
    if(!$user_id){
        $error = "Unauthorized access. Please log in.";
    }
    else{
        $id = trim($_POST['CustomerID']);
        $name = trim($_POST['CustomerName']);
        $phone = trim($_POST["CustomerPhone"]);

        if (!empty($id)) {
            $query = "SELECT * FROM Customers WHERE CustomerID = " . intval($id) . " AND UserID = $user_id";
        } 
    
        elseif (!empty($name)) {
            $escapedName = $connection->real_escape_string($name);
            $query = "SELECT * FROM Customers WHERE CustomerName LIKE '%$escapedName%' And UserID = $user_id";
        } 
        elseif (!empty($phone)) {
            $escapedphone = $connection->real_escape_string($phone);
            $query = "SELECT * FROM Customers WHERE Phone LIKE '%$escapedphone%' AND UserID = $user_id";
        } 
    
        else {
            $error = "Please enter a Customer ID or Name.";
         }

         if (empty($error)) {
            $result = $connection->query($query);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                 $results[] = $row;
                }
            }   
           else {
            $error = "No customers found.";
           }
        }
     }
 }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4fc;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(20, 209, 121, 0.89);
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: green;
            color: white;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
        .record-actions form {
            display: inline-block;
            margin-right: 10px;
        }
        .value {
            background: #f9f9f9;
            padding: 5px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<div style="margin-top: 40px;"> 
<div class="container">
    <div class="box">
        <h2>Search Customer</h2>
        <form method="post">
            <label for="CustomerID">Customer ID:</label>
            <input type="number" name="CustomerID" id="CustomerID">

            <label for="CustomerName">Customer Name:</label>
            <input type="text" name="CustomerName" id="CustomerName">
            
            <label for="CustomerPhone">Customer Phone:</label>
            <input type="number" name="CustomerPhone" id="CustomerPhone" required pattern="[0-9]" title ="03123456724" maxlength="11">

            <input type="submit" value="Search">
        </form>
    </div>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php foreach ($results as $customer): ?>
        <div class="box">
            <h3><?= htmlspecialchars($customer['CustomerName']) ?></h3>
            <p><strong>Phone:</strong> <?= htmlspecialchars($customer['Phone']) ?></p>
            <p><strong>Dress Type:</strong> <?= htmlspecialchars($customer['DressType']) ?></p>

            <div class="record-actions">
                <form method="post" action="Update.php">
                    <input type="hidden" name="CustomerID" value="<?= $customer['CustomerID'] ?>">
                    <input type="submit" value="Update">
                </form>
                <form method="post" action="DeleteCustomer.php">
                    <input type="hidden" name="CustomerID" value="<?= $customer['CustomerID'] ?>">
                    <input type="submit" value="Delete">
                </form>

                <form method="post" action="Preview.php">
                    <input type="hidden" name="PreviewCustomerID" value="<?= $customer['CustomerID'] ?>">
                    <input type="submit" value="Preview">
                </form>

            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
</body>
</html>
