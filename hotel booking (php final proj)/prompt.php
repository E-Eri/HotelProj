<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        // User is not logged in, redirect to the login page
        header("Location: login.php");
        exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prompt</title>
    <link rel = "icon" href = "https://scontent.fmnl3-1.fna.fbcdn.net/v/t1.15752-9/358660467_239602338882908_6660556498456884805_n.png?_nc_cat=110&cb=99be929b-59f725be&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeFfpACZ8IXZzekA6d6TxR3dUuI9j384mwNS4j2PfzibA3b9j89lHZkNmBT_q1z1U7lOkx5SJpIlWY-zmSDt-9wX&_nc_ohc=GL06r8BcMecAX867DPS&_nc_ht=scontent.fmnl3-1.fna&oh=03_AdQE0WitgvIE8VC5vyGVCIAKI-s_BJVa6YPpYfuv0wmk7A&oe=64CF98CD" type = "image/x-icon">
    
    <style>
        body{
            font-family: arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
            height: 100hv;
            background: rgb(238,174,202);
            background: radial-gradient(circle, rgba(238,174,202,0.45) 13%, rgba(148,187,233,0.3) 99%);
        }

        .container{
            background: rgba(255, 255, 255, 0.05); 
            height: 200px;
            max-width: 800px;
            padding: 25px 40px 10px 40px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            cursor: pointer;
            padding: 10px;
        }


        h2{
            color: #333;
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        button{
            background: rgba(0, 0, 0, 0.09);
            border: none;
            width: 150px;
            height: 40px;
            border-radius: 25px;
            font-size: 13px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: 0.5s ease;
        }

        button:hover{
            background: rgba(0, 0, 0, 0.3);
        }
        
    </style>
    
</head>
<body>
<img src="https://scontent.fmnl3-3.fna.fbcdn.net/v/t1.15752-9/358334517_1067185700932164_2734816006084881205_n.png?_nc_cat=103&cb=99be929b-59f725be&ccb=1-7&_nc_sid=ae9488&_nc_eui2=AeGStOzq6fPN9ybT6ylb_e-IIehLVcgk1N0h6EtVyCTU3U_xBAwgSqHclJXpt4KPHdCf3S5M9ptXiff_o0M-HlML&_nc_ohc=MDwbsvxzpPkAX-MUg7u&_nc_ht=scontent.fmnl3-3.fna&oh=03_AdSiTthu07cYONrsZZHCoC7dv1wn5e56aYJx7d4vpvOY8Q&oe=64CF63F5" class="logo">
    <div class="container">
        <h2>Login Successful! </color:></h2>
        <button onclick="goBackHome()">Go back home</button>
        <button onclick="startBooking()">Start booking</button>

        <script>
            function goBackHome() {
                window.location.href = "welcomepage.php";
            }

            function startBooking() {
                window.location.href = "booking.php";
            }
        </script>
    </div>
</body>
</html>