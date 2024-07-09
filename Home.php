<?php
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manthan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action']) && $_POST['action'] == 'delete_account') {
    $email = $_SESSION['email'];
    $sql = "DELETE FROM user WHERE email='$email'; DELETE FROM users WHERE email='$email'";
    if ($conn->multi_query($sql) === TRUE) {
      session_destroy();
      header("Location: goodby.php");
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 50px;
      max-width: 600px;
      background-color: #fff;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    h1 {
      margin-bottom: 30px;
      font-size: 24px;
      text-align: center;
      color: #343a40;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      transition: background-color 0.3s;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .btn-danger {
      background-color: #dc3545;
      border: none;
      transition: background-color 0.3s;
    }
    .btn-danger:hover {
      background-color: #c82333;
    }
    .navbar {
      background-color: #007bff;
      overflow: hidden;
      padding: 10px 20px;
    }
    .navbar a {
      float: left;
      color: #fff;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
      font-size: 17px;
      cursor: pointer;
    }
    .navbar a:hover {
      background-color: #0056b3;
      color: white;
    }
    form {
      margin-bottom: 20px;
      padding: 15px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }
    h2 {
      color: #333;
    }
  </style>
</head>
<body>
  <div class="container mt-3">
    <h1>Welcome to the Home Page</h1>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['email']); ?>! You have successfully logged in.</p>
    
    <form action="logout.php" method="post">
      <button type="submit" class="btn btn-primary">Logout</button>
    </form>
  </div>

  <div class="navbar">
    <a onclick="showSection('home-section')">Home</a>
    <form action="logout.php" method="post" style="margin-left: auto;">
      <button type="submit" class="btn btn-primary">Logout</button>
    </form>
    <form action="" method="post" style="margin-left: 10px;">
      <input type="hidden" name="action" value="delete_account">
      <button type="submit" class="btn btn-danger">Delete Account</button>
    </form>
  </div>

  <div class="container" id="home-section">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h2>
    <p>Select an action from the navbar to get started.</p>
  </div>

  <script>
    function showSection(sectionId) {
      const sections = document.querySelectorAll('.container');
      sections.forEach(section => {
        section.style.display = 'none';
      });
      document.getElementById(sectionId).style.display = 'block';
    }

    window.onload = function() {
      showSection('home-section');
    }
  </script>
</body>
</html>
