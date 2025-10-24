<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item_ids'])) {
    // Connect to database
   include '../Config/Config.php';

    $item_ids = $_POST['item_ids'];
    $success_count = 0;

    foreach ($item_ids as $id) {
        $id = intval($id);

        // Fetch the item data from approved_items table
        $result = $conn->query("SELECT * FROM approved_items WHERE Item_ID = $id");
        if ($result && $result->num_rows == 1) {
            $item = $result->fetch_assoc();

            // Prepare insert into Found_Item table
            $stmt = $conn->prepare("INSERT INTO Found_Item 
                (Item_ID, Item_Name, Category, Item_Description, Item_Location, Date_Lost, Item_Image, Bounty) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            
            if ($stmt) {
                // Bind parameters correctly: i=integer, s=string, d=double
                $stmt->bind_param(
                    "issssssd",
                    $item['Item_ID'],
                    $item['Item_Name'],
                    $item['Category'],
                    $item['Item_Description'],
                    $item['Item_Location'],
                    $item['Date_Lost'],
                    $item['Item_Image'],
                    $item['Bounty']
                );

                if ($stmt->execute()) {
                    $success_count++;

                    // Delete from approved_items
                    $conn->query("DELETE FROM approved_items WHERE Item_ID = $id");
                    $conn->query("DELETE FROM Item_Found WHERE Lost_Item_ID = $id");
                } else {
                    echo "Error inserting Item_ID {$item['Item_ID']}: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Prepare failed: " . $conn->error;
            }
        }
    }

    $conn->close();

    // Show success/failure message
    if ($success_count > 0) {
        echo "<script>
                alert('Selected items moved to Found Items successfully!');
                window.location.href='Pay Bounties.php';
              </script>";
    } else {
        echo "<script>
                alert('No items were moved. Please check the data and try again.');
                window.location.href='../Admin_Home/Show_Approve_Item.php';
              </script>";
    }

} else {
    echo "<script>
            alert('No items selected.');
            window.location.href='../Admin_Home/Show_Approve_Item.php';
          </script>";
    exit();
}
?>
