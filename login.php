<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="script/script.js"></script>
  <title>Login</title>
</head>

<body>
  <div class="nav-container">
    <nav>
      <a href="index.html" class="login-btn">
        <img src="images/logo.png" class="logo" />
      </a>
    </nav>
  </div>
  <div class="container">
    <div class="box form-box anim">
      <?php
      include ("php/config.php");
      if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
        $row = mysqli_fetch_assoc($result);

        if (is_array($row) && !empty($row)) {
          $_SESSION['valid'] = $row['Email'];
          $_SESSION['username'] = $row['Username'];
          $_SESSION['age'] = $row['Age'];
          $_SESSION['id'] = $row['Id'];
        } else {
          echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
          echo "<a href='login.php'><button class='btn'>Go Back</button>";
        }
        if (isset($_SESSION['valid'])) {
          header("Location: home.php");
        }
      } else {
        ?>
        <header>Login</header>
        <form action="" method="post">
          <div class="field input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" autocomplete="off" required>
          </div>

          <div class="field input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="off" required>
            <i class="toggle-password fas fa-eye" onclick="togglePassword()"></i>
          </div>

          <div class="field">
            <input type="submit" class="btn" name="submit" value="Login" required>
          </div>
          <div class="links">
            Don't have an account? <a href="register.php" class="sl-link">Sign Up Now</a>
          </div>
        </form>
      <?php } ?>
    </div>
  </div>
</body>

</html>