<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flight Management System</title>
  <style>
    body {
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
    }
    
    .login-container {
      background-color: #ffffff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
      width: 400px;
      text-align: center;
    }
    
    .login-box {
      margin-bottom: 20px;
    }
    
    .login-title {
      font-size: 24px;
      margin-bottom: 20px;
      color: #333333;
    }
    
    .error {
      color: #ff0000;
      margin: 10px 0;
    }
    
    .login-input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #dddddd;
      border-radius: 4px;
      font-size: 16px;
    }
    
    .login-button, .register-button {
      background-color: #007bff;
      color: #ffffff;
      border: none;
      border-radius: 4px;
      padding: 12px 0;
      width: 100%;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out;
    }
    
    .login-button:hover, .register-button:hover {
      background-color: #0056b3;
    }
    
    .register-button {
      background-color: #28a745;
      margin-top: 10px;
    }
    
    .register-button:hover {
      background-color: #218838;
    }
    
    .register-link {
      display: block;
      margin-top: 10px;
      color: #007bff;
      text-decoration: none;
      font-size: 14px;
    }
    
    .register-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <h1 class="login-title">Welcome to Flight Management</h1>
      <form action="login.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <input class="login-input" type="text" id="uname" name="uname" placeholder="Enter your username" required>


        <input class="login-input" type="password" id="password" name="password" placeholder="Enter your password" required>

        <button class="login-button" type="submit">Login</button>
      </form>
      <form action="register.html">
        <button class="register-button" type="submit">Register</button>
      </form>
    </div>
  </div>
</body>
</html>
