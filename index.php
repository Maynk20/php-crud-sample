<?php
require_once dirname(__DIR__) . "/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Employee Login</title>
     <link rel="stylesheet" href="style.css">
</head>

<body>
     <div class="header">
          <header>
               <h3>Login</h3>
          </header>
     </div>
     <div class="container">
          <form action="index.php" method="post">
               <fieldset>
                    <legend>Employee Login</legend>
                    <label for="passkey">Passkey: </label>
                    <input type="number" name="login" id="passkey" placeholder="Enter Passkey">
                    <button type="submit" class="btn-primary">Login</button>

                    <p>
                         <span><a href="insert.php" style="color: blue;">Register?</a></span>
                         |
                         <span>Troubleshooting for Login? <a href="#contact" style="color: blue;">Contact Help!</a></span>

                    </p>
               </fieldset>
          </form>
     </div>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $login = $_POST['login'];
     //sql Safely
     $stmt = $conn->prepare("SELECT name,passkey FROM emp WHERE passkey = ?");
     $stmt->bind_param("i", $login);
     $stmt->execute();
     $result = $stmt->get_result();
     $row = $result->fetch_assoc();
     $name = $row['name'];
     $passkey = $row['passkey'];
     if ($passkey && $passkey == $login) {
          setcookie("username", $name, time() + 86900, "/");
          header("Location: main.php");
     } else {
          echo  "Fail to Login";
     }
}

?>