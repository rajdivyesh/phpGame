<?php

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate form data
    $errors = array();
    if (empty($current_password)) {
        $errors[] = "Current password is required";
    }
    if (empty($new_password)) {
        $errors[] = "New password is required";
    }
    if (empty($confirm_password)) {
        $errors[] = "Confirm password is required";
    }
    if ($new_password != $confirm_password) {
        $errors[] = "New password and confirm password must match";
    }

    // If there are no errors, update the password in the database
    if (empty($errors)) {
        // Here you would typically write code to update the password in your database
        // If the password was successfully updated, redirect the user to a confirmation page
        header("Location: passwordModified.php");
        exit;
    }
}

?>

<!-- HTML code for the password modification form -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
    <div class="password-modification"
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Modify Password</h2><hr />
            <label for="current_password">Current password:</label>
            <input type="password" name="current_password" id="current_password">

            <label for="new_password">New password:</label>
            <input type="password" name="new_password" id="new_password">

            <label for="confirm_password">Confirm password:</label>
            <input type="password" name="confirm_password" id="confirm_password">

            <button type="submit">Change password</button>
        </form>
    </div>
    </div>
    <?php
    // If there are errors, display them to the user
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }

    ?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>