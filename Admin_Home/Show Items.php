<?php
include '../Config/Config.php';
$result = $conn->query("SELECT * FROM item;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Items - FindIt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            background-color: #eef2f6;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 15px;
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            border-right: 1px solid #e0e6ed;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: #4a90e2;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 30px;
            margin-right: 10px;
        }

        .nav-menu {
            width: 100%;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            color: #555;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link i {
            font-size: 18px;
            margin-right: 15px;
        }

        .nav-link.active {
            background-color: #e6f2ff;
            color: #4a90e2;
            font-weight: bold;
        }

        .nav-link:hover {
            background-color: #f0f4f8;
        }

        .logout {
            margin-top: auto;
            color: #dc3545;
        }

       \
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #74ebd5;
            color: #fff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background: #74ebd5;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background: #ACB6E5;
        }
       .owner-btn {
    background-color: #74ebd5; /* Soft teal/light blue */
    color: #ffffff;            /* White text */
    border: none;
    padding: 8px 18px;         /* Reduced padding */
    border-radius: 6px;
    font-size: 14px;           /* Slightly smaller text */
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.owner-btn:hover {
    background-color: #45c1aa; /* Darker teal on hover */
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}


    </style>
</head>
<body>

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-cube"></i>
            <span>FindIt</span>
        </div>
        <nav class="nav-menu">
            <a href="Admin Home.php" class="nav-link active">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
            <a href="Show Items.php" class="nav-link">
                <i class="fa-solid fa-list-check"></i>
                <span>Pending Items</span>
            </a>
            <a href="Show Approve Item.php" class="nav-link">
                <i class="fa-solid fa-trophy"></i>
                <span>Approved Items</span>
            </a>
            <a href="Show Found Item.php" class="nav-link">
                <i class="fa-solid fa-box"></i>
                <span>Founded Items</span>
            </a>
            <a href="Pay Bounties.php" class="nav-link">
                <i class="fa-solid fa-coins"></i>
                <span>Pay Bounties</span>
            </a>
        </nav>
        <a href="../Index.html" class="nav-link logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <h2>Pending Items Table</h2>
        <form method="POST" action="Aprove Item.php">
            <table>
                <tr>
                    <th>Select</th>
                    <th>Item Id</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Date Lost</th>
                    <th>Item Image</th>
                    <th>Bounty</th>
                </tr>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                        $imagePath = htmlspecialchars($row['Item_Image']);
                        if (!str_starts_with($imagePath, 'Admin_Home/uploads/')) {
                            $imagePath = 'Admin_Home/uploads/' . $imagePath;
                        }

                        echo "<tr>
                                <td><input type='checkbox' name='item_ids[]' value='".htmlspecialchars($row['Item_ID'])."'></td>
                                <td>".htmlspecialchars($row['Item_ID'])."</td>
                                <td>".htmlspecialchars($row['Item_Name'])."</td>
                                <td>".htmlspecialchars($row['Category'])."</td>
                                <td>".htmlspecialchars($row['Item_Description'])."</td>
                                <td>".htmlspecialchars($row['LItem_Location'])."</td>
                                <td>".htmlspecialchars($row['Date_Lost'])."</td>
                                <td><a href='$imagePath' target='_blank'><img src='$imagePath' alt='Item Image'></a></td>
                                <td>".htmlspecialchars($row['Bounty'])."</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </table>

            <input type="submit" name="approve" value="Add To Approved Items">
        </form>
        <div style="margin-top: 20px;">
            <button type="button" class="owner-btn" onclick="window.location.href='Owner_Details Pending.php'">
                View Owner Details
            </button>
        </div>

    </main>
</div>

</body>
</html>
