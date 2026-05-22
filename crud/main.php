<?php
require_once dirname(__DIR__) . "/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="Employee dashboard — view and manage all employee records.">
     <title>Dashboard — Employee Portal</title>
     <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='%234f46e5' viewBox='0 0 16 16'><path d='M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6M5.945 8.68A4.7 4.7 0 0 0 5 9c-4 0-5 3-5 4v1h5v-1a5.6 5.6 0 0 1 .945-3.32M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5'/></svg>">
     <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>

     <div class="header">
          <header>
               <a href="../index.php" class="navbar-brand">
                    <i class="bi bi-person-badge-fill"></i> Employee Portal
               </a>
               <p><i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($_COOKIE['username'] ?? 'Guest'); ?></p>
          </header>
     </div>

     <div class="container">
          <div class="table-header">
               <h2><i class="bi bi-table"></i> All Employees</h2>
               <a href="insert.php" class="btn btn-primary" id="btn-add-employee">
                    <i class="bi bi-person-plus-fill"></i> Add Employee
               </a>
          </div>

          <div class="table-wrapper">
               <table id="employees-table">
                    <thead>
                         <tr>
                              <th>#</th>
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
                    <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM user");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                         $id      = htmlspecialchars($row['id']);
                         $name    = htmlspecialchars($row['name']);
                         $email   = htmlspecialchars($row['email']);
                         $phn     = htmlspecialchars($row['phn']);
                         $gender  = htmlspecialchars($row['gender']);
                         $dob     = htmlspecialchars($row['dob']);
                         $passkey = htmlspecialchars($row['passkey']);
                         $genderBadge = $gender === 'male'
                              ? '<span class="badge badge-male">Male</span>'
                              : '<span class="badge badge-female">Female</span>';
                         echo "
                         <tr>
                              <td>$id</td>
                              <td>$name</td>
                              <td>$email</td>
                              <td>$phn</td>
                              <td>$genderBadge</td>
                              <td>$dob</td>
                              <td>$passkey</td>
                              <td>
                                   <a href='update.php?id=$row[id]' class='btn btn-primary'>
                                        <i class='bi bi-pencil-fill'></i> Edit
                                   </a>
                              </td>
                              <td>
                                   <a href='delete.php?id=$row[id]' class='btn btn-danger'
                                        onclick='return confirm(\"Delete this record?\")'>
                                        <i class='bi bi-trash-fill'></i> Delete
                                   </a>
                              </td>
                         </tr>";
                    }
                    ?>
                    </tbody>
               </table>
          </div>
     </div>

     <div class="footer">
          <?php include dirname(__DIR__) . "/assets/footer.php"; ?>
     </div>

</body>
</html>