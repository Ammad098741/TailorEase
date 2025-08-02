<?php
session_start();
$currentPage = "DisplayCustomers";
include "HeaderFile.php";

$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "TailorEase";

// Connect to DB
$connection = new mysqli($host, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

// Get the logged-in tailor's ID from session
$user_id = $_SESSION["user_id"] ?? null;

if (!$user_id) {
    die("Unauthorized access. Please log in.");
}

// Insert new record if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CustomerName = $_POST["name"];
    $Phone = $_POST["phone"];
    $Length = $_POST["length"];
    $Sleeves = $_POST["sleeves"];
    $Shoulder_Depth = $_POST["ShoulderDepth"];
    $Neck = $_POST["neck"];
    $Chest = $_POST["chest"];
    $Hem_Width = $_POST["HemWidth"];
    $Hem_Type = $_POST["HemType"];
    $front_Pocket = $_POST["frontPocket"];
    $side_Pocket = $_POST["sidePocket"];
    $Shalwar_Length = $_POST["ShalwarLength"];
    $Ankle_Width = $_POST["AnkleWidth"];
    $Trouser_Pocket = $_POST["TrouserPocket"];
    $Neck_Type = $_POST["NeckType"];
    $Sleeves_Type = $_POST["SleevesType"];
    $pleat = $_POST["Pleat"];
    $date = $_POST["Date"];
    $Dress_Type = $_POST["DressType"];

    $insert_sql = "INSERT INTO Customers 
        VALUES(NULL,'$user_id','$CustomerName','$Phone','$Length','$Sleeves','$Shoulder_Depth','$Neck', 
        '$Chest','$Hem_Width','$Shalwar_Length','$Ankle_Width','$front_Pocket','$side_Pocket',
        '$Trouser_Pocket','$Neck_Type','$Sleeves_Type','$pleat','$date','$Hem_Type','$Dress_Type')"; 

    $connection->query($insert_sql);
}

// Fetch all customer records for this tailor
$sql = "SELECT * FROM Customers WHERE UserID = $user_id ORDER BY CustomerID ASC";
$result = $connection->query($sql);
$measurements = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Measurement Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            color: #2e7d32;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .card {
            background: #e8f5e9;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .card h3 {
            margin: 0;
            font-size: 18px;
            color: #1b5e20;
        }
        .card p {
            margin: 4px 0;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Customer Measurements (<?= count($measurements) ?> Total)</h2>

    <?php if (count($measurements) > 0): ?>
        <div class="grid">
            <?php foreach ($measurements as $m): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($m["CustomerName"]) ?></h3>
                    <p><strong>Customer ID:</strong> <?= $m["CustomerID"] ?></p>
                    <p><strong>Tailor ID:</strong> <?= $m["UserID"] ?></p>
                    <p><strong>Phone:</strong> <?= $m["Phone"] ?></p>
                    <p><strong>Length:</strong> <?= $m["Length"] ?></p>
                    <p><strong>Sleeves:</strong> <?= $m["Sleeves"] ?></p>
                    <p><strong>Shoulder Depth:</strong> <?= $m["ShoulderDepth"] ?></p>
                    <p><strong>Neck:</strong> <?= $m["Neck"] ?></p>
                    <p><strong>Chest:</strong> <?= $m["Chest"] ?></p>
                    <p><strong>Hem Width:</strong> <?= $m["HemWidth"] ?></p>
                    <p><strong>Shalwar Length:</strong> <?= $m["TrouserLength"] ?></p>
                    <p><strong>Ankle Width:</strong> <?= $m["AnkleWeidth"] ?></p>
                    <p><strong>Front Pocket:</strong> <?= $m["FrontPocket"] ?></p>
                    <p><strong>Side Pockets:</strong> <?= $m["SidePockets"] ?></p>
                    <p><strong>Trouser Pocket:</strong> <?= $m["TrouserPocket"] ?></p>
                    <p><strong>Neck Type:</strong> <?= $m["NeckType"] ?></p>
                    <p><strong>Sleeves Type:</strong> <?= $m["SleevesType"] ?></p>
                    <p><strong>Pleat:</strong> <?= $m["Pleat"] ?></p>
                    <p><strong>Measurement Date:</strong> <?= $m["MeasurementDate"] ?></p>
                    <p><strong>Hem Type:</strong> <?= $m["HemType"] ?></p>
                    <p><strong>Dress Type:</strong> <?= $m["DressType"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="text-align:center; color:#777;">No measurements found.</p>
    <?php endif; ?>
</div>

</body>
</html>
