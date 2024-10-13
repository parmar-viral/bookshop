<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <?php
    session_start();
    include('menu.php');
    ?>

    <div class="container">
        <h2 class="text-center">Register</h2>
        <form action="register_process.php" method="POST" onsubmit="return validateForm()">
            <!-- First Name -->
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname" required pattern="[A-Za-z\s]+"
                    title="Please enter a valid first name.">
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname" required pattern="[A-Za-z\s]+"
                    title="Please enter a valid last name.">
            </div>

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
                <input type="password" class="form-control" id="password" name="password" required
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}"
                    title="Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.">
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <!-- Mobile -->
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required pattern="[0-9]{10}"
                    title="Please enter a valid 10-digit mobile number.">
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="text-center">
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary col-3">Register</button>
            </div>

        </form>
    </div>

    <!-- JavaScript Form Validation -->
    <script>
    function validateForm() {
        // Get form values
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;

        // Check if passwords match
        if (password !== confirm_password) {
            alert("Passwords do not match.");
            return false;
        }

        // All validations are done via HTML5 attributes (pattern, required, etc.)
        return true;
    }
    </script>

    <?php include('footer.php'); ?>
    <?php include 'js.php'; ?>
</body>

</html>