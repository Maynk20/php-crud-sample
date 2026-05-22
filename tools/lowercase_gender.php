<?php
require_once dirname(__DIR__) . "/db.php";

// Safety: require explicit confirmation to run the destructive update
if (!isset($_GET['confirm']) || $_GET['confirm'] !== '1') {
     echo "This will normalize the 'gender' column in the 'user' table to lowercase and trim whitespace.<br>";
     echo "To execute, open this URL with ?confirm=1 in your browser or run `php tools/lowercase_gender.php` from the project root (careful!).";
     echo "<pre>UPDATE user SET gender = LOWER(TRIM(gender));</pre>";
     exit;
}

$sql = "UPDATE user SET gender = LOWER(TRIM(gender))";
if ($conn->query($sql) === TRUE) {
     echo "Normalization complete. Rows affected: " . $conn->affected_rows;
     echo "<br><br>Sample data (first 30 rows):<br>";
     $res = $conn->query("SELECT id, name, gender FROM user LIMIT 30");
     if ($res) {
          echo "<table border=1 cellpadding=6><tr><th>id</th><th>name</th><th>gender</th></tr>";
          while ($r = $res->fetch_assoc()) {
               echo "<tr><td>" . htmlspecialchars($r['id']) . "</td><td>" . htmlspecialchars($r['name']) . "</td><td>" . htmlspecialchars($r['gender']) . "</td></tr>";
          }
          echo "</table>";
     }
} else {
     echo "Error running update: " . $conn->error;
}
