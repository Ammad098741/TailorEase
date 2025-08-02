<?php
$currentPage = "DeleteCustomer.php";
include "HeaderFile.php";
session_start();
$connection = new mysqli("127.0.0.1", "root", "", "TailorEase");
if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);

$customer = null;
$message = "";
$deleted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['CustomerID']) && $_SESSION['user_id']) {
        $id = intval($_POST['CustomerID']);
        $user_id = $_SESSION['user_id'];
    } else {
        $message = "Invalid request.";
    }

    if (isset($_POST['confirmDelete'])) {
        $stmt = $connection->prepare("DELETE FROM Customers WHERE CustomerID = ? And UserID = ?");
        $stmt->bind_param("ii", $id,$user_id);
        if ($stmt->execute()) {
            $message = "Customer deleted successfully.";
            $deleted = true;
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $result = $connection->query("SELECT * FROM Customers WHERE CustomerID = $id And UserID = $user_id");
        if ($result && $result->num_rows > 0) {
            $customer = $result->fetch_assoc();
        } else {
            $message = "Customer not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Customer</title>
    <style>
        body { font-family: Arial; background: #f0f4fc; }
        .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(255, 0, 0, 0.6); }
        label { font-weight: bold; margin-top: 10px; display: block; }
        .value { background: #f9f9f9; padding: 5px; margin-bottom: 10px; border-radius: 6px; }
        input[type="submit"] {
            background: red; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;
        }
        .message { margin-top: 20px; color: green; }
    </style>
</head>
<body>
<div style="margin-top: 40px;">     
<div class="container">
    <h2>Confirm Delete</h2>

    <?php if ($deleted): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
        <a href="SearchCustomer.php">← Back to Search</a>
    <?php elseif ($customer): ?>
        <?php foreach ($customer as $field => $value): ?>
            <label><?= htmlspecialchars($field) ?></label>
            <div class="value"><?= htmlspecialchars($value) ?></div>
        <?php endforeach; ?>

        <form method="post">
            <input type="hidden" name="CustomerID" value="<?= $customer['CustomerID'] ?>">
            <input type="hidden" name="confirmDelete" value="1">
            <input type="submit" value="Confirm Delete">
        </form>
    <?php else: ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
</div>
</div>
</body>
</html>
