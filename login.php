<?php
require_once 'config/config.php';
$errors = [ 'email' => '', 'password' => '', 'invalidLogin' => ''];
$errorLogin = '';
$email = $password = '';
if (isset($_POST['login'])) {
    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email should not be empty';
    } else {
        $email = htmlspecialchars($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please provide a valid email';
        }
    }

    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password should not be empty';
    } else {
        $password = htmlspecialchars($_POST['password']);
    }


    // Check if no more errors
    if (!array_filter($errors)) {
        // hash password
        $password = md5($password);
        // check if email already exists
       $sql = "SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1";
       $stmt = $conn->prepare($sql);
       $stmt->execute([
           'email' => $email,
           'password' => $password
       ]);

       $user = $stmt->fetch();
       if(!$user) {
        $errorLogin = 'Invalid credentials';
       }

       if($stmt->rowCount()){
        $_SESSION['user'] = $user;
        header('location: index.php');
       }
    }
}

if(isset($_SESSION['user'])){
    header('location: index.php');
}


?>

<?php include('includes/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="text-danger">
                <?php if($errorLogin){ echo $errorLogin; } ?>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit = "return(ValidationEvent());" method="POST">
                <h1>Login Here</h1>
                <div class="form-group">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $email ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['email']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $password ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['password']; ?>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
     function ValidationEvent() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        // Email
        if (email == null || email == "") {
            alert("Please enter the email.");
            document.myForm.email.focus() ;
            return false;
        }

        // valid email format
        if(!email.match(emailformat)) {
            alert("Invalid email format.");
            document.myForm.email.focus() ;
            return false;
        }

        // Password
        if (password == null || password == "") {
            alert("Please enter the password.");
            document.myForm.password.focus() ;
            return false;
        }
     }
</script>

<?php include('includes/footer.php') ?>