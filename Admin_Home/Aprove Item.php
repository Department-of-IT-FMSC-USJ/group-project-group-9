<?php
session_start();

include '../Config/Config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    if (!empty($_POST['item_ids'])) {
        $item_ids = $_POST['item_ids'];

        foreach ($item_ids as $id) {
            $id = intval($id);

            
            $insert_sql = "
                INSERT INTO approved_items 
                (Item_ID, Item_Name, Category, Item_Description, Item_Location, Date_Lost, Item_Image, Bounty)
                SELECT Item_ID, Item_Name, Category, Item_Description, LItem_Location, Date_Lost, Item_Image, Bounty
                FROM item
                WHERE Item_ID = $id
            ";

            if (!$conn->query($insert_sql)) {
                echo "Insert Error for ID $id: " . $conn->error . "<br>";
            }

           
            $delete_sql = "DELETE FROM item WHERE Item_ID = $id";
            if (!$conn->query($delete_sql)) {
                echo "Delete Error for ID $id: " . $conn->error . "<br>";
            }
        }

        echo "<script>alert('Selected items approved successfully!'); window.location.href='Show items.php';</script>";
        exit();
    } else {
        echo "<script>alert('Please select at least one item to approve.'); window.location.href='Show items.php';</script>";
        exit();
    }
} else {
    header("Location: Show items.php");
    exit();
}

$conn->close();
?>

