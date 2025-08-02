<?php
session_start();
$currentPage = "SearchCustomer";
include "HeaderFile.php";

$connection = new mysqli("127.0.0.1", "root", "", "TailorEase");
if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);
   $previewCustomer = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preview handling
    if (isset($_POST['PreviewCustomerID']) && $_SESSION['user_id']) {
        $user_id = $_SESSION['user_id'];
        $previewID = intval($_POST['PreviewCustomerID']);
        if(!$user_id){
            $error = "Customer Not Found For Preview";
        }
        else{
            $previewResult = $connection->query("SELECT * FROM Customers WHERE CustomerID = $previewID And UserID = $user_id");

            if ($previewResult && $previewResult->num_rows > 0) {
                $previewCustomer = $previewResult->fetch_assoc();
            } else {
                 $error = "Customer not found for preview.";
                }
        }
    }    
}   
?>
<html>
<body>
    <head>
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
<div style="margin-top: 40px;">   
<div class="container">
    <?php if (!empty($previewCustomer)): ?>
        <form method="post" action="">
            <h2>Preview Customer</h2>
            <input type="hidden" name="CustomerID" value="<?= $previewCustomer['CustomerID'] ?>">
            <input type="hidden" name="updateForm" value="1">

            <label>Customer Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($previewCustomer['CustomerName']) ?>" readonly>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($previewCustomer['Phone']) ?>" readonly>

            <label>Length:</label>
            <input type="number" name="length" value="<?= htmlspecialchars($previewCustomer['Length']) ?>" step="0.001" readonly>

            <label>Sleeves:</label>
            <input type="number" name="sleeves" value="<?= htmlspecialchars($previewCustomer['Sleeves']) ?>" step="0.001" readonly>

            <label>Shoulder Depth:</label>
            <input type="number" name="ShoulderDepth" value="<?= htmlspecialchars($previewCustomer['ShoulderDepth']) ?>" step="0.001" readonly>

            <label>Neck:</label>
            <input type="number" name="neck" value="<?= htmlspecialchars($previewCustomer['Neck']) ?>" step="0.01" readonly>

            <label>Chest:</label>
            <input type="number" name="chest" value="<?= htmlspecialchars($previewCustomer['Chest']) ?>" step="0.01" readonly>

            <label>Hem Width:</label>
            <input type="number" name="HemWidth" value="<?= htmlspecialchars($previewCustomer['HemWidth']) ?>" step="0.01" readonly>

            <label>Hem Type:</label>
            <div class="radio-group" >
                <label><input type="radio" name="HemType" disabled value="straight hem" <?= $previewCustomer['HemType'] === 'straight hem' ? 'checked' : '' ?>> Straight</label>
                <label><input type="radio" name="HemType"disabled value="rounded hem" <?= $previewCustomer['HemType'] === 'rounded hem' ? 'checked' : '' ?>> Rounded</label>
            </div>

            <label>Front Pocket:</label>
            <input type="number" name="frontPocket" readonly value="<?= htmlspecialchars($previewCustomer['FrontPocket']) ?>" required>

            <label>Side Pockets:</label>
            <input type="number" name="sidePocket" readonly value="<?= htmlspecialchars($previewCustomer['SidePockets']) ?>" required>

            <label>Shalwar Length:</label>
            <input type="number" name="ShalwarLength" readonly value="<?= htmlspecialchars($previewCustomer['TrouserLength']) ?>" step="0.01" required>

            <label>Ankle Width:</label>
            <input type="number" name="AnkleWidth" readonly value="<?= htmlspecialchars($previewCustomer['AnkleWeidth']) ?>" step="0.01" required>

            <label>Trouser Pocket:</label>
            <div class="radio-group">
                <label><input type="radio" name="TrouserPocket" disabled value="Yes" <?= $previewCustomer['TrouserPocket'] === 'Yes' ? 'checked' : '' ?>> Yes</label>
                <label><input type="radio" name="TrouserPocket" disabled value="No" <?= $previewCustomer['TrouserPocket'] === 'No' ? 'checked' : '' ?>> No</label>
            </div>

            <label>Neck Type:</label>
            <select name="NeckType" disabled>
                <option value="Band" <?= $previewCustomer['NeckType'] === 'Band' ? 'selected' : '' ?>>Band</option>
                <option value="Collar" <?= $previewCustomer['NeckType'] === 'Collar' ? 'selected' : '' ?>>Collar</option>
            </select>

            <label>Sleeves Type:</label>
            <select name="SleevesType" disabled>
                <option value="Straight Sleeves" <?= $previewCustomer['SleevesType'] === 'Straight Sleeves' ? 'selected' : '' ?>>Straight Sleeves</option>
                <option value="Cuff" <?= $previewCustomer['SleevesType'] === 'Cuff' ? 'selected' : '' ?>>Cuff</option>
            </select>

            <label>Pleat:</label>
            <div class="radio-group" >
                <label><input type="radio" name="Pleat" disabled value="Yes" <?= $previewCustomer['Pleat'] === 'Yes' ? 'checked' : '' ?>> Yes</label>
                <label><input type="radio" name="Pleat" disabled value="No" <?= $previewCustomer['Pleat'] === 'No' ? 'checked' : '' ?>> No</label>
            </div>

            <label>Date:</label>
            <input type="date" name="Date" value="<?= htmlspecialchars($previewCustomer['MeasurementDate']) ?>" readonly>

            <label>Dress Type:</label>
            <select name="DressType" disabled>
                <option value="Shalwar Kameez" <?= $previewCustomer['DressType'] === 'Shalwar Kameez' ? 'selected' : '' ?>>Shalwar Kameez</option>
                <option value="Kurta Pajama" <?= $previewCustomer['DressType'] === 'Kurta Pajama' ? 'selected' : '' ?>>Kurta Pajama</option>
                <option value="Sherwani" <?= $previewCustomer['DressType'] === 'Sherwani' ? 'selected' : '' ?>>Sherwani</option>
                <option value="Waistcoat" <?= $previewCustomer['DressType'] === 'Waistcoat' ? 'selected' : '' ?>>Waistcoat</option>
            </select>
        </form>
    <?php endif; ?>
</div>
</div>
</body>
</html>
