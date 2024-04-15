<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if (empty($fullname)) {
        $errors[] = "Full Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($message)) {
        $errors[] = "Message is required";
    }

    if (empty($errors)) {
        try {
            $servername = "localhost:3308";
            $dbname = "accounts";
            $username = "root";
            $password = "";

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO contact (fullname, email, message) VALUES (:fullname, :email, :message)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            echo "New record created successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
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
    <title>Cricket world</title>
</head>

<body>
    <?php include "templates/header.php" ?>
    <div class="container">
        <div class="description">
            <h2 class="heading-secondary">Contact us</h2>
            <p>Cricket world <br>
141 Wilson Avenue <br>
Toronto, Ontario, Canada <br>
M5M 3A3 <br>

416.487.4581 <br>
info@Cricket World.com</p>
        </div>
        <div class="contact-container">
            <h2 class="contact-heading">Contact Us</h2>
            <form class="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label class="contact-label" for="fullname">Full Name:</label><br>
                <input class="contact-input" type="text" id="fullname" name="fullname"><br><br>

                <label class="contact-label" for="email">Email:</label><br>
                <input class="contact-input" type="email" id="email" name="email"><br><br>

                <label class="contact-label" for="message">Message:</label><br>
                <textarea class="contact-input" id="message" name="message"></textarea><br><br>

                <input class="contact-input" type="submit" value="Submit">
            </form>
        </div>
    </div>
    <?php include "templates/footer.php" ?>
</body>

</html>
