<?php 
include_once("connection.php");
include_once("function.php");
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$result = $conn->query("SELECT name, profile_picture FROM Users WHERE user_id = $user_id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            color: #2c3e50;
        }

        header {
            background: linear-gradient(90deg, #2c3e50, #34495e);
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        header img {
            border-radius: 50%;
            width: 90px;
            height: 90px;
            object-fit: cover;
            border: 3px solid #ecf0f1;
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        header img:hover {
            transform: scale(1.1);
        }

        nav {
            background-color: #2c3e50;
            padding: 12px 0;
            display: flex;
            justify-content: center;
            gap: 25px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        nav a:hover {
            background-color: #1abc9c;
            transform: scale(1.05);
        }

        .container {
            padding: 40px;
            max-width: 900px;
            margin: 40px auto;
            background-color: #fff;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h1, h3 {
            margin-bottom: 15px;
        }

        .footer {
            margin-top: 60px;
            padding: 20px;
            background-color: #ecf0f1;
            font-size: 14px;
            color: #7f8c8d;
            text-align: center;
        }

        /* Example hover button if needed */
        .hover-button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .hover-button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

    </style>
</head>
<body>

<header>
    <img src='uploads/<?php echo htmlspecialchars($user['profile_picture']); ?>' alt="Profile Picture">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
</header>

<nav>
    <a href="library.php">Library</a>
    <?php if (isAdmin()): ?>
        <a href="manage_users.php">Manage Users</a>
    <?php endif; ?>
    <a href="changepassword.php">Change Password</a>
    <a href="update-profile.php">Update Profile</a>
    <a href="logout.php">Logout</a>
    <a href="manage_user.php">Manage_user</a>
</nav>

<div class="container">
    <h1>Customer Feedback Management System</h1>
    <h3>Welcome Panel</h3>
    <button class="hover-button">Explore Features</button>
</div>

<div class="footer">
    &copy; <?php echo date("Y"); ?> Customer Feedback Management System. All rights reserved.
</div>

</body>
</html>
