<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <?php
    session_start();
    include('menu.php');
    ?>

    <div class="container">
        <h2 class="text-center">Login</h2>
        <form action="login_process.php" method="POST">
            <!-- Username -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required
                    pattern="[A-Za-z0-9_]{5,}"
                    title="Username must be at least 5 characters long and contain only letters, numbers, or underscores.">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="text-center">
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary col-3">Login</button>
            </div>

        </form>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger mt-3'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>
    </div>

    <?php include('footer.php'); ?>
    <?php include 'js.php'; ?>
</body>

</html>