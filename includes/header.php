<?php require_once 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <!-- <link rel="customStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-light    bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Authentication</a>
            <button onclick="history.go(-1);">Back </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse float-right" id="navbarNav nav_menu">
                <ul class="navbar-nav">
                    <?php if(isset($_SESSION['user'])):?>
                        <form action="logout.php" method="POST">
                            <button type="submit" name="logout">Logout</button>
                        </form>
                    <?php else: ?>
                        <li><a href="login.php" class="nav-link">Login</a></li>
                        <li><a href="register.php" class="nav-link">Register</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav> -->

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