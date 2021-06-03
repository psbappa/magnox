<?php require_once 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="menu">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="<?= $home_url;?>">Home</a>
            </div>
            <div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['user'])):?>
                        <div class="back_log" style="display: flex;">
                            <button class="btn btn-primary ladda-button" data-style="expand-right" onclick="history.go(-1);">Back </button>
                            <form action="logout.php" method="POST">
                                <button class="btn btn-warning ladda-button" type="submit" name="logout">Logout</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <li><a href="login.php" class="nav-link">Login</a></li>
                        <li><a href="register.php" class="nav-link">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>