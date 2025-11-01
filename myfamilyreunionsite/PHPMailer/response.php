<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Account Sign Up</title>
    <link rel="stylesheet" href="form.css">
    <style>
        .error {
            color: red;
        }

        .result {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            display: none;
        }
    </style>
</head>

<body>
    <header>
        <h1>Account Sign Up</h1>
    </header>

    <main>
        <?php
        $errors = [];
        $result = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input data
            $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
            $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
            $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
            $heard = isset($_POST['heard']) ? htmlspecialchars(trim($_POST['heard'])) : '';
            $comments = isset($_POST['comments']) ? htmlspecialchars(trim($_POST['comments'])) : '';

            if (empty($name)) {
                $errors['name'] = 'Name is required.';
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required.';
            }

            if (empty($phone) || !preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
                $errors['phone'] = 'Valid phone number is required (e.g., 123-456-7890).';
            }

            if (empty($comments)) {
                $errors['comments'] = 'Comments are required.';
            }

            if (empty($errors)) {
                $result = [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'heard' => $heard,
                    'comments' => nl2br($comments)
                ];
            }
        }
        ?>

        <form id="signupForm" method="post" action="">

            <fieldset>
                <legend>Account Information</legend>

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="textbox" maxlength="25" required>
                <span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                <br>

                <label for="email">E-Mail:</label>
                <input type="email" name="email" id="email" class="textbox" maxlength="25" required>
                <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                <br>

                <label for="phone">Phone Number:</label>
                <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="012-345-6789" name="phone" id="phone" class="textbox" required>
                <span class="error"><?php echo isset($errors['phone']) ? $errors['phone'] : ''; ?></span>
                <br>
            </fieldset>

            <fieldset>
                <legend>Other</legend>

                <p>How did you hear about us?</p>
                <label for="search">Search engine</label>
                <input type="radio" name="heard" id="search" value="Search Engine" required>
                <br>

                <label for="friend">Word of mouth</label>
                <input type="radio" name="heard" value="Friend" id="friend" required>
                <br>

                <label for="other">Other</label>
                <input type="radio" name="heard" value="Other" id="other" required>
                <br>

                <p><label for="comments">Comments:</label></p>
                <textarea name="comments" id="comments" rows="4" cols="50" required></textarea>
                <span class="error"><?php echo isset($errors['comments']) ? $errors['comments'] : ''; ?></span>
                <br>
            </fieldset>

            <input type="submit" value="Submit">
            <br>

            <input type="reset" id="resetButton" value="Reset">
            <br>

        </form>

        <?php if (!empty($result)): ?>
            <div id="result" class="result" style="display: block;">
                <h2>You have submitted the below information</h2>
                <p><strong>Name:</strong> <?php echo $result['name']; ?></p>
                <p><strong>E-Mail:</strong> <?php echo $result['email']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $result['phone']; ?></p>
                <p><strong>How you heard about us:</strong> <?php echo $result['heard']; ?></p>
                <p><strong>Comments:</strong> <?php echo $result['comments']; ?></p>
            </div>
        <?php else: ?>
            <div id="result" class="result" style="display: none;">
                <h2>You have submitted the below information</h2>
                <p><strong>Name:</strong> <span id="resultName"></span></p>
                <p><strong>E-Mail:</strong> <span id="resultEmail"></span></p>
                <p><strong>Phone Number:</strong> <span id="resultPhone"></span></p>
                <p><strong>How you heard about us:</strong> <span id="resultHeard"></span></p>
                <p><strong>Comments:</strong> <span id="resultComments"></span></p>
            </div>
        <?php endif; ?>
    </main>

    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
            // Hide the result panel
            document.getElementById('result').style.display = 'none';
        });
    </script>
</body>

</html>