<?php
require_once dirname(__DIR__) . "/db.php";
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

//Sql Fetch Process
$sqlFetch = "SELECT * FROM emp WHERE id = ?";
$result = mysqli_execute_query($conn, $sqlFetch, [$id]);
$row = mysqli_fetch_assoc($result);
//Fetch Records
$name = $row['name'];
$email = $row['email'];
$phn = $row['phn'];
$gender = $row['gender'];
$dob = $row['dob'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Update data</title>
     <link rel="stylesheet" href="style.css">
</head>

<body>
     <div class="header">
          <header>
               <h4>Update Details</h4>
          </header>
     </div>
     <div class="container">
          <form action="update.php" method="post">
               <input type="hidden" name="id" value="<?php echo $id; ?>">
               <div class="name">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" placeholder="Full Name" value="<?php echo $name; ?>">
               </div>
               <div class="email">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">
               </div>
               <div class="phn">
                    <label for="phn">Phone: </label>
                    <input type="number" name="phn" id="phn" maxlength="12" placeholder="Phone" value="<?php echo $phn ?>">
               </div>
               <div class="gender">
                    <label for="gender">Gender: </label>
                    <input type="radio" name="gender" id="male" value="male" <?php if($gender == 'male') echo 'checked'; ?>> <label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="female" <?php if($gender == 'female') echo 'checked'; ?>> <label
                         for="female">Female</label>
               </div>
               <div class="dob">
                    <label for="dob">Date of Birth: </label>
                    <input type="date" name="dob" id="dob" placeholder="Date of Birth" value="<?php echo $dob ?>">
               </div>
               <button type="submit" class="btn-primary">Submit</button>
          </form>
     </div>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $uid = $_POST['id'];
     $uname = $_POST['name'];
     $uemail = $_POST['email'];
     $uphn = $_POST['phn'];
     $ugender = $_POST['gender'];
     $udob = $_POST['dob'];

     $sqlUpdate = "UPDATE emp SET name = ?, email = ?, phn = ?, gender = ?, dob = ? WHERE id = ?";
     $stmt = $conn->prepare($sqlUpdate);
     $stmt->bind_param("ssissi", $uname, $uemail, $uphn, $ugender, $udob, $uid);
     $resultUpdate = $stmt->execute();

     if ($resultUpdate) {
          header("Location: main.php");
     } else {
          echo "Nahane Jaa";
     }
}

?>