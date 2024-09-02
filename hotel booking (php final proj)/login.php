<html>
<head>
    <title>Login Form</title>
    <link rel = "icon" href = "https://scontent.fmnl3-1.fna.fbcdn.net/v/t1.15752-9/358660467_239602338882908_6660556498456884805_n.png?_nc_cat=110&cb=99be929b-59f725be&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeFfpACZ8IXZzekA6d6TxR3dUuI9j384mwNS4j2PfzibA3b9j89lHZkNmBT_q1z1U7lOkx5SJpIlWY-zmSDt-9wX&_nc_ohc=GL06r8BcMecAX867DPS&_nc_ht=scontent.fmnl3-1.fna&oh=03_AdQE0WitgvIE8VC5vyGVCIAKI-s_BJVa6YPpYfuv0wmk7A&oe=64CF98CD" type = "image/x-icon">
    <style>
        body {
            font-family: arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
            height: 100hv;
            background: rgb(148, 187, 233);
            background: linear-gradient(90deg, rgba(148, 187, 233, 0.25) 0%, rgba(238, 174, 202, 0.25) 100%);
        }

        .logo {
            position: absolute;
            top: 8px;
            left: 40px;
            transform: none;
            width: 120px;
            cursor: pointer;
            padding: 10px;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.15);
            width: 450px;
            max-width: 800px;
            padding: 25px 40px 10px 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            text-align: center;
        }

        p {
            font-size: 12px;
            color: #2E2E2E;
            text-align: center;
        }
        
        .login-form {
            padding: 20px;
            border-radius: 5px; 
            text-align: center;
            background: -webkit-linear-gradient(right, #034b8e, #d25290, #034b8e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        } 

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 25px;
            border: none;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 3px;
        }
        
        .login-form button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #AA336A;
            color: black;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .login-form button:hover {
            background-color: #45a049;
        }

        button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        background-color: #8282821a;
        color: solid pink;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        }

        button[type="submit"]:hover {
        background-color: rgba(206, 206, 206, 0.8); 
        }

    </style>
</head>
  
<body>
<img src="https://scontent.fmnl3-3.fna.fbcdn.net/v/t1.15752-9/358334517_1067185700932164_2734816006084881205_n.png?_nc_cat=103&cb=99be929b-59f725be&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeGStOzq6fPN9ybT6ylb_e-IIehLVcgk1N0h6EtVyCTU3U_xBAwgSqHclJXpt4KPHdCf3S5M9ptXiff_o0M-HlML&_nc_ohc=MDwbsvxzpPkAX-MUg7u&_nc_ht=scontent.fmnl3-3.fna&oh=03_AdSiTthu07cYONrsZZHCoC7dv1wn5e56aYJx7d4vpvOY8Q&oe=64CF63F5" class="logo">
    <div class="login-container">
        <div class="login-form">
            <h2>LOG IN</h2>
            <p>Welcome back to Dreamland!</p>

            <?php
            if (isset($error_message)) {
                echo "<p>" . $error_message . "</p>";
            }
            ?>

            <form method="POST" action="login.php">
                <!-- Username and password fields -->
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit">Log in</button>
            </form>
            <p>Don't have an account? <a href="TSA3-B1.php">Register here</a>.</p>
        </div>
    </div>
</body>
</html>

<?php
session_start();


// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "dbs");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM regisform WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login is successful
        $_SESSION['username'] = $username;
        
        header("Location: prompt.php");
        exit;
    } else {
        // Invalid username or password
        $error_message = "Invalid username or password. Please try again.";
    }

    $conn->close();
}
?>