<?php
require_once dirname(__DIR__) . "/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Employee Register</title>
     <link rel="stylesheet" href="style.css">
</head>

<body>
     <div class="header">
          <header>
               <h2>Employee Basic Details</h2>
          </header>
     </div>
     <div class="container">
          <form action="insert.php" method="post">
               <fieldset>
                    <legend>Basic Details</legend>
                    <div class="name">
                         <label for="name">Name: </label>
                         <input type="text" name="name" id="name" placeholder="Full Name">
                    </div>
                    <div class="email">
                         <label for="email">Email: </label>
                         <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="phn">
                         <label for="phn">Phone: </label>
                         <input type="number" name="phn" id="phn" maxlength="12" placeholder="Phone">
                    </div>
                    <div class="gender">
                         <label for="gender">Gender: </label>
                         <input type="radio" name="gender" id="male" value="male"> <label for="male">Male</label>
                         <input type="radio" name="gender" id="female" value="female"> <label
                              for="female">Female</label>
                    </div>
                    <div class="dob">
                         <label for="dob">Date of Birth: </label>
                         <input type="date" name="dob" id="dob" placeholder="Date of Birth">
                    </div>
                    <button type="submit" class="btn-primary">Submit</button>
               </fieldset>
          </form>
          <p><a href="index.php" style="color: blue;">Login</a> | <a href="#contact" style="color: blue;">Contact Help!</a></p>
     </div>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $phn = $_POST['phn'];
     $gender = $_POST['gender'];
     $dob = $_POST['dob'];

     // Genrate Passkey
     $i = 1000; //Number < 4
     $passkey = rand($i, 10000); //Chosse Random Number for uniqueness

     //Sql Statement
     $sql = "INSERT INTO emp (name,email,phn,gender,dob,passkey) VALUES(?,?,?,?,?,?)";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("ssissi", $name, $email, $phn, $gender, $dob, $passkey);
     $stmt->execute();
     //check the Records
     if ($stmt) {
          echo "Record Insert Success <br>";
          echo "Mr./Ms $name Remember Passkey For Login '$passkey' ";
     } else {
          echo "shit";
     }
}


?>