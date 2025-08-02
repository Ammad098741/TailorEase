<?php
session_start();
$currentPage = "Update";
include "HeaderFile.php";
$connection = new mysqli("127.0.0.1", "root", "", "TailorEase");
if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);

$customer = null;
$message = "";
$id = null;
if (isset($_POST["CustomerID"] ) && $_SESSION["user_id"]) {
    $id = intval($_POST["CustomerID"]);
    $user_id = $_SESSION["user_id"];
    $row = $connection->query("SELECT * FROM Customers WHERE CustomerID = $id And UserId = $user_id")->fetch_assoc();
} elseif (isset($_GET["CustomerID"])) {
    $id = intval($_GET["CustomerID"]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["updateForm"])) {
    $stmt = $connection->prepare("UPDATE Customers SET 
        CustomerName=?, Phone=?, Length=?, Sleeves=?, ShoulderDepth=?, Neck=?, Chest=?, HemWidth=?, 
        HemType=?, FrontPocket=?, SidePockets=?, TrouserLength=?, AnkleWeidth=?, TrouserPocket=?, 
        NeckType=?, SleevesType=?, Pleat=?, MeasurementDate=?, DressType=? WHERE CustomerID=? And UserID = ?" );

    $stmt->bind_param("ssssssssssssssssssssi",
        $_POST["name"], $_POST["phone"], $_POST["length"], $_POST["sleeves"], $_POST["ShoulderDepth"],
        $_POST["neck"], $_POST["chest"], $_POST["HemWidth"], $_POST["HemType"], $_POST["frontPocket"],
        $_POST["sidePocket"], $_POST["ShalwarLength"], $_POST["AnkleWidth"], $_POST["TrouserPocket"],
        $_POST["NeckType"], $_POST["SleevesType"], $_POST["Pleat"], $_POST["Date"], $_POST["DressType"],
        $id,$user_id
    );

    if ($stmt->execute()) {
        $message = "Record updated successfully.";
    } else {
        $message = "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

if ($id !== null) {
    $result = $connection->query("SELECT * FROM Customers WHERE CustomerID = $id And UserID = $user_id");
    if ($result->num_rows > 0) {
        $customer = $result->fetch_assoc();
    } else {
        $message = "Customer not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Customer</title>
    <style>
        body { font-family: Arial; background: #f0f4fc;}
        .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(20, 209, 121, 0.89); }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 6px; margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 20px; padding: 10px 20px; background: green; color: white; border: none; border-radius: 8px; cursor: pointer;
        }
        .message { margin-top: 20px; color: green; font-weight: bold; }
        .radio-group { margin-top: 5px; display: flex; gap: 10px; }
    </style>
</head>
<body>
<div style="margin-top: 40px;">   
<div class="container">
    <h2>Update Customer Record</h2>
    <?php if ($customer): ?>
        <form method="post" action="">
            <input type="hidden" name="CustomerID" value="<?= $customer['CustomerID'] ?>">
            <input type="hidden" name="userID" value="<?= $customer['UserID'] ?>">
            <input type="hidden" name="updateForm" value="1">

            <label>Customer Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($customer['CustomerName']) ?>" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($customer['Phone']) ?>" required>

            <label>Length:</label>
            <input type="number" name="length" value="<?= htmlspecialchars($customer['Length']) ?>" step="0.001" required>

            <label>Sleeves:</label>
            <input type="number" name="sleeves" value="<?= htmlspecialchars($customer['Sleeves']) ?>" step="0.001" required>

            <label>Shoulder Depth:</label>
            <input type="number" name="ShoulderDepth" value="<?= htmlspecialchars($customer['ShoulderDepth']) ?>" step="0.001" required>

            <label>Neck:</label>
            <input type="number" name="neck" value="<?= htmlspecialchars($customer['Neck']) ?>" step="0.01" required>

            <label>Chest:</label>
            <input type="number" name="chest" value="<?= htmlspecialchars($customer['Chest']) ?>" step="0.01" required>

            <label>Hem Width:</label>
            <input type="number" name="HemWidth" value="<?= htmlspecialchars($customer['HemWidth']) ?>" step="0.01" required>

            <label>Hem Type:</label>
            <div class="radio-group">
                <label><input type="radio" name="HemType" value="straight hem" <?= $customer['HemType'] === 'straight hem' ? 'checked' : '' ?>> Straight</label>
                <label><input type="radio" name="HemType" value="rounded hem" <?= $customer['HemType'] === 'rounded hem' ? 'checked' : '' ?>> Rounded</label>
            </div>

            <label>Front Pocket:</label>
            <input type="number" name="frontPocket" value="<?= htmlspecialchars($customer['FrontPocket']) ?>" required>

            <label>Side Pockets:</label>
            <input type="number" name="sidePocket" value="<?= htmlspecialchars($customer['SidePockets']) ?>" required>

            <label>Shalwar Length:</label>
            <input type="number" name="ShalwarLength" value="<?= htmlspecialchars($customer['TrouserLength']) ?>" step="0.01" required>

            <label>Ankle Width:</label>
            <input type="number" name="AnkleWidth" value="<?= htmlspecialchars($customer['AnkleWeidth']) ?>" step="0.01" required>

            <label>Trouser Pocket:</label>
            <div class="radio-group">
                <label><input type="radio" name="TrouserPocket" value="Yes" <?= $customer['TrouserPocket'] === 'Yes' ? 'checked' : '' ?>> Yes</label>
                <label><input type="radio" name="TrouserPocket" value="No" <?= $customer['TrouserPocket'] === 'No' ? 'checked' : '' ?>> No</label>
            </div>

            <label>Neck Type:</label>
            <select name="NeckType">
                <option value="Band" <?= $customer['NeckType'] === 'Band' ? 'selected' : '' ?>>Band</option>
                <option value="Collar" <?= $customer['NeckType'] === 'Collar' ? 'selected' : '' ?>>Collar</option>
            </select>

            <label>Sleeves Type:</label>
            <select name="SleevesType">
                <option value="Straight Sleeves" <?= $customer['SleevesType'] === 'Straight Sleeves' ? 'selected' : '' ?>>Straight Sleeves</option>
                <option value="Cuff" <?= $customer['SleevesType'] === 'Cuff' ? 'selected' : '' ?>>Cuff</option>
            </select>

            <label>Pleat:</label>
            <div class="radio-group">
                <label><input type="radio" name="Pleat" value="Yes" <?= $customer['Pleat'] === 'Yes' ? 'checked' : '' ?>> Yes</label>
                <label><input type="radio" name="Pleat" value="No" <?= $customer['Pleat'] === 'No' ? 'checked' : '' ?>> No</label>
            </div>

            <label>Date:</label>
            <input type="date" name="Date" value="<?= htmlspecialchars($customer['MeasurementDate']) ?>">

            <label>Dress Type:</label>
            <select name="DressType">
                <option value="Shalwar Kameez" <?= $customer['DressType'] === 'Shalwar Kameez' ? 'selected' : '' ?>>Shalwar Kameez</option>
                <option value="Kurta Pajama" <?= $customer['DressType'] === 'Kurta Pajama' ? 'selected' : '' ?>>Kurta Pajama</option>
                <option value="Sherwani" <?= $customer['DressType'] === 'Sherwani' ? 'selected' : '' ?>>Sherwani</option>
                <option value="Waistcoat" <?= $customer['DressType'] === 'Waistcoat' ? 'selected' : '' ?>>Waistcoat</option>
            </select>

            <input type="submit" value="Submit">
        </form>
    <?php endif; ?>

    <?php if ($message): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
    <form method="get" action="SearchCustomer.php">
        <input type="submit" value="Back to Search" style="background: #007BFF; color: white;">
    </form>
<?php endif; ?>
</div>
</div>
</body>
</html>