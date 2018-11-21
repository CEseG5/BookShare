<?php 
include 'includes/server.php';
require 'includes/required.php';
?>
<?php 
$page_title = "My Account";
include "includes/head.php";
?>
<body>
  <?php 
  include "includes/navbar.php"; ?>
  <section class="probootstrap-hero probootstrap-xs-hero probootstrap-hero-colored">
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-left probootstrap-hero-text">
          <h1 class="probootstrap-animate" data-animate-effect="fadeIn">My Profile <p>update Basic info</p></h1>
        </div>
      </div>
    </div>
  </section>
  <section class="probootstrap-section probootstrap-bg-white">
    <div class="container probootstrap-animate">
      <!-- form here  -->
      <div class="register-form">
        <div class="main-div">
          <div class="panel centerAlign">
           <h2>Update Form</h2>
           <p>Fill in the form to update your profile!</p>  
           
           <?php 
           $loggedin = $_SESSION['email'];
           $query = "select * from users where email = '$loggedin'";
           $result = mysqli_query($connection, $query);
           $first_name = '';
           $last_name = '';

           while($row = mysqli_fetch_assoc($result)){
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
          }

          $newName = '';
          $newLastName = '';
          $errors = array();

          if(isset($_POST['update_profile'])){
            $newName = mysqli_real_escape_string($connection,$_POST['nfname']);
            $newLastName = mysqli_real_escape_string($connection,$_POST['nlastname']);
            if (empty($newName) && empty($newLastName)) { 
              array_push($errors, "you cannot leave empty fields!"); 
            }else {
             if(!preg_match('/^[A-Z][a-zA-Z]{2,}(?: [A-Z][a-zA-Z]*){0,2}$/',$newName)){
              array_push($errors, "Invalid first name given!");
            }
            if(!preg_match('/^[A-Z][a-zA-Z]{2,}(?: [A-Z][a-zA-Z]*){0,2}$/',$newLastName)){
              array_push($errors, "Invalid last name given!");
            } 
          }
          if (count($errors) == 0) {      
            $sql   = "UPDATE users SET first_name='{$newName}', last_name = '{$newLastName}' WHERE email ='{$loggedin}'";
            $res  = mysqli_query($connection,$sql) or die("Could not update ".mysqli_error($connection)); 
            $_SESSION['email'] = $loggedin;
            header('location: profile.php');
          }
        }
        ?>
      </div>

      <form id="Register" method="POST" action="">
        <div class="form-group">
          <label for='isbn'>Enter your name:</label>
          <input type="text" name="nfname" class="form-control" value="<?= $first_name ?>">
        </div>
        <div class="form-group">
          <label for="author">Enter Your last name:</label>
          <input type="text" name="nlastname" class="form-control" value="<?= $last_name ?>">
        </div>
        <?php include "includes/errors.php" ?>      
        <div class="centerAlign">
          <button type="submit" class="btn btn-primary" name="update_profile">Update</button>
        </div>
      </form>
      
    </div>
  </div>  
</div>
</section>
<?php 
include "includes/footer.php";
?>
