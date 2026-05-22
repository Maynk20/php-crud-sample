<?php
require_once dirname(__DIR__) . "/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="Login to your Employee Portal account using your passkey.">
     <title>Login — Employee Portal</title>
     <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='%234f46e5' viewBox='0 0 16 16'><path d='M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6M5.945 8.68A4.7 4.7 0 0 0 5 9c-4 0-5 3-5 4v1h5v-1a5.6 5.6 0 0 1 .945-3.32M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5'/></svg>">
     <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>

     <div class="header">
          <header>
               <a href="../index.php" class="navbar-brand">
                    <i class="bi bi-person-badge-fill"></i> Employee Portal
               </a>
          </header>
     </div>

     <div class="container-form">
          <form action="login.php" method="post" id="login-form">
               <fieldset>
                    <legend>
                         <i class="bi bi-shield-lock-fill"></i> Sign In
                    </legend>

                    <div class="form-group">
                         <label for="passkey">
                              <i class="bi bi-key-fill"></i> Passkey
                         </label>
                         <input type="number" name="login" id="passkey" placeholder="Enter your passkey" autocomplete="off">
                    </div>

                    <button type="submit" class="btn-primary" id="btn-login">
                         <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>

                    <p class="footer-links">
                         Don't have an account? <a href="../crud/insert.php">Register here</a>
                         &nbsp;·&nbsp;
                         <a href="#contact">Need help?</a>
                    </p>
               </fieldset>
          </form>
     </div>

     <div class="footer">
          <?php include dirname(__DIR__) . "/assets/footer.php"; ?>
     </div>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $login = $_POST['login'];
     $stmt = $conn->prepare("SELECT name,passkey FROM user WHERE passkey = ?");
     $stmt->bind_param("i", $login);
     $stmt->execute();
     $result = $stmt->get_result();
     $row = $result->fetch_assoc();
     $name = $row['name'] ?? null;
     $passkey = $row['passkey'] ?? null;
     if ($passkey && $passkey == $login) {
          setcookie("username", $name, time() + 86900, "/");
          header("Location: ../crud/main.php");
     } else {
          echo "<script>
               document.addEventListener('DOMContentLoaded', function() {
                    var form = document.getElementById('login-form');
                    var alert = document.createElement('div');
                    alert.className = 'alert alert-danger';
                    alert.innerHTML = '<i class=\"bi bi-exclamation-circle-fill\"></i> Invalid passkey. Please try again.';
                    form.insertBefore(alert, form.firstChild);
               });
          </script>";
     }
}
?>