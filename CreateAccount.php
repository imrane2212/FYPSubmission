<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "db_k2111451"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $plainPassword = $conn->real_escape_string($_POST['password']); 

    $termsAgreed = isset($_POST['terms']) ? 1 : 0; 

 
    $sql = "INSERT INTO users (email, password, terms_agreed) VALUES ('$email', '$plainPassword', '$termsAgreed')";

    if ($conn->query($sql) === TRUE) {
        $message = "Account created successfully. Please log in.";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="account-creation-form">
        <h1>Create Account</h1>
        <p>Create an account to manage and receive medication reminders.</p>
        
        <?php if (!empty($message)): ?>
            <p class="success"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="CreateAccount.php" method="post">
            <label for="email">Enter your email address:</label>
            <input type="email" id="email" name="email" placeholder="example@example.com" required>
            
            <label for="password">Create a strong password:</label>
            <input type="password" id="password" name="password" required>
            
            <div class="terms">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">By creating an account, you agree to our Terms and Conditions and Privacy Policy.</label>
            </div>
            
            <button type="submit">Sign Up</button>
        </form>

        <div class="alternative-sign-up">
            <p>or</p>
            <button>Google</button>
            <button>Facebook</button>
            <button>Sign Up with Twitter</button>
        </div>

        <div class="existing-account">
            <p>Already have an account? <a href="Login.php">Sign in now</a></p>
        </div>
    </div>
</body>
</html>
