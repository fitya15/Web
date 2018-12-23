<?php include('server.php');?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
<h2>Login</h2>
</div>

<form method="post" action="login.php">
    <!-- display error php -->
    <?php include('errors.php');?>
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username">
    </div>

    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
    </div>


    <div class="input-group">
        <button type="submit" name="login" class="btn">Login</button>
    </div>
    <p>
        Not a member? <a href="registration.php">Sign up</a>
    </p>

</form>

    
</body>
</html>