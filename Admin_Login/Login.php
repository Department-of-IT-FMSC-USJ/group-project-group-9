<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include '../Config/Config.php';

    
    $u_name = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM Admin_Data_Info WHERE username='$u_name' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
        $row = $result->fetch_assoc();
        $_SESSION['name'] = $row['Name'];
        $_SESSION['admin_name'] = $row['u_name'];
        $_SESSION['email'] = $row['Email'];
        $_SESSION['telephone'] = $row['telephone_num'];
         $_SESSION['id'] = $row['admin_id'];

        echo "<script>
                alert('Login Successful! Welcome, {$row['Admin_Name']}');
                window.location.href = '../Admin_Home/Admin Home.php';
              </script>";
    } else {
        echo "<script>
                alert('Login Error! Invalid username or password.');
                window.location.href = 'Admin Login.html';
              </script>";
    }

    $conn->close();
}
?>

