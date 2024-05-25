<?php
$serverName = "localhost";
$databaseName = "genarel_knowlage_website";
$userName = "root";
$password = "";

$con = mysqli_connect($serverName, $userName, $password, $databaseName);

if (isset($_GET['category'])) {
     $category = $_GET['category'];

     $query = "SELECT id, question_text, option1, option2, option3, option4, correct_option FROM questions WHERE category_id = (SELECT id FROM categories WHERE name = ?)";
     $stmt = $con->prepare($query);
     $stmt->bind_param("s", $category);
     $stmt->execute();
     $result = $stmt->get_result();
     $questions = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
     <title>Quiz</title>
     <link rel="stylesheet" type="text/css" href="style/quiz.css">
</head>

<body>
     <div id="nav">
          <button id="exit-btn" onclick="showExitDialog()">Exit</button>
          <h2 id="quiz-title"><?php echo htmlspecialchars($category); ?> Quiz</h2>
     </div>

     <div id="quiz-container">
          <div id="timer">
               <div class="progress-bar">
                    <div class="progress" id="progress"></div>
               </div>
          </div>
          <p class="question" id="question"></p>
          <div class="options">
               <button id="option1" onclick="selectAnswer(1)"></button>
               <button id="option2" onclick="selectAnswer(2)"></button>
               <button id="option3" onclick="selectAnswer(3)"></button>
               <button id="option4" onclick="selectAnswer(4)"></button>
          </div>
          <button class="submit-btn" onclick="submitAnswer()">Submit</button>
     </div>

     <div id="results-container" style="display: none;">
          <div class="card">
               <div class="card-header">Finished Quiz!</div>
               <div class="card-body">
                    <p>Correct Answers: <span id="correct-answers"></span></p>
                    <p>Wrong Answers: <span id="incorrect-answers"></span></p>
               </div>
               <div class="card-footer">
                    <button class="home-btn" onclick="goHome()">Home</button>
                    <button class="try-again-btn" onclick="restartQuiz()">Try Again</button>
               </div>
          </div>
          <canvas id="canvas"></canvas>
     </div>

     <!-- Custom Alert Dialog -->
     <div id="exit-dialog" class="dialog">
          <div class="dialog-content">
               <p>Are you sure you want to exit the quiz?</p>
               <button onclick="confirmExit()">Yes</button>
               <button onclick="closeExitDialog()">No</button>
          </div>
     </div>

     <script>
          let timer;
          let currentIndex = 0;
          const timePerQuestion = 30; // seconds
          let timeLeft = timePerQuestion;
          let correctAnswers = 0;
          let wrongAnswers = 0;
          let selectedAnswer = null;

          function startQuiz() {
               document.getElementById('question').innerHTML = questions[currentIndex].question_text;
               document.getElementById('option1').innerHTML = questions[currentIndex].option1;
               document.getElementById('option2').innerHTML = questions[currentIndex].option2;
               document.getElementById('option3').innerHTML = questions[currentIndex].option3;
               document.getElementById('option4').innerHTML = questions[currentIndex].option4;
               startTimer();
          }

          function startTimer() {
               timeLeft = timePerQuestion;
               document.getElementById('progress').style.width = '100%';

               timer = setInterval(function () {
                    timeLeft--;
                    document.getElementById('progress').style.width = (timeLeft / timePerQuestion) * 100 + '%';

                    if (timeLeft <= 0) {
                         clearInterval(timer);
                         submitAnswer();
                    }
               }, 1000);
          }

          function selectAnswer(answer) {
               selectedAnswer = answer;
               // Highlight the selected option
               document.getElementById(`option${answer}`).style.backgroundColor = '#59CD3F';
               // Remove highlight from other options
               for (let i = 1; i <= 4; i++) {
                    if (i !== answer) {
                         document.getElementById(`option${i}`).style.backgroundColor = '#76c7c0';
                    }
               }
          }

          function submitAnswer() {
               clearInterval(timer);
               if (selectedAnswer == questions[currentIndex].correct_option) { // Use loose comparison (==) here
                    correctAnswers++;
               } else {
                    wrongAnswers++;
               }

               // Reset option background colors
               for (let i = 1; i <= 4; i++) {
                    document.getElementById(`option${i}`).style.backgroundColor = '#76c7c0';
               }

               selectedAnswer = null;
               currentIndex++;

               if (currentIndex < questions.length) {
                    startQuiz();
               } else {
                    showResults();
               }
          }

          function showResults() {
               document.getElementById('quiz-container').style.display = 'none';
               document.getElementById('results-container').style.display = 'block';
               document.getElementById('correct-answers').textContent = correctAnswers; // Update correct answers count
               document.getElementById('incorrect-answers').textContent = wrongAnswers; // Update incorrect answers count
          }

          function goHome() {
               window.location.href = 'home.php';
          }

          function showExitDialog() {
               document.getElementById('exit-dialog').style.display = 'flex';
          }

          function closeExitDialog() {
               document.getElementById('exit-dialog').style.display = 'none';
          }

          function confirmExit() {
               window.location.href = 'home.php';
          }

          document.addEventListener("DOMContentLoaded", function () {
               window.questions = <?php echo json_encode($questions); ?>;
               startQuiz();
          });

          function restartQuiz() {
               // Reset quiz state
               currentIndex = 0;
               correctAnswers = 0;
               wrongAnswers = 0;
               selectedAnswer = null;

               // Hide results container and show quiz container
               document.getElementById('results-container').style.display = 'none';
               document.getElementById('quiz-container').style.display = 'block';

               // Restart quiz
               startQuiz();
          }

          let W = window.innerWidth;
          let H = window.innerHeight;
          const canvas = document.getElementById("canvas");
          const context = canvas.getContext("2d");
          const maxConfettis = 150;
          const particles = [];

          const possibleColors = [
               "DodgerBlue",
               "OliveDrab",
               "Gold",
               "Pink",
               "SlateBlue",
               "LightBlue",
               "Gold",
               "Violet",
               "PaleGreen",
               "SteelBlue",
               "SandyBrown",
               "Chocolate",
               "Crimson"
          ];

          function randomFromTo(from, to) {
               return Math.floor(Math.random() * (to - from + 1) + from);
          }

          function confettiParticle() {
               this.x = Math.random() * W; // x
               this.y = Math.random() * H - H; // y
               this.r = randomFromTo(11, 33); // radius
               this.d = Math.random() * maxConfettis + 11;
               this.color =
                    possibleColors[Math.floor(Math.random() * possibleColors.length)];
               this.tilt = Math.floor(Math.random() * 33) - 11;
               this.tiltAngleIncremental = Math.random() * 0.07 + 0.05;
               this.tiltAngle = 0;

               this.draw = function () {
                    context.beginPath();
                    context.lineWidth = this.r / 2;
                    context.strokeStyle = this.color;
                    context.moveTo(this.x + this.tilt + this.r / 3, this.y);
                    context.lineTo(this.x + this.tilt, this.y + this.tilt + this.r / 5);
                    return context.stroke();
               };
          }

          function Draw() {
               const results = [];

               // Magical recursive functional love
               requestAnimationFrame(Draw);

               context.clearRect(0, 0, W, window.innerHeight);

               for (var i = 0; i < maxConfettis; i++) {
                    results.push(particles[i].draw());
               }

               let particle = {};
               let remainingFlakes = 0;
               for (var i = 0; i < maxConfettis; i++) {
                    particle = particles[i];

                    particle.tiltAngle += particle.tiltAngleIncremental;
                    particle.y += (Math.cos(particle.d) + 3 + particle.r / 2) / 2;
                    particle.tilt = Math.sin(particle.tiltAngle - i / 3) * 15;

                    if (particle.y <= H) remainingFlakes++;

                    // If a confetti has fluttered out of view,
                    // bring it back to above the viewport and let if re-fall.
                    if (particle.x > W + 30 || particle.x < -30 || particle.y > H) {
                         particle.x = Math.random() * W;
                         particle.y = -30;
                         particle.tilt = Math.floor(Math.random() * 10) - 20;
                    }
               }

               return results;
          }

          window.addEventListener(
               "resize",
               function () {
                    W = window.innerWidth;
                    H = window.innerHeight;
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
               },
               false
          );

          // Push new confetti objects to `particles[]`
          for (var i = 0; i < maxConfettis; i++) {
               particles.push(new confettiParticle());
          }

          // Initialize
          canvas.width = W;
          canvas.height = H;
          Draw();
     </script>
</body>

</html>