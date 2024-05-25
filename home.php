<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GK Vander</title>
  <link rel="stylesheet" href="style/style.css" />
  <script>
    window.addEventListener("DOMContentLoaded", function () {
      const navLinks = document.querySelectorAll("nav ul li a");
      const currentLocation = window.location.href;

      const homeLink = document.querySelector("nav ul li:first-child a");
      homeLink.classList.add("active");

      navLinks.forEach((link) => {
        link.addEventListener("click", function () {
          navLinks.forEach((navLink) => {
            navLink.classList.remove("active");
          });
          link.classList.add("active");
        });
      });

      const menuIcon = document.querySelector(".menu-icon");
      const closeIcon = document.querySelector(".close-icon");
      const navDrawer = document.querySelector(".nav-drawer");

      menuIcon.addEventListener("click", function () {
        navDrawer.classList.add("active");
      });

      closeIcon.addEventListener("click", function () {
        navDrawer.classList.remove("active");
      });
    });
  </script>
</head>

<body>
  <div class="hero">
    <nav>
      <img src="images/logo.png" class="logo" />
      <ul>
        <li><a href="home.php" class="nav-link">Home</a></li>
        <li><a href="contact.html" class="nav-link">Contact US</a></li>
      </ul>
      <div>
        <a href="profile.php" class="login-btn">Profile</a>
        <a href="php/logout.php" class="signup-btn">Log Out</a>
      </div>
      <div class="menu-icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </nav>
    <div class="nav-drawer">
      <div class="close-icon">&times;</div>
      <ul>
        <li><a href="home.php" class="nav-link">Home</a></li>
        <li><a href="contact.html" class="nav-link">Contact US</a></li>
        <li><a href="profile.php" class="nav-link login-btn">Profile</a></li>
        <li>
          <a href="php/logout.php" class="nav-link signup-btn">Log Out</a>
        </li>
      </ul>
    </div>
    <div class="c-div">
      <p class="c-text">Select a category and start learn GK!</p>
    </div>
    <!-- Category Section -->
    <section class="category-section">
      <div class="c-div2">
        <p class="c-text2">Category:</p>
      </div>
      <div class="category-grid">
        <div class="category-card" onclick="window.location.href='quiz.php?category=Coding'">
          <div class="category-content coding-bg">
            <img src="images/coding.png" alt="Coding">
            <p>Coding</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=Science'">
          <div class="category-content science-bg">
            <img src="images/science.png" alt="Science">
            <p>Science</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=Technology'">
          <div class="category-content technology-bg">
            <img src="images/technology.png" alt="Technology">
            <p>Technology</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=History'">
          <div class="category-content history-bg">
            <img src="images/history.png" alt="History">
            <p>History</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=Art'">
          <div class="category-content art-bg">
            <img src="images/art.png" alt="Art">
            <p>Art</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=Music'">
          <div class="category-content music-bg">
            <img src="images/music.png" alt="Music">
            <p>Music</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=Sports'">
          <div class="category-content sports-bg">
            <img src="images/sports.png" alt="Sports">
            <p>Sports</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=Travel'">
          <div class="category-content travel-bg">
            <img src="images/travel.png" alt="Travel">
            <p>Travel</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=Food'">
          <div class="category-content food-bg">
            <img src="images/food.png" alt="Food">
            <p>Food</p>
          </div>
        </div>
        <div class="category-card" onclick="window.location.href='quiz.php?category=Literature'">
          <div class="category-content literature-bg">
            <img src="images/literature.png" alt="Literature">
            <p>Literature</p>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer id="footer">
    <h2>GK Vander &copy; all rights reserved</h2>
  </footer>
</body>

</html>