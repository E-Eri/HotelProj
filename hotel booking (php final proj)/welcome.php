<?php
session_start();

// Check if user is logged in

// Retrieve the username from the session
$username = $_SESSION["username"];

// Connect to the database
$conn = new mysqli("localhost", "root", "", "dbs");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from the database
$sql = "SELECT * FROM regisform WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user record
$user = $result->fetch_assoc();

// Handle password reset
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $currentPassword = $_POST["current_password"];
  $newPassword = $_POST["new_password"];
  $confirmPassword = $_POST["confirm_password"];

  // Check if current password matches the old password
  if ($currentPassword !== $user["password"]) {
    $error_message = "Current password is not the same as the old password.";
  } else {
    // Check if new password and confirm password match
    if ($newPassword !== $confirmPassword) {
      $error_message = "New password and Re-enter new password should be the same.";
    } else {
      // Update the password in the database
      $updateSql = "UPDATE regisform SET password = ? WHERE username = ?";
      $updateStmt = $conn->prepare($updateSql);
      $updateStmt->bind_param("ss", $newPassword, $username);
      $updateStmt->execute();

      // Redirect to the record retrieval page
      header("Location: TSA3-B1.php");
      exit;
    }
  }
}

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Record</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    .container {
      width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #45a049;
    }
    label {
      display: block;
      margin-top: 10px;
    }
    input[type="text"],
    input[type="password"] {
      width: 95%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    .error-message {
      color: red;
      margin-top: 10px;
    }
    .logout-link {
      text-align: center;
      margin-top: 20px;
    }
    .logout-link a {
      color: #4caf50;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>User Record</h1>
    <p>Welcome, <?php echo $username; ?>!</p>

    <h2>User Information:</h2>
    <p>
      First Name: <?php echo $user["firstName"]; ?><br>
      Middle Name: <?php echo $user["middleName"]; ?><br>
      Last Name: <?php echo $user["lastName"]; ?><br>
      Birthday: <?php echo $user["birthday"]; ?><br>
      Email: <?php echo $user["email"]; ?><br>
      Contact Number: <?php echo $user["contact_number"]; ?><br>
    </p>

    <h2>Reset Password:</h2>
    <?php if (isset($error_message)) { ?>
      <p class="error-message"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <label for="current_password">Enter Current Password:</label>
      <input type="password" name="current_password" required>

      <label for="new_password">Enter New Password:</label>
      <input type="password" name="new_password" required>

      <label for="confirm_password">Re-enter New Password:</label>
      <input type="password" name="confirm_password" required>

      <input type="submit" value="Reset Password">
    </form>

    <div class="logout-link">
      <a href="logout.php">Logout</a>
    </div>
  </div>
</body>
</html>
