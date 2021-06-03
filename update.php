<?php
require_once 'config/config.php';
include('includes/header.php');

$user = '';
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}else{
    header('location: login.php');
}

$errors = ['name' => '', 'email' => '', 'phone' => ''];
$name = $email = $phone = $msg = '';

// Get the user from the users table
$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_GET['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    exit('user doesn\'t exist with that ID!');
}

if (isset($_POST['update_user'])) {
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
    } 
    if(strlen( $_POST['phone']) < 10){
        $errors['phone'] = 'phone not contains any characters with minimum 10 digits';
    } else {
        $phone = htmlspecialchars($_POST['phone']);
    }

    if (!array_filter($errors)) {
        if (!empty($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

            $stmt = $conn->prepare('UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?');
            $stmt->execute([$name, $email, $phone, $_GET['id']]);
            $msg = 'Updated Successfully!';
            echo '<script type="text/javascript">alert("'.$msg.'");</script>';
            header('Location: index.php');
        }
    }
}

// $msg = '';
// // Check if the contact id exists, for example update.php?id=1 will get the user with the id of 1
// if (isset($_GET['id'])) {
//     if (!empty($_POST)) {
//     	// print_r($_POST);
//     	// exit('demon');
//     	$id = isset($_POST['id']) ? $_POST['id'] : NULL;
//         $name = isset($_POST['name']) ? $_POST['name'] : '';
//         $email = isset($_POST['email']) ? $_POST['email'] : '';
//         $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
//         // Update the record

//         $stmt = $conn->prepare('UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?');
//         $stmt->execute([$name, $email, $phone, $_GET['id']]);
//         $msg = 'Updated Successfully!';
//         echo '<script type="text/javascript">alert("'.$msg.'");</script>';
//         header('Location: index.php');
//     }

//     // Get the user from the users table
//     $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
//     $stmt->execute([$_GET['id']]);
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);
//     if (!$user) {
//         exit('user doesn\'t exist with that ID!');
//     }
// } else {
//     exit('No ID specified!');
// }
?>

<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <form name="myForm" action="update.php?id=<?=$user['id']?>" method="POST" onsubmit = "return(ValidationEvent());">
                <h1>Update User</h1>
                <div class="text-success">
                    <?php if($msg) {echo $msg;} ?>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?=$user['name'] ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['name']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?=$user['email'] ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['email']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?=$user['phone'] ?>" class="form-control">
                    <div class="text-danger">
                        <?php echo $errors['phone']; ?>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-info" name="update_user">UPDATE</button>
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
    }
</script>