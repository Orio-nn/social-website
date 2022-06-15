<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];

    require_once '../functions.php';
    require_once '../config.php';

    if (EmptyInputSignup($username, $email, $password, $passwordRepeat) !== false) {
        header("location: ../register?error=Please fill in all fields!");
        exit();
    }
    if (InvalidUsername($username) !== false) {
        header("location: ../register?error=Username contains forbidden characters.");
        exit();
    }
    if (InvalidEmail($email) !== false) {
        header("location: ../register?error=Email is invalid!");
        exit();
    }
    if (InvalidPasswordMatch($password, $passwordRepeat) !== false) {
        header("location: ../register?error=Your passwords do not match!");
        exit();
    }
    if (UsernameExists($conn, $username) !== false) {
        header("location: ../register?error=Username taken! Try a different name!");
        exit();
    }

    CreateUser($conn, $username, $email, $password);
} else {
    header('location: ../register?error=Access Denied!');
}