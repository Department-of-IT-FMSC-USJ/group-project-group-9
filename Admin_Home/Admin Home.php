
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php"); // Redirect if not logged in
    exit();
}
?>
    <!DOCTYPE html>





    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="Admin Home.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>

    <body>

        <div class="dashboard-container">
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

            <main class="main-content">
                <header class="topbar">


                </header>

                <div class="profile-card">
                    
                    <div class="profile-details">
                        <div class="profile-header">
                            <div class="profile-info">
                                <h3>
                                    <?php echo ($_SESSION['name']); ?>
                                </h3>
                                <span class="role">System Administrator</span>
                            </div>
                            <i class="fa-solid fa-pen edit-icon"></i>
                        </div>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fa-solid fa-envelope"></i>
                                <span><?php echo ($_SESSION['email']); ?></span>
                            </div>
                            <div class="contact-item">
                                <i class="fa-solid fa-phone"></i>
                                <span><?php echo ($_SESSION['telephone']); ?></span>
                            </div>
                           <div class="contact-item">
                                <i class="fa-solid fa-id-card"></i>
                                 <span>Admin-ID: <?php echo $_SESSION['id']; ?></span>
                            </div>

                          <a href="Create Form.html"> Create Admin Account </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        
    </body>

    </html>
