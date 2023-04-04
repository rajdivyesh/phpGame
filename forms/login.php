<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    
<style>
    /* Global styles */
body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
}

h1 {
  font-size: 32px;
  text-align: center;
  margin-top: 40px;
}

form {
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
}

label {
  display: inline-block;
  width: 120px;
  margin-right: 10px;
  margin-bottom: 10px;
}

input[type="text"],
input[type="password"] {
  display: inline-block;
  width: 300px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 10px;
}

input[type="submit"] {
  display: inline-block;
  padding: 10px 20px;
  background-color: #428bca;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
}

input[type="submit"]:hover {
  background-color: #3071a9;
}

.error {
  color: #ff0000;
  text-align: center;
  margin-bottom: 20px;
}
</style>
</head>
<body>
    <h1>Login</h1>
    <?php
            // Start the session and connect to the database
            session_start();
            $hostname = 'localhost';
            $database = 'kidsgames';
            $username = 'root';
            $password = 'root';
            $pdo = new PDO("mysql:dbname=$database;host=$hostname", $username, $password);

            // If the login form is submitted, attempt to authenticate the user
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["username"];
                $password = $_POST["password"];

                // Get the password hash from the authenticator table for the given username
                $sql = "SELECT passCode, registrationOrder FROM authenticator WHERE registrationOrder = (SELECT registrationOrder FROM player WHERE userName = :username)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':username', $username);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verify the password
                if ($result && password_verify($password, $result['passCode'])) {
                    // Password is correct, store the user ID in the session and redirect to the dashboard
                    $_SESSION['user_id'] = $result['registrationOrder'];
                    echo "success!";
                    header('Location: ../index.php');
                    exit();
                } else {
                    // Password is incorrect, display an error message
                    echo '<div style="color: red;">Incorrect username or password</div>';
                }
            }
        ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" name="connect" value="Connect">
        <input type="submit" name="signup" value="Sign-Up" formaction="registration.php">
    </form
