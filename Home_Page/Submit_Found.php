<?php
// Database connection
include '../Config/Config.php';

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Get form data and sanitize
    $item_id = intval($_POST['item_id']);
    $finder_name = $conn->real_escape_string($_POST['finder_name']);
    $finder_contact = $conn->real_escape_string($_POST['finder_contact']);
    $location_found = $conn->real_escape_string($_POST['location_found']);
    $date_found = $_POST['date_found']; // YYYY-MM-DD format
    $bank_acc = $conn->real_escape_string($_POST['acc']);

    // Handle image upload
    $uploaded_image = NULL;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "Found/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name; // unique filename
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $uploaded_image = $target_file;
        }
    }
$sql = "INSERT INTO Item_Found (Lost_Item_ID, Your_Name, Contact_Number, Location_Found, Date_Found, Bank_Account_No, Uploaded_Image)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $item_id, $finder_name, $finder_contact, $location_found, $date_found, $bank_acc, $uploaded_image);

    if ($stmt->execute()) {
        echo "<script>alert('Found Item Add successfully!'); window.location.href='../Index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
