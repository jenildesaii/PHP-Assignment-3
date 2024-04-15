<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include "templates/header.php" ?>
<div class="welcome-container">
    <div class="welcome-heading">
      Welcome, <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>!
    </div>
    <div class="welcome-info">
      Your email: <?php echo $_SESSION['email']; ?>
    </div>
  </div>
  <div class="container">
    <div class="description">
      <h2 class="heading-secondary">
        Services that we provide
      </h2>
      <p>
        At the forefront of innovation, we offer a suite of services designed to propel your business into the future. Our team of experts specializes in delivering cutting-edge solutions that blend creativity with functionality. Whether it's developing a dynamic web presence or crafting bespoke software, we empower your brand to excel in a digital-first world.
      </p>
    </div>
    <div class="cards">
      <div class="card">
        <div class="icon">
          <img src="img/img-1.png" alt="Image 1">
        </div>
        <h3 class="heading-tertiary">Marketing</h3>
        <p>
          Excellence Elevate your brand with our comprehensive marketing strategies that ensure maximum visibility and engagement
        </p>
      </div>
      <div class="card">
        <div class="icon">
          <img src="img/img-2.png" alt="Image 2">
        </div>
        <h3 class="heading-tertiary">App Development</h3>
        <p>
          Transform your ideas into reality with our cutting-edge app development services tailored to meet your business needs
        </p>
      </div>
      <div class="card">
        <div class="icon">
          <img src="img/img-3.png" alt="Image 3">
        </div>
        <h3 class="heading-tertiary">Error Fixing</h3>
        <p>
          Our dedicated team provides swift and effective solutions to enhance your system’s performance and reliability.
        </p>
      </div>
      <div class="card">
        <div class="icon">
          <img src="img/img-4.png" alt="Image 4">
        </div>
        <h3 class="heading-tertiary">Design</h3>
        <p>
          Professionally design your website
        </p>
      </div>
      <div class="card">
        <div class="icon">
          <img src="img/img-5.png" alt="Image 5">
        </div>
        <h3 class="heading-tertiary">Development</h3>
        <p>
          Drive business growth with our state-of-the-art development techniques that guarantee scalability and innovation.
        </p>
      </div>
      <div class="card">
        <div class="icon">
          <img src="img/img-6.png" alt="Image 6">
        </div>
        <h3 class="heading-tertiary">SEO</h3>
        <p>
          Optimization Boost your online presence with our expert SEO services designed to increase traffic and improve search engine rankings.
        </p>
      </div>
    </div>
  </div>
<?php include "templates/footer.php" ?>
  
</body>
</html>
