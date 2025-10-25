<?php
include '../Config/Config.php';


$sql = "SELECT * FROM approved_items"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approved Items - FindIt</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f9; margin: 0; padding: 30px; position: relative; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #74ebd5; color: #fff; }
        tr:hover { background-color: #f1f1f1; }
        img { width: 100px; height: 100px; object-fit: cover; border-radius: 5px; }

   
        .exit-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        .exit-btn:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>

<h2><center>Approved Items Table</center></h2>

<table>
    <tr>
        <th>Item Id</th>
        <th>Item Name</th>
        <th>Category</th>
        <th>Item Description</th>
        <th>Item Location</th>
        <th>Date Lost</th>
        <th>Item Image</th>
        <th>Bounty</th>
    </tr>

    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imageName = basename($row['Item_Image']);
            $imageUrl = "uploads/" . $imageName;

            if (!file_exists($imageUrl) || empty($row['Item_Image'])) {
                $imageUrl = "uploads/no-image.png";
            }

            echo "<tr>
                    <td>".htmlspecialchars($row['Item_ID'])."</td>
                    <td>".htmlspecialchars($row['Item_Name'])."</td>
                    <td>".htmlspecialchars($row['Category'])."</td>
                    <td>".htmlspecialchars($row['Item_Description'])."</td>
                    <td>".htmlspecialchars($row['Item_Location'])."</td>
                    <td>".htmlspecialchars($row['Date_Lost'])."</td>
                    <td><img src='".htmlspecialchars($imageUrl)."' alt='Item Image'></td>
                    <td>".htmlspecialchars($row['Bounty'])."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No records found</td></tr>";
    }

    $conn->close();
    ?>
</table>


<a href="../Index.html" class="exit-btn">Exit</a>

</body>
</html>
