<?php
    DEFINE('HOST', 'localhost');
    DEFINE('USERNAME', 'root');
    DEFINE('PASSWORD', '');
    DEFINE('DATABASE', 'magnox');

    // set up DSN
     // SET DSN
    $dsn = 'mysql:host='.HOST . ';dbname='.DATABASE;

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $link = "https";
    else
        $link = "http";
      
    // Here append the common URL characters.
    $link .= "://";
    $link .= $_SERVER['HTTP_HOST'];
    $home_url= $link . '/magnox_task/';

    try {
        $conn = new PDO($dsn, USERNAME, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // for LIMITS

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    session_start();


?>