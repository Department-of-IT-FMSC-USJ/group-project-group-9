<?php

include '../Config/Config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    if (!empty($_POST['item_ids'])) {
        foreach ($_POST['item_ids'] as $id) {
            $id = intval($id);
            $conn->query("DELETE FROM Item_Found WHERE Lost_Item_ID = $id");
        }
        echo "<script>alert('Selected items deleted successfully!'); window.location.href='';</script>";
        exit();
    } else {
        echo "<script>alert('Please select at least one item to delete.'); window.location.href='';</script>";
        exit();
    }
}


$result = $conn->query("
    SELECT f.Lost_Item_ID, f.Your_Name, f.Contact_Number, f.Location_Found, 
           f.Date_Found, f.Bank_Account_No, a.Bounty, a.Item_Image
    FROM Item_Found f
    LEFT JOIN approved_items a ON f.Lost_Item_ID = a.Item_ID
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pay Bounties - FindIt</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body { font-family: Arial, sans-serif; background-color: #f4f7f9; margin: 0; }
    .dashboard-container { display: flex; min-height: 100vh; background-color: #eef2f6; border-radius: 15px; box-shadow: 0 0 15px rgba(0,0,0,0.1); overflow: hidden; margin: 15px; }
    .sidebar { width: 250px; background-color: #ffffff; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; align-items: flex-start; border-right: 1px solid #e0e6ed; }
    .logo { display: flex; align-items: center; font-size: 24px; font-weight: bold; color: #4a90e2; margin-bottom: 30px; }
    .logo i { font-size: 30px; margin-right: 10px; }
    .nav-menu { width: 100%; }
    .nav-link { display: flex; align-items: center; padding: 12px 15px; margin-bottom: 10px; border-radius: 8px; color: #555; text-decoration: none; transition: background-color 0.3s, color 0.3s; }
    .nav-link i { font-size: 18px; margin-right: 15px; }
    .nav-link.active { background-color: #e6f2ff; color: #4a90e2; font-weight: bold; }
    .nav-link:hover { background-color: #f0f4f8; }
    .logout { margin-top: auto; color: #dc3545; }
    .main-content { flex-grow: 1; padding: 30px; }
    h2 { text-align: center; color: #333; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-top: 15px; }
    th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
    th { background-color: #74ebd5; color: #fff; }
    tr:hover { background-color: #f1f1f1; }
    img { width: 100px; height: 100px; object-fit: cover; border-radius: 5px; }
    input[type="submit"], button { margin-top: 20px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; color: #fff; font-weight: bold; }
    input[type="submit"] { background: #74ebd5; }
    input[type="submit"]:hover { background: #ACB6E5; }

    .owner-btn {
        background-color: #4da6ff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .owner-btn:hover {
        background-color: #1e90ff; 
        transform: translateY(-2px);
    }
</style>
</head>
<body>

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo"><i class="fa-solid fa-cube"></i>FindIt</div>
        <nav class="nav-menu">
            <a href="Admin Home.php" class="nav-link active"><i class="fa-solid fa-gauge-high"></i>Dashboard</a>
            <a href="Show Items.php" class="nav-link"><i class="fa-solid fa-list-check"></i>Pending Items</a>
            <a href="Show Approve Item.php" class="nav-link"><i class="fa-solid fa-trophy"></i>Approved Items</a>
            <a href="Show Found Item.php" class="nav-link"><i class="fa-solid fa-box"></i>Founded Items</a>
            <a href="Pay Bounties.php" class="nav-link"><i class="fa-solid fa-coins"></i>Pay Bounties</a>
        </nav>
        <a href="../Index.html" class="nav-link logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
    </aside>

    
    <main class="main-content">
        <h2>Pay Bounties</h2>

        <form method="POST" action="R_Bounty.php">
            <table>
                <tr>
                    <th>Select</th>
                    <th>Item Id</th>
                    <th>Founder Name</th>
                    <th>Contact Number</th>
                    <th>Location Found</th>
                    <th>Date Found</th>
                    <th>Bank Account Details</th>
                    <th>Bounty (Customer)</th>
                    <th>Bounty (Company)</th>
                    <th>Item Image</th>
                </tr>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $bounty = floatval($row['Bounty']); 
                        $imageName = basename($row['Item_Image']);
                        $imagePath = "../Home_Page/uploads/" . $imageName;

                        if (!file_exists($imagePath) || empty($imageName)) {
                            $imagePath = "../Home_Page/uploads/no-image.png"; 
                        }

                        echo "<tr>
                                <td><input type='checkbox' name='item_ids[]' value='".htmlspecialchars($row['Lost_Item_ID'])."'></td>
                                <td>".htmlspecialchars($row['Lost_Item_ID'])."</td>
                                <td>".htmlspecialchars($row['Your_Name'])."</td>
                                <td>".htmlspecialchars($row['Contact_Number'])."</td>
                                <td>".htmlspecialchars($row['Location_Found'])."</td>
                                <td>".htmlspecialchars($row['Date_Found'])."</td>
                                <td>".htmlspecialchars($row['Bank_Account_No'])."</td>
                                <td>".number_format($bounty * 0.6, 2)."</td>
                                <td>".number_format($bounty * 0.4, 2)."</td>
                                <td><img src='".htmlspecialchars($imagePath)."' alt='Item Image'></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </table>

            <input type="submit" name="approve" value="Approve">
        </form>

        <div style="margin-top: 20px;">
            <button type="button" class="owner-btn" onclick="window.location.href='owner details.php'">
                View Owner Details
            </button>
        </div>
    </main>
</div>

</body>
</html>
