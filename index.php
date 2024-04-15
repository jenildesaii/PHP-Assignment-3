<?php
session_start();
include("config/dbconfig.php");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $user['email'];

        header("Location: member.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}

if (isset($_SESSION['id'])) {
    $logout_link = '<a href="logout.php">Logout</a>';
} else {
    $logout_link = '<a href="registration.php">Register</a>';
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
    <title>Cricket world</title>
</head>

<body>
    <?php include "templates/header.php" ?>
    <div class="container">
        <div class="hero">
            <div class="content">
                <h1 class="heading-primary">
                    Membership at the Cricket world Club offers a lot more than just athletics to keep you busy throughout the year. Kids enjoy Camp Cricket and our Kids' Club. We also have events and celebrations year-round for all ages.
                </h1>
                <p>
                    At home, members can take advantage of preferred pricing at popular attractions in and around Toronto. Membership at the Cricket World gives you more.
                </p>
            </div>
            <div class="login-container">
                <h2 class="login-heading">Login Form</h2>

                <?php if (!empty($error_message)) : ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label class="login-label" for="email">Email:</label>
                    <input class="login-input" type="email" id="email" name="email">

                    <label class="login-label" for="password">Password:</label>
                    <input class="login-input" type="password" id="password" name="password">

                    <input class="login-submit" type="submit" name="login" value="Login">
                    <p><?php echo $logout_link; ?></p>
                </form>
            </div>
        </div>
    </div>
    <?php include "templates/footer.php" ?>
</body>

</html>
