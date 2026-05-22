<?php
require_once dirname(__DIR__) . "/db.php";
require_once dirname(__DIR__) . "/plugins/email_config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $name   = $_POST['name'];
     $email  = $_POST['email'];
     $phn    = $_POST['phn'];
     $gender = isset($_POST['gender']) ? trim(strtolower($_POST['gender'])) : '';
     $dob    = $_POST['dob'];

     // Generate Passkey
     $passkey = rand(1000, 10000);

     $sql  = "INSERT INTO user (name,email,phn,gender,dob,passkey) VALUES(?,?,?,?,?,?)";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("ssissi", $name, $email, $phn, $gender, $dob, $passkey);
     $stmt->execute();

     if ($stmt) {
          $to      = $email;
          $subject = "Your Login Passkey — Employee Portal";
          $message =
               "
<div style='font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f9fafb; padding: 40px 20px; color: #374151;'>
  <div style='max-width: 500px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);'>
    
    <h2 style='margin-top: 0; color: #111827; font-size: 22px; border-bottom: 1px solid #f3f4f6; padding-bottom: 15px;'>
      Welcome to the Employee Portal!
    </h2>
    
    <p style='font-size: 16px; line-height: 1.6; margin-top: 20px;'>
      Hi <strong>$name</strong>,
    </p>
    
    <p style='font-size: 16px; line-height: 1.6;'>
      Your unique passkey is ready. Keep it safe — you'll need it to log in.
    </p>
    
    <div style='background-color: #f3f4f6; border: 1px dashed #9ca3af; padding: 20px; margin: 30px 0; text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 3px; color: #111827; border-radius: 6px;'>
      $passkey
    </div>
    
    <p style='font-size: 16px; line-height: 1.6; margin-bottom: 0;'>
      Best,<br>
      <span style='font-weight: 600; color: #111827;'>Mayank Thakkar</span>
    </p>

  </div>
</div>
";
          sendEmail($to, $subject, $message);
          header("Location: ../auth/login.php?registered=1");
          exit;
     }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="Register as a new employee to receive your unique passkey.">
     <title>Register — Employee Portal</title>
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
          <form action="insert.php" method="post" id="register-form">
               <fieldset>
                    <legend>
                         <i class="bi bi-person-plus-fill"></i> Register
                    </legend>

                    <div class="form-group">
                         <label for="name"><i class="bi bi-person-fill"></i> Full Name</label>
                         <input type="text" name="name" id="name" placeholder="e.g. John Doe" required>
                    </div>

                    <div class="form-group">
                         <label for="email"><i class="bi bi-envelope-fill"></i> Email</label>
                         <input type="email" name="email" id="email" placeholder="e.g. john@example.com" required>
                    </div>

                    <div class="form-group">
                         <label for="phn"><i class="bi bi-phone-fill"></i> Phone</label>
                         <input type="number" name="phn" id="phn" placeholder="10-digit mobile number">
                    </div>

                    <div class="form-group">
                         <label><i class="bi bi-gender-ambiguous"></i> Gender</label>
                         <div class="gender-group">
                              <input type="radio" name="gender" id="male" value="male">
                              <label for="male">Male</label>
                              <input type="radio" name="gender" id="female" value="female">
                              <label for="female">Female</label>
                         </div>
                    </div>

                    <div class="form-group">
                         <label for="dob"><i class="bi bi-calendar-fill"></i> Date of Birth</label>
                         <input type="date" name="dob" id="dob">
                    </div>

                    <button type="submit" class="btn-primary" id="btn-register">
                         <i class="bi bi-check-circle-fill"></i> Register
                    </button>

                    <p class="footer-links">
                         Already registered? <a href="../auth/login.php">Login here</a>
                         &nbsp;·&nbsp;
                         <a href="#contact">Need help?</a>
                    </p>
               </fieldset>
          </form>
     </div>
     <script>
          if (sessionStorage.getItem("visited") !== "true") {
               alert("Welcome to Mayank's World! Once you register, a login passkey will be sent to your registered email.");
               sessionStorage.setItem("visited", "true");
          }
     </script>

     <div class="footer">
          <?php include dirname(__DIR__) . "/assets/footer.php"; ?>
     </div>

</body>

</html>