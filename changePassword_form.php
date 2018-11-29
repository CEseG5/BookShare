<?php 
include 'includes/server.php';
require 'includes/required.php';
?>

<?php 
  $email = $_SESSION['email'];
  $page_title = "My Account";
  include "includes/head.php";
 ?>



<div class="row">
<?php include "includes/navbar.php"; ?>
  
<section class="probootstrap-hero probootstrap-xs-hero probootstrap-hero-colored">
  <div class="container">
    <div class="row">
      <div class="col-md-8 text-left probootstrap-hero-text">
        <h1 class="probootstrap-animate" data-animate-effect="fadeIn">My Profile <p>Change Password</p></h1>
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
        
        <form id="Register" action="#" method="POST">
          <div>
            <?php include 'includes/errors.php' ?>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" disabled value="<?= $email ?>">
          </div>
          
          <div class="form-group">
            <input type="password" name="oldpw" class="form-control" placeholder="Old Password" />
          </div>

          <div class="form-group">
            <input type="password" name="newpw" class="form-control" placeholder="New Password" />
          </div>

          <div class="form-group">
            <input type="password" name="cmpw" class="form-control" placeholder="Confirm Password" />
          </div>

          <input type="submit" class="btn btn-primary" name="change_pw" value="Change Password"/>
        </form>
      </div>
    </div>
  </div>
</div>
</section>

<?php 
include "includes/footer.php";
?>