<?php
$name = $email = $gender = $password = $confirm_password = "";
$nameErr = $emailErr = $genderErr = $passwordErr = $confirmErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {                      // ya hai form chek karne kai liye matlab data ko insert karna kai liya agar sahi hai to

    // Name check
    if (empty($_POST["name"])) {
        $nameErr = "Name likho";
    } else {
        $name = $_POST["name"];
    }

    // Email check
    if (empty($_POST["email"])) {
        $emailErr = "Email likho";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Sahi email likho";
        }
    }

    // Password check
    if (empty($_POST["password"])) {
        $passwordErr = "Password likho";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 6) {
            $passwordErr = "Password kam se kam 6 character ka hona chahiye";
        } elseif (strlen($password) > 8) {
            $passwordErr = "Password 8 character se bada nahi hona chahiye";
        }
    }

    // Confirm password check                                               
    if (empty($_POST["confirm_password"])) {
        $confirmErr = "Confirm password likho";
    } else {
        $confirm_password = $_POST["confirm_password"];
        if ($password != $confirm_password) {
            $confirmErr = "Password match nahi kar raha";
        }
    }

    // gender ko set karna kai liye
    if (empty($_POST["gender"])) {
        $genderErr = "Gender select karo";
    } else {
        $gender = $_POST["gender"];
    }

    // ya muja dusra page pai le jaye ga jaha name aur baki cheza dikhi jayengi
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmErr) && empty($genderErr)) {
        echo "<h2>Form Successfully Submitted!</h2>";
        echo "<b>Name:</b> $name <br>";
        echo "<b>Email:</b> $email <br>";
        echo "<b>Gender:</b> $gender <br>";
        echo "<b>Password:</b> $password <br>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Beginner Form</title>
    <style>
        .error {color:red;}
    </style>
    <script>
        function togglePassword(id) {
            let field = document.getElementById(id);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script>
</head>
<body>

<h2>Registration Form</h2>
<form method="post" action="">
    Name: 
    <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error"><?php echo $nameErr; ?></span><br><br>

    Email: 
    <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error"><?php echo $emailErr; ?></span><br><br>

    Password: 
    <input type="password" name="password" id="password" maxlength="8">
    <input type="checkbox" onclick="togglePassword('password')"> Show
    <span class="error"><?php echo $passwordErr; ?></span><br><br>

    Confirm Password: 
    <input type="password" name="confirm_password" id="confirm_password" maxlength="8">
    <input type="checkbox" onclick="togglePassword('confirm_password')"> Show
    <span class="error"><?php echo $confirmErr; ?></span><br><br>

    Gender:
    <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked";?>> Male
    <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked";?>> Female
    <input type="radio" name="gender" value="Other" <?php if($gender=="Other") echo "checked";?>> Other
    <span class="error"><?php echo $genderErr; ?></span><br><br>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>

</body>
</html>
