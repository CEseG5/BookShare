<?php
session_start();

// initializing variables
// username = "";
// $email    = "";

$errors = array();
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'bookshare');

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $first_name = mysqli_real_escape_string($db, $_POST['fname']);
  $last_name = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $repeat_password = mysqli_real_escape_string($db, $_POST['repeatpw']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $city = mysqli_real_escape_string($db, $_POST['city']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($first_name)) { array_push($errors, "First Name field is required"); }
  if (empty($last_name)) { array_push($errors, "Last Name field is required"); }
  if (empty($email)) { array_push($errors, "Email field is required"); } 
  
  if (empty($password)) { array_push($errors, "Password field is required"); }
  if ($password != $repeat_password) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (first_name,last_name, email, password, address, city) 
  			  VALUES('$first_name', '$last_name', '$email','$password','$address','$city')";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: /..index.php');
  }
}