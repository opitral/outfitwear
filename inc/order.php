<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once("connect.php");

    $id = sprintf("%08d", rand(0, 99999999));
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];
    $post = $_POST["post"];

    $result = mysqli_query($connect, "INSERT INTO `orders` (`id`, `name`, `phone`, `city`, `post`) VALUES ('{$id}', '{$name}', '{$phone}', '{$city}', '{$post}')");

    echo $_COOKIE["cart"];
    unset($_COOKIE["cart"]);
    // echo $_COOKIE["cart"];

    // header("Location: ../cart.php");
?>