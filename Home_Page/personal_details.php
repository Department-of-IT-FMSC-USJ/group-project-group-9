<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "founditdb";

$conn = new mysqli($servername, $username, $password, $dbname);


include 'Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemid = intval($_POST['itemid']);
    $nic = $_POST['nic'];
    $name = trim($_POST['name']);
    $contact = trim($_POST['contact']);

  
    $sql = "INSERT INTO personal_details (Item_Id,NIC, Name, Tel_No)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi",$itemid, $nic, $name, $contact);

    if ($stmt->execute()) {
        
        echo "<script>
                alert('Personal details submitted successfully!');
                window.location.href = '../Index.html';
              </script>";
        exit();
    } else {
     
        echo "<script>
                alert('Error submitting details. Please try again.');
                window.history.back();
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>
