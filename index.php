<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>login page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>
    <script src="js/md5.min.js"></script>
    <script src="js/main.js"></script>
  </head>
  <body>
    <br>
    <h1><a href="/easter_egg" class="isDisabled">Login page</a></h1>
    <div>
      <div class="form_css">
        <br><br><br>
        <form action="" method="POST">
          <label for="username"><b>Username</b></label>
          <br>
          <input type="text" placeholder="Enter Username" name="uname" required minlength="4" maxlength="25"><br><br>
          <label for="password"><b>Password</b></label><br>
          <input type="password" placeholder="Enter Password" name="psw" required minlength="8" maxlength="20"><br><br>
          <button type="submit" name="submit" value="submit" class="btn btn-primary btn-lg active">Login</button>
          <span>Forgot <a href="ForgotPassword.html" >password?</a></span><br>
          <span style=" font-size: 90%; text-align:left;"  >dont have an account <a href="signup" >create one</a></span>
        </form>
        <script>
          document.getElementById("login_form").addEventListener("submit", function(e) {
            e.preventDefault();
            getData(e.target);
            challenge_one();
          });
        </script>
        <h3 id="result"></h3>
        <?php
        include_once 'includes/dbh.inc.php';

        if (isset($_POST['submit'])) {
            $username = $_POST['uname'];
            $password = $_POST['psw'];

            $sql_query = "SELECT * FROM users WHERE username = ? AND password = ?";
            $stmt = $conn->prepare($sql_query);

            $stmt->bind_param('ss', $username, $password);

            $stmt->execute();

            $result = $stmt->get_result();

            $output = 'unknown error';
            $stat = 0;

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $realpassword = $row['password'];
                $frommission = $row['frommisson'];

                if ($frommission != 0) {
                    echo '<script>setCookie("mission_' . $frommission . '", 1, 30);</script>';
                }

                $output = 'Login successful';
                $stat = 1;
            } else {
                $output = 'wrong password or username';
                $stat = 0;
            }

            if ($stat === 1) {
                echo '<script>document.getElementById("result").style.color = "green";</script>';
            } else {
                echo '<script>document.getElementById("result").style.color = "red";</script>';
            }

            echo '<script>document.getElementById("result").innerHTML = "' . $output . '";</script>';

            $stmt->close();
        }
        ?>

      </div>
      <div class="missions">
        <label><b>login to the next accounts:</b></label>
        <br>
        <span style=" font-size: 90%; text-align:left; color:white;">1. Jessica <img id="1" src="img/white_box.png" width="23" height="23"></span>
        <br>
        <span style=" font-size: 90%; text-align:left; color:white;">2. Bob <img id="2" src="img/white_box.png" width="23" height="23"></span>
        <br>
        <span style=" font-size: 90%; text-align:left; color:white;">3. Hanna <img id="3" src="img/white_box.png" width="23" height="23"></span>
        <br>
        <span style=" font-size: 90%; text-align:left; color:white;">4. Admin <img id="4" src="img/white_box.png" width="23" height="23"></span>
        <br>
        <div class="glitch" style=" font-size: 90%; text-align:left; color:white;">5. ??? <img id="5" src="img/white_box.png" width="23" height="23"></div>
        <br>
        <br>
        <div class="hint"><label><h2 style="font-size: 50px;" >hints</h2></label></div>
        <div class="hide"><ul style="color: white;">
          <li>inspect html and JavaScript code to hack jessica </li>
          <li>use dir buster to hack bob</li>
          <li>use sql injection to hack Hanna</li>
        </ul></div>
      </div>
    </div>
    <script>
      check_missions();
    </script>
  </body>
</html>