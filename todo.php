<?php
    require_once 'config/config.php';

    $errors = ['name' => '', 'email' => '', 'phone' => ''];

    $name = $email = $phone = '';

    $user = '';
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }else{
        header('location: login.php');
    }

    // print_r($_SESSION['user']->id);          //session user id

    $sql = "SELECT * FROM users WHERE id=:id LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $_SESSION['user']->id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);               //login user info

    if (isset($_POST['todo_insert'])) {
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

        // Check if no more errors
        if (!array_filter($errors)) {
            if (!empty($_POST)) {
                $user_id    = $result['id'];
                $name       = isset($_POST['name']) ? $_POST['name'] : '';
                $email      = isset($_POST['email']) ? $_POST['email'] : '';
                $phone      = isset($_POST['phone']) ? $_POST['phone'] : '';

                $sql = "INSERT INTO todo (user_id, name, email, phone) VALUE(:user_id, :name, :email, :phone)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    'user_id'   => $_SESSION['user']->id,
                    'name'      => $name,
                    'email'     => $email,
                    'phone'     => $phone,
                ]);
                $lastId = $conn->lastInsertId();
                // select the newly registered user and store it in a session
                $sql = "SELECT * FROM users WHERE id=:id";
                $stmt = $conn->prepare($sql);
                $run = $stmt->execute(['id' => $lastId]);
                $user = $stmt->fetch();
                if ($run) {
                    // $_SESSION['user'] = $user;
                    header('Location: index.php');
                }
            }
        }
    }

?>

<?php include('includes/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <form name="myForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit = "return(ValidationEvent());" method="POST">
                
                <h1>Insert ToDo by - <?php 
                    if(isset($result['name'])) {
                        echo $result['name'];
                    } else {
                        echo 'User Deleted';
                    }
                ?></h1>

                <?php
                if(isset($result['name'])) { ?>
                    <div class="form-group">
                        <input type="hidden" name="u_id" id="u_id" value="<?php echo $result['id'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?php //echo $name ?>" class="form-control">
                        <div class="text-danger">
                            <?php //echo $errors['name']; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php //echo $email ?>" class="form-control">
                        <div class="text-danger">
                            <?php //echo $errors['email']; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Phone</label>
                        <input type="text" name="phone" id="phone" value="<?php //echo $phone ?>" class="form-control">
                        <div class="text-danger">
                            <?php //echo $errors['phone']; ?>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-info" name="todo_insert">ToDo</button>
                    </div>
                <?php } else {
                    echo 'User Does not exists';
                }
                ?>
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

<?php include('includes/footer.php') ?>