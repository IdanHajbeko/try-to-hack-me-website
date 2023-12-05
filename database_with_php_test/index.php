<?php
    include_once 'includes/dbh.inc.php'
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
<?php
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error in SQL query: " . $conn->error);
    }

    $resultcheck = mysqli_num_rows($result);

    if ($resultcheck > 0) {
        echo "<table border='1'>";
        echo "<tr><th>User ID</th><th>Username</th><th>Email</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }
?>


</body>
</html>