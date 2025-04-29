<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Slim 4</title>
    <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
    <style>
        body {
            margin: 50px 0 0 0;
            padding: 0;
            width: 100%;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            text-align: center;
            color: #aaa;
            font-size: 18px;
        }

        h1 {
            color: #719e40;
            letter-spacing: -3px;
            font-family: 'Lato', sans-serif;
            font-size: 100px;
            font-weight: 200;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<h1>Practical Gains</h1>
<div>A small scale fitness tracker, to track your gains</div>
<?php if (!empty($message)): ?>
    <p class="notification"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>
<form method="post" action="/login">
    <label>
        Email: <input type="email" name="email">
    </label>
    <label>
        <input type="password" name="password">
    </label>
    <input type="submit" value="Log In">
</form>
<a href="http://localhost:8080/register">Register new user</a>
</body>
</html>
