<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style/style.css">
     <title>Home</title>
     <script>
          function confirmDeletion() {
               if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
                    window.location.href = 'php/delete_account.php';
               }
          }
     </script>
</head>

<body>
     <div class="nav">
          <div class="logop">
               <a href="home.php">
                    <img src="images/logo.png" class="logo" />
               </a>
          </div>

          <div class="right-links">
               <?php
               session_start();
               include ("php/config.php");
               if (!isset($_SESSION['valid'])) {
                    header("Location: login.php");
               }

               $id = $_SESSION['id'];
               $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

               while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_id = $result['Id'];
               }

               echo "<a href='edit.php?Id=$res_id'>Edit Profile</a>";
               ?>
               <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
          </div>
     </div>
     <div class="c-div">
          <p class="c-text">Profile Info:</p>
     </div>
     <main>
          <div class="main-box top">
               <div class="bottom">
                    <div class="box">
                         <p>Name: <b><?php echo $res_Uname ?></b></p>
                    </div>
               </div>
               <div class="bottom">
                    <div class="box">
                         <p>Email: <b><?php echo $res_Email ?></b></p>
                    </div>
               </div>
               <div class="bottom">
                    <div class="box">
                         <p>Age: <b><?php echo $res_Age ?></b></p>
                    </div>
               </div>
               <div class="bottom-delete">
                    <button class="btn" onclick="confirmDeletion()">Delete Account</button>
               </div>
          </div>
     </main>
</body>

</html>