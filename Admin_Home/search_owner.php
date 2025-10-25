<?php
include 'Config.php';

$owner = null;
$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['load'])) {
    $item_id = intval($_POST['item_id']);

  
    $sql = "SELECT * FROM personal_details WHERE Item_Id = $item_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $owner = $result->fetch_assoc();
    } else {
        $error = "No owner found for Item ID: $item_id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Owner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 25px 35px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #45a049;
        }

        .owner-info {
            margin-top: 20px;
            background: #f1f9f1;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            padding: 15px;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Search Item Owner</h2>
    <form method="POST" action="">
        <label for="item_id">Enter Item ID:</label>
        <input type="number" id="item_id" name="item_id" required>
        <input type="submit" name="load" value="Search Owner">
    </form>

    <?php if ($owner): ?>
        <div class="owner-info">
            <h3>Owner Details</h3>
            <p><strong>NIC:</strong> <?= htmlspecialchars($owner['NIC']) ?></p>
            <p><strong>Name:</strong> <?= htmlspecialchars($owner['Name']) ?></p>
            <p><strong>Contact Number:</strong> <?= htmlspecialchars($owner['Tel_No']) ?></p>
        </div>
    <?php elseif ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</div>

</body>
</html>
