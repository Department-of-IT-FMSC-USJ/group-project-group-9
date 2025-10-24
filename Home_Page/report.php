<?php
include '../Config/Config.php';
if (isset($_POST['submit'])) {
    $itemName = $_POST['itemName'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $dateLost = $_POST['dateLost'];
    $bounty = !empty($_POST['bounty']) ? $_POST['bounty'] : 0;

    // Handle image upload
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $imageName = basename($_FILES["imageUpload"]["name"]);
    $targetFilePath = $targetDir . $imageName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg','jpeg','png','gif','svg');

    if (!empty($imageName)) {
        if (in_array(strtolower($fileType), $allowTypes)) {
            if (!move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $targetFilePath)) {
                echo "<script>alert('Error uploading image.'); window.history.back();</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid image format.'); window.history.back();</script>";
            exit();
        }
    } else {
        $targetFilePath = NULL;
    }

    // Insert data
    $sql = "INSERT INTO item (Item_Name, Category, Item_Description, LItem_Location, Date_Lost, Item_Image, Bounty)
            VALUES ('$itemName', '$category', '$description', '$location', '$dateLost', '$targetFilePath', '$bounty')";

    if ($conn->query($sql) === TRUE) {
        // Get the newly inserted Item_ID
        $newItemID = $conn->insert_id;

        // Redirect to another page with Item_ID as GET parameter
        header("Location: Personal Details.php?id=" . $newItemID);
        exit();
    } else {
        echo "<script>alert('Error submitting report.'); window.history.back();</script>";
    }
}

$conn->close();
?>
