<?php 
if (isset($_SESSION['firstname'])) {
  $logout_link = '<a href="logout.php">Logout</a>';
} else {
  $logout_link = '';
}
?>

<header>
  <div class="main-nav">
    <a href="index.html" class="logo">Cricket Box.</a>

    <ul>
      <li><?php echo $logout_link; ?></li>
      <li><a href="index.php">home</a></li>
      <li><a href="member.php">Members</a></li>
      <li><a href="registration.php">Register</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </div>
</header>
