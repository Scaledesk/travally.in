<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Reset Password</h2>

<div>
    Please follow the link below to reset your password.
    <?php
    echo 'http://localhost:3000/#/resetForgotPassword?code='.$forgot_password_code;
    ?>
    .<br/>
</div>
</body>
</html>
