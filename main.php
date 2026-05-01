<?php
require_once dirname(__DIR__) . "/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Main Page</title>
     <link rel="stylesheet" type="text/css" href="style.css">
     <style>
          table {
               border-collapse: collapse;
               width: 100%;
               margin-top: 20px;
               background-color: white;
               border-radius: 10px;

          }

          th,
          td {
               border: 1px solid #dddddd;
               text-align: left;
               padding: 12px;
               margin: 12px;
          }

          th {
               background-color: #938ce9;
               color: white;
          }

          /* tr:nth-child(even) {
               background-color: #f2f2f2;
          }

          tr:hover {
               background-color: #ddd;
          } */
     </style>
</head>

<body>
     <div class="header">
          <header>
               <h3>DashBoard</h3>
               <p>Username: <?php echo $_COOKIE['username'];?></p>
          </header>
     </div>
     <div class="container">
          <table border="1" id="table">
               <thead>
                    <tr>
                         <th>Id</th>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Phone</th>
                         <th>Gender</th>
                         <th>Date of Birth</th>
                         <th>Passkey</th>
                         <th>Edit</th>
                         <th>Delete</th>
                    </tr>
               </thead>
               <?php
               $stmt = $conn->prepare("SELECT * FROM emp");
               $stmt->execute();
               $result = $stmt->get_result();
               while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $phn = $row['phn'];
                    $gender = $row['gender'];
                    $dob = $row['dob'];
                    $passkey = $row['passkey'];
                    echo " <tbody>
               <tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$phn</td>
                    <td>$gender</td>
                    <td>$dob</td>
                    <td>$passkey</td>
                    <td><a href='update.php?id=$row[id]' ><button class='btn btn-primary'>Update</button></a></td>
                    <td><a href='delete.php?id=$row[id]' ><button class='btn btn-danger'>Delete</button></a></td>
               </tr>
          </tbody> ";
               }

               ?>
          </table>
     </div>
</body>
</html>