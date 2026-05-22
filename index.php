<?php
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="Employee Portal — Register or log in to manage your employee profile.">
     <title>Employee Portal</title>
     <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='%234f46e5' viewBox='0 0 16 16'><path d='M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6M5.945 8.68A4.7 4.7 0 0 0 5 9c-4 0-5 3-5 4v1h5v-1a5.6 5.6 0 0 1 .945-3.32M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5'/></svg>">
     <link rel="stylesheet" href="assets/styles.css">
</head>

<body>

     <div class="header">
          <header>
               <a href="index.php" class="navbar-brand">
                    <i class="bi bi-person-badge-fill"></i> Employee Portal
               </a>
          </header>
     </div>

     <div class="container welcome-container">

          <div class="welcome-hero">
               <h1>Employee Management System</h1>
               <p>Manage employee records securely. Login to your dashboard or register a new account.</p>
          </div>

          <div class="divider"></div>

          <div class="cards-wrapper">

               <div class="card">
                    <div class="card-icon"><i class="bi bi-box-arrow-in-right"></i></div>
                    <h3>Login</h3>
                    <p>Already have a passkey? Access your employee dashboard here.</p>
                    <a href="auth/login.php" class="btn btn-primary" id="cta-login">
                         <i class="bi bi-box-arrow-in-right"></i> Go to Login
                    </a>
               </div>

               <div class="card">
                    <div class="card-icon"><i class="bi bi-person-plus-fill"></i></div>
                    <h3>Register</h3>
                    <p>New employee? Register now to generate your unique passkey.</p>
                    <a href="crud/insert.php" class="btn btn-success" id="cta-register">
                         <i class="bi bi-person-plus-fill"></i> Register Now
                    </a>
               </div>

          </div>
     </div>

     <div class="footer">
          <?php include 'assets/footer.php'; ?>
     </div>

</body>
</html>