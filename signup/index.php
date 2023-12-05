<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>sign up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background-color: black;">
<br>
<h1>Signup page</h1>

<div class="form_css">
    <br><br><br>
    <form action="" method="post">
      <label for="name"><b>name</b></label><br>
      <input type="text" placeholder="Enter name" name="name" required maxlength="20"><br><br>

        <label for="username"><b>username</b></label><br>
      <input type="text" placeholder="Enter username" name="uname" required minlength="4" maxlength="15"><br><br>

        <label for="email"><b>email</b></label><br>
      <input type="email" placeholder="Enter username" name="email" required><br><br>

      <label for="password"><b>Password</b></label><br>
      <input type="password" placeholder="Enter Password" name="psw" required minlength="8" maxlength="20"><br><br>

        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-lg active">Signup</button>
        <button type="reset" class="btn btn-default btn-lg active">Clear</button><br>
        <span style=" font-size: 90%; text-align:left;"  >already have an account? <a href="../" >login</a></span>

    </form>
    <h3 id="result"></h3>
    <?php
    include_once '../includes/dbh.inc.php';

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $username = $_POST['uname'];
        $password = $_POST['psw'];
        $email = $_POST['email'];
        $output = 'unknown error';

        $checkusername = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");

        if (mysqli_num_rows($checkusername) != 0) {
            $output = 'Username already exists';
            $stat = 0;
        } else {
            $checkemail = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");

            if (mysqli_num_rows($checkemail) != 0) {
                $output = 'Email already exists';
                $stat = 0;
            } else {
                // Use prepared statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, ?, 0, 0)");
                $stmt->bind_param("ssss", $username, $password, $email, $name);

                if ($stmt->execute()) {
                    $output = 'Your account created';
                    $stat = 1;
                } else {
                    $output = 'Error';
                    $stat = 0;
                }

                $stmt->close();
            }
        }

        if ($stat === 1) {
            echo '<script>document.getElementById("result").style.color = "green";</script>';
        } else {
            echo '<script>document.getElementById("result").style.color = "red";</script>';
        }

        echo '<script>document.getElementById("result").innerHTML = "' . $output . '";</script>';
    }
    ?>
</div>

</body>
</html>