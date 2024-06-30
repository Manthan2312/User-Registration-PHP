<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = htmlspecialchars($_POST['pass']);

  
  $servername = "localhost";
  $username = "root";
  $dbpassword = "";
  $database = "manthan";

  
  $conn = new mysqli($servername, $username, $dbpassword, $database);

 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  
  $stmt = $conn->prepare("SELECT Password FROM user WHERE Email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($dbPassword);
  $stmt->fetch();

  if ($stmt->num_rows > 0 && $password == $dbPassword) {
    $_SESSION['email'] = $email;
    header("Location: home.php");
    exit;
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Invalid email or password.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }

  
  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
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
    .btn-secondary {
      background-color: #6c757d;
      border: none;
      transition: background-color 0.3s;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
    }
    .alert {
      margin-top: 20px;
    }
    .container {
      background-image: linear-gradient(135deg, #ffffff 0%, #e9ecef 100%);
    }
    .btn-primary {
      background-color: #17a2b8;
    }
    .btn-primary:hover {
      background-color: #138496;
    }
    .btn-secondary {
      background-color: #ffc107;
    }
    .btn-secondary:hover {
      background-color: #e0a800;
    }
    .form-control {
      background-color: #f8f9fa;
    }
    .form-control:focus {
      background-color: #ffffff;
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    .alert-success {
      background-color: #d4edda;
      border-color: #c3e6cb;
      color: #155724;
    }
    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
    }
  </style>
  <script>
    function redirectToSignup() {
      window.location.href = 'index34.php';
    }
  </script>
</head>
<body>
  <div class="container mt-3">
    <h1>Please log in</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" class="form-control" id="pass" name="pass" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <button type="button" class="btn btn-secondary" onclick="redirectToSignup()">Signup</button>
    </form>
  </div>
</body>
</html>
