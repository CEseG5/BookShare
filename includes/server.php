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
  if (empty($first_name)) { array_push($errors, "First Name is required"); }
  if (empty($last_name)) { array_push($errors, "Last Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); } 
  if (empty($repeat_password)) { array_push($errors, "Password is required"); }  
  if (empty($password)) { array_push($errors, "Password verification is required"); }
  if (empty($address)) { array_push($errors, "Address is required"); }
  
  if ($password != $repeat_password) {
	array_push($errors, "Password doesn't match");
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

?>