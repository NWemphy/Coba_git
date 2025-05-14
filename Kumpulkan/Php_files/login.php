<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = $conn->prepare("SELECT * FROM User WHERE username=? AND password=?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc();

        $_SESSION['user'] = $userData['username'];
        $_SESSION['user_id'] = $userData['id'];

        header("Location: kegiatan.php");
        exit;
    } else {
        $error = "Login gagal!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 8px;
            padding: 30px 40px;
            width: 380px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #aaa;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Sign In</h2>
        <?php if (!empty($error)) echo "<div class='error-message'>$error</div>"; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="submit-btn">Login</button>
        </form>
    </div>
</body>

</html>
