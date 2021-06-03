<?php
require_once 'config/config.php';
$errors = ['name' => '', 'email' => '', 'phone' => '', 'password' => '', 'cpassword' => ''];

$name = $email = $phone = $password = $cpassword = '';
if (isset($_POST['register'])) {
    // check name
    if (empty($_POST['name'])) {
        $errors['name'] = 'name should not be empty';
    } else {
        $name = htmlspecialchars($_POST['name']);
    }

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email should not be empty';
    } else {
        $email = htmlspecialchars($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please provide a valid email';
        }
    }

     // check phone
    if (empty($_POST['phone'])) {
        $errors['phone'] = 'phone should not be empty';
    } else {
        $phone = htmlspecialchars($_POST['phone']);
    }

    // check password
    if (empty($_POST['cpassword'])) {
        $errors['cpassword'] = 'Password should not be empty';
    } else {
        $password = htmlspecialchars($_POST['password']);
        $cpassword = htmlspecialchars($_POST['cpassword']);
        // check if asssword is equal to confirm password
        if ($password != $cpassword) {
            $errors['password'] = 'Passwords do not match. Please try again';
            $errors['cpassword'] = 'Passwords do not match. Please try again';
        }
    }

    // check confirm password
    if (empty($_POST['cpassword'])) {
        $errors['cpassword'] = 'Confirm-Password should not be empty';
    } else {
        $cpassword = htmlspecialchars($_POST['cpassword']);
    }

    // Check if no more errors
    if (!array_filter($errors)) {
        // check if email already exists
        $sql = "SELECT * FROM users WHERE email=:email LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        if($stmt->rowCount()){
            $errors['email'] = 'Email already exists. Please try a new one';
        } else {
            // hash the password
            $password = md5($password);
            // save the data to the database
            $sql = "INSERT INTO users (name, email, phone, password) VALUE(:name, :email, :phone ,:password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
            ]);
            $lastId = $conn->lastInsertId();
            // select the newly registered user and store it in a session
            $sql = "SELECT * FROM users WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $run = $stmt->execute(['id' => $lastId]);
            $user = $stmt->fetch();
            if ($run) {
                $_SESSION['user'] = $user;
                header('Location: index.php');
            }
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
            <form name="myForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit = "return(ValidationEvent());" method="POST">
                <h1>Register Here</h1>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $name ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['name']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $email ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['email']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['phone']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $password ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['password']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm-Password</label>
                    <input type="password" name="cpassword" id="cpassword" value="<?php echo $cpassword ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['cpassword']; ?>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-info" name="register">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function ValidationEvent() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var password = document.getElementById("password").value;
        var cpassword = document.getElementById("cpassword").value;

        var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var phoneformat = /^\d{10}$/;

        // Name
        if (name == null || name == "") {
            alert("Please enter the name.");
            document.myForm.name.focus() ;
            return false;
        }

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

        // Phone
        if (phone == null || phone == "") {
            alert("Please enter the phone.");
            document.myForm.phone.focus() ;
            return false;
        }

        // phone format
        if(!phone.match(phoneformat)) {
            alert("Please enter 10 digit phone.");
            document.myForm.phone.focus() ;
            return false;
        }

        // Password
        if (password == null || password == "") {
            alert("Please enter the password.");
            document.myForm.password.focus() ;
            return false;
        }

        // confirm password
        if (cpassword == null || cpassword == "") {
            alert("Please enter the cpassword.");
            document.myForm.cpassword.focus() ;
            return false;
        }

        // password match
        if (password != cpassword) {
            alert("Password not match.");
            document.myForm.password.focus() ;
            return false;
        }
    }
</script>

<?php include('includes/footer.php') ?>