<?php
session_start();

// initializing variables
$first_name = '';
$last_name = '';
$email = '';
$password = '';
$repeat_password = '';
$address = '';
$city =  '';

$errors = array();

// connect to the database
$connection = mysqli_connect('localhost', 'root', '', 'bookshare');

// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $first_name = mysqli_real_escape_string($connection, $_POST['fname']);
  $last_name = mysqli_real_escape_string($connection, $_POST['lname']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  $repeat_password = mysqli_real_escape_string($connection, $_POST['repeatpw']);
  $address = mysqli_real_escape_string($connection, $_POST['address']);
  $city = mysqli_real_escape_string($connection, $_POST['city']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($first_name) && empty($last_name) && empty($email) && empty($repeat_password) && empty($password) && empty($address) ) { array_push($errors, "Please fill in all fields."); }
  else {
    if ($password != $repeat_password) {
       array_push($errors, "Password doesn't match");
    }
    if(!preg_match('/^[A-Z][a-zA-Z]{3,}(?: [A-Z][a-zA-Z]*){0,2}$/',$first_name)){
      array_push($errors, "Invalid first name given!");
    }

    if(!preg_match('/^[A-Z][a-zA-Z]{2,}(?: [A-Z][a-zA-Z]*){0,2}$/',$last_name)){
      array_push($errors, "Invalid last name given!");
    } 

    if(!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $email)){
      array_push($errors, "Email is not valid");
    }

    //  if(!preg_match('', $password)){
    //   array_push($errors, "Password must be ..");
    // }

  }


  // first check the database to make sure 
  // a user does not already exist with the same email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($connection, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (first_name, last_name, email, password, address, city) 
  			   VALUES('$first_name', '$last_name', '$email','$password','$address','$city')";
  	mysqli_query($connection, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($connection, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $email;
      // $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }else {
      array_push($errors, "Wrong email/password combination");
    }
  }
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['email']);
  header("location: index.php");
} 

?>