<?php
session_start();
include("config/dbconfig.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
    $errors[] = "All fields are required.";
  }

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);
  if ($stmt->rowCount() > 0) {
    $errors[] = "Email already exists.";
  }

  if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $email, $hashed_password]);

    header("Location: index.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/styles.css">
  <style>
    .error {
      color: red;
    }
  </style>
  <title>Cricket world</title>
</head>

<body>
  <?php include "templates/header.php" ?>
  <div class="register_container">
    <h2>Registration Form</h2>
    <form method="post" action="registration.php">
      <?php foreach ($errors as $error) : ?>
        <p class="error"><?php echo $error; ?></p>
      <?php endforeach; ?>
      <label for="firstname">First Name:</label>
      <input type="text" id="firstname" name="firstname">

      <label for="lastname">Last Name:</label>
      <input type="text" id="lastname" name="lastname">

      <label for="email">Email:</label>
      <input type="email" id="email" name="email">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password">

      <input type="submit" name="register" value="Register">
    </form>
  </div>

  <div class="container">
    <div class="description">
      <h2 class="heading-secondary">
        Employment
      </h2>
      <p>
        The Cricket world is a family-oriented private Club that is dedicated to providing first-class athletic programs, facilities and services to our members. A key to our commitment to be the private athletic and social club of choice in Toronto is our team of employees who share our values of sportsmanship and camaraderie, heritage and respect, excellence and innovation, and wellness and fun.

It is the practice of the Club to employ those who are qualified for employment on the basis of job-related criteria such as experience, skills, education and fit. 
      </p>
    </div>

    <div class="work mb">
      <img src="img/1.jpeg" alt="1">
      <img src="img/2.jpeg" alt="2">
      <img src="img/3.jpeg" alt="3">
      <img src="img/5.jpeg" alt="5">
    </div>
  </div>

  <?php include "templates/footer.php" ?>
</body>

</html>
