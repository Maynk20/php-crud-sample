<?php
require_once dirname(__DIR__) . "/db.php";
$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;

$sqlFetch = "SELECT * FROM user WHERE id = ?";
$result   = mysqli_execute_query($conn, $sqlFetch, [$id]);
$row      = mysqli_fetch_assoc($result);

$name   = $row['name']   ?? '';
$email  = $row['email']  ?? '';
$phn    = $row['phn']    ?? '';
$gender = isset($row['gender']) ? trim(strtolower($row['gender'])) : '';
$dob    = $row['dob']    ?? '';
//New update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $uid     = (int)$_POST['id'];
     $uname   = $_POST['name'];
     $uemail  = $_POST['email'];
     $uphn    = $_POST['phn'];
     $ugender = isset($_POST['gender']) ? trim(strtolower($_POST['gender'])) : '';
     $udob    = $_POST['dob'];

     $sqlUpdate = "UPDATE user SET name = ?, email = ?, phn = ?, gender = ?, dob = ? WHERE id = ?";
     $stmt      = $conn->prepare($sqlUpdate);
     $stmt->bind_param("ssissi", $uname, $uemail, $uphn, $ugender, $udob, $uid);
     $resultUpdate = $stmt->execute();

     if ($resultUpdate) {
          header("Location: main.php");
     } else {
          echo "<p class='alert alert-danger'>Update failed. Please try again.</p>";
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="Edit employee details in the Employee Portal.">
     <title>Edit Employee — Employee Portal</title>
     <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='%234f46e5' viewBox='0 0 16 16'><path d='M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6M5.945 8.68A4.7 4.7 0 0 0 5 9c-4 0-5 3-5 4v1h5v-1a5.6 5.6 0 0 1 .945-3.32M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5'/></svg>">
     <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>

     <div class="header">
          <header>
               <a href="../index.php" class="navbar-brand">
                    <i class="bi bi-person-badge-fill"></i> Employee Portal
               </a>
               <a href="main.php" class="btn" id="btn-back">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
               </a>
          </header>
     </div>

     <div class="container-form">
          <form action="update.php" method="post" id="update-form">
               <input type="hidden" name="id" value="<?php echo $id; ?>">
               <fieldset>
                    <legend>
                         <i class="bi bi-pencil-square"></i> Edit Details
                    </legend>

                    <div class="name">
                         <label for="name"><i class="bi bi-person-fill"></i> Full Name</label>
                         <input type="text" name="name" id="name" placeholder="Full Name"
                              value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>

                    <div class="email">
                         <label for="email"><i class="bi bi-envelope-fill"></i> Email</label>
                         <input type="email" name="email" id="email" placeholder="Email"
                              value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>

                    <div class="phn">
                         <label for="phn"><i class="bi bi-phone-fill"></i> Phone</label>
                         <input type="number" name="phn" id="phn" placeholder="Phone"
                              value="<?php echo htmlspecialchars($phn); ?>">
                    </div>

                    <div class="gender">
                         <label><i class="bi bi-gender-ambiguous"></i> Gender</label>
                         <div class="gender-group">
                              <input type="radio" name="gender" id="male" value="male"
                                   <?php if ($gender === 'male') echo 'checked'; ?>>
                              <label for="male">Male</label>
                              <input type="radio" name="gender" id="female" value="female"
                                   <?php if ($gender === 'female') echo 'checked'; ?>>
                              <label for="female">Female</label>
                         </div>
                    </div>

                    <div class="dob">
                         <label for="dob"><i class="bi bi-calendar-fill"></i> Date of Birth</label>
                         <input type="date" name="dob" id="dob"
                              value="<?php echo htmlspecialchars($dob); ?>">
                    </div>

                    <button type="submit" class="btn-primary" id="btn-update">
                         <i class="bi bi-check-circle-fill"></i> Save Changes
                    </button>
               </fieldset>
          </form>
     </div>

     <div class="footer">
          <?php include dirname(__DIR__) . "/assets/footer.php"; ?>
     </div>

</body>

</html>