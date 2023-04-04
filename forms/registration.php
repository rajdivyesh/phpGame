<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>

    
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
    <h1>Registration</h1>
    <?php
// Initialize variables
$first_name = "";
$last_name = "";
$username = "";
$password = "";
$confirm_password = "";
$errors = array();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
        $hostname = 'localhost';
        $database = 'kidsgames';
        $username = 'root';
        $password = 'root'; 
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    // Retrieve and validate form data
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($first_name)) {
        $errors[] = "First name is required";
    }
    if (empty($last_name)) {
        $errors[] = "Last name is required";
    }
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    if ($password != $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // If there are no errors, insert the player details into the database
    if (count($errors) == 0) {
        $sql = "INSERT INTO player (fName, lName, userName, registrationTime) VALUES (:first_name, :last_name, :username, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':first_name', $first_name);
        $stmt->bindValue(':last_name', $last_name);
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        // Get the registration order of the newly created player
        $registration_order = $pdo->lastInsertId();
        echo $registration_order;
        // Insert the password into the authenticator table
        $sql = "INSERT INTO authenticator (passCode, registrationOrder) VALUES (:password, :registration_order)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(':registration_order', $registration_order);
        $stmt->execute();

        // Redirect the user to the login page
        header("location: login.php");
        exit();
    }
}
?>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required><br>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required><br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required><br>
            <input type="submit" name="create" value="Create">
            <input type="submit" name="signin" value="Sign-In">
        </form>
</body>
                    
             
               
