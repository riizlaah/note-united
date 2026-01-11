<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note United</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="index.php" method="post">
        <h1>Login</h1>
        <span>Silahkan login terlebih dahulu</span>
        <label>
            Email
            <input type="text" placeholder="someone@example.org">
        </label>
        <label>
            Password
            <input type="password" placeholder="********">
        </label>
        <a href="/forgot-password.php" class="right">Forgot Password?</a>
        <button type="submit">Login</button>
        <span>Don't have an account? <a href="/register.php">Register Now</a></span>
    </form>
</body>
</html>