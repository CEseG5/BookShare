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
  $city = $_POST['city'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($first_name) || empty($last_name) || empty($email) || empty($repeat_password) || empty($password) || empty($address) || ($city == 0)){ array_push($errors, "Please fill in all fields."); }
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

    if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/', $password)){
      array_push($errors, "Password is not valid");
    }

  }

  // first check the database to make sure a user does not already exist with the same email
  $user_check_query = "SELECT * FROM users WHERE email='$email'";
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

  	$query = "INSERT INTO users (first_name, last_name, email, password, address, city_id) 
  			   VALUES('$first_name', '$last_name', '$email','$password','$address','$city')";
  	mysqli_query($connection, $query);
  	$_SESSION['email'] = $email;
    $_SESSION['id'] = mysqli_insert_id($connection);
    header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }else {
    if(!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $email)){
      array_push($errors, "Email is not valid");
    }
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }else {
     if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/', $password)){
      array_push($errors, "Password is not valid");
    }
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($results);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['id'] = $row['id'];
      header('location: index.php');
    }else {
      array_push($errors, "Wrong email/password combination");
    }
  }
}

// LOG OUT USER
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['email']);
  header("location: index.php");
} 

// CHANGE PASSWORD

  $old_password = "";
  $new_password = "";
  $confirm_password = "";


  if(isset($_POST['change_pw'])){
    if(empty($_POST['oldpw']) || empty($_POST['oldpw'])){
      array_push($errors, "<div class='alert alert-danger' role='alert'> Old Password field cannot be empty! </div>");
    }else{
        $old_password = mysqli_real_escape_string($connection, $_POST['oldpw']);
    }
    if(!isset($_POST['newpw']) || $_POST['newpw'] == ""){
      array_push($errors, "<div class='alert alert-danger' role='alert'> New Password field cannot be empty! </div>");
    }elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/', $_POST['newpw'])){
      array_push($errors, "<div class='alert alert-danger' role='alert'> New Password requires at least 6 characters, Uppercase & a number </div>");
    }
    else{
        $new_password = mysqli_real_escape_string($connection, $_POST['newpw']);
    }
    if(!isset($_POST['cmpw']) || $_POST['cmpw'] == ""){
      array_push($errors, "<div class='alert alert-danger' role='alert'> Confirm Password field cannot be empty! </div>");
    }else{
        $confirm_password = mysqli_real_escape_string($connection, $_POST['cmpw']);
    }
    if(count($errors) == 0){
      
      $password_row_query = "SELECT * from users where email = '{$_SESSION['email']}'";

      $result_pw = mysqli_query($connection, $password_row_query);
      
      while($row_pw = mysqli_fetch_assoc($result_pw)){
        $stored_pw = $row_pw['password'];
        $email_placeholder = $row_pw['email'];
      }
      var_dump($stored_pw);
      if(md5($old_password) != $stored_pw){
        array_push($errors, "<div class='alert alert-danger' role='alert'> Your input doesn't match with your old password! </div>");
      }
      if($new_password != $confirm_password){
        array_push($errors, "<div class='alert alert-danger' role='alert'> New password and Confirm password fields do not match! </div>");
      }else{
        $new_stored_pw = md5($new_password);
      }
    }
    if(count($errors) == 0){
      $update_password = "UPDATE users set password = '{$new_stored_pw}' where email = '{$_SESSION['email']}'";
      mysqli_query($connection, $update_password);
      //session_destroy();
      unset($_SESSION['email']);
      session_destroy();
    }
  }

?>
