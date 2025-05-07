<?php
session_start();
include_once("connection.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_pass = password_hash(trim($_POST['new_password']), PASSWORD_DEFAULT);
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("UPDATE Users SET password = ? WHERE user_id = ?");
    $stmt->bind_param("si", $new_pass, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Password changed successfully.');</script>";
    } else {
        echo "<p style='color:red;'>Failed to update password.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
            animation: slideIn 0.8s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(40px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h2 {
            margin-bottom: 25px;
            color: #2c3e50;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        input[type="password"]:focus {
            border-color: #2980b9;
            box-shadow: 0 0 6px #3498db;
            outline: none;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #2c3e50;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Change Password</h2>
    <form method="POST">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" required>
        <button type="submit">Update Password</button>
    </form>
    <a class="back-link" href="dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
