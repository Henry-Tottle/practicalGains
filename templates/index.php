<!DOCTYPE html>
<html>
<head>
    <?PHP include(__DIR__.'/partials/head.html'); ?>
</head>
<body>
<h1 class="text-center bg-light-subtle w-50 mx-auto my-0">Practical Gains</h1>
<h2 class="text-center bg-light-subtle w-50 mx-auto my-0">A small scale fitness tracker, to track your gains</h2>

<?php include(__DIR__.'/partials/navBar.html'); ?>
<div class="border border-4 border-primary-subtle rounded-4 w-50 mx-auto text-center p-5 bg-light-subtle">

<?php if (!empty($message)): ?>
    <p class="notification"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>
<form method="post" action="/login">
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control w-50 mx-auto" id="email" name="email">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control w-50 mx-auto" id="password" name="password">
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>
<a href="http://localhost:8080/register">Register new user</a>
</div>
</body>
</html>
