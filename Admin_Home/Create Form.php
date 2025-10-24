<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    include '../Config/Config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $Name = $_POST['Name'];
    $telephone_num = $_POST['telephone_num'];
    $Email = $_POST['Email'];

// Insert data
    $sql = "INSERT INTO Admin_Data_Info(username, password, Name, telephone_num, Email)
        VALUES ('$username', '$password', '$Name', '$telephone_num', '$Email')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Account Created successfully!'); window.location.href='../Admin_Login/Admin Login.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>