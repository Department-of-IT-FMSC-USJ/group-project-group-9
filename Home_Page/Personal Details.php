<?php
$itemID = isset($_GET['id']) ? intval($_GET['id']) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Found Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 420px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .success-box {
            background: #e8f6ee;
            border: 1px solid #c8e6c9;
            color: #256029;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .item-id {
            font-size: 22px;
            color: #007bff;
            font-weight: bold;
            margin-top: 5px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            transition: border 0.3s;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php if ($itemID): ?>
            <div class="success-box">
                <h3>✅ Lost Item Submitted Successfully!</h3>
                <p>Your Item ID:</p>
                <div class="item-id"><?= htmlspecialchars($itemID) ?></div>
                <p>Please save this ID for your reference.</p>
            </div>
        <?php else: ?>
            <div class="success-box" style="background:#fdecea; border-color:#f5c6cb; color:#721c24;">
                <h3> No Item ID Found</h3>
            </div>
        <?php endif; ?>

        <h2>Add Personal Details</h2>
        <form method="POST" action="personal_details.php" enctype="multipart/form-data">

            <label for="itemid">Item Id:</label>
            <input type="number" id="itemid" name="itemid" required>

            <label for="nic">NIC:</label>
            <input type="text" id="nic" name="nic" required>

            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" required>

            <button type="submit" class="submit-btn">Submit Details</button>
        </form>

        <div class="footer">
            <p>Thank you for helping make the community safer </p>
        </div>
    </div>

</body>
</html>
