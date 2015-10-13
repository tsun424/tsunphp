<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
</head>
<body>
<form action="<?php echo ROOT_FILE;?>/login/login" method="post">

    <label for="username">User Name:</label>
    <input type="text" id="username" name="username" placeholder="User Name">
    <label for="userpwd">User Password:</label>
    <input type="password" id="userpwd" name="userpwd" placeholder="User Password">
    <input type="submit" name="doSubmit" value="Login">
</form>

</body>
</html>