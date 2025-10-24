<?php
// Connect to database
include '../Config/Config.php';
$row = null; // To store record if found
$error = ""; // To store error messages

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $item_id = intval($_POST['item_id']); // Get user input safely

    if ($item_id > 0) {
        // Prepare query
        $stmt = $conn->prepare("SELECT Item_Id, NIC, Name, Tel_No FROM personal_details WHERE Item_Id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            $error = "No record found for Item ID $item_id.";
        }
    } else {
        $error = "Please enter a valid Item ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Personal Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f6;
            margin: 0;
            padding: 40px;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        input[type="number"] {
            padding: 8px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #357ab8;
        }
        .error {
            color: red;
            text-align: center;
        }
        .details {
            margin-top: 15px;
        }
        .details div {
            margin: 8px 0;
        }
        .back-btn {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #74ebd5;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-btn:hover {
            background-color: #ACB6E5;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Search Personal Details</h2>

    <form method="POST">
        <input type="number" name="item_id" placeholder="Enter Item ID" required>
        <input type="submit" value="Search">
    </form>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($row): ?>
        <div class="details">
            <div><strong>Item ID:</strong> <?= htmlspecialchars($row['Item_Id']) ?></div>
            <div><strong>NIC:</strong> <?= htmlspecialchars($row['NIC']) ?></div>
            <div><strong>Name:</strong> <?= htmlspecialchars($row['Name']) ?></div>
            <div><strong>Tel No:</strong> <?= htmlspecialchars($row['Tel_No']) ?></div>
        </div>
    <?php endif; ?>

    <button class="back-btn" onclick="window.location.href='Pay Bounties.php'">Back</button>
</div>

</body>
</html>
