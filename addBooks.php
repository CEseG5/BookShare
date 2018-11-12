<?php 
include 'includes/server.php';
?>

<!DOCTYPE html>
<html>
<?php 
$page_title = "Add Books";
include "includes/head.php";
?>

<body>
  <?php 
  include "includes/navbar.php"; ?>
  <section class="probootstrap-hero probootstrap-xs-hero probootstrap-hero-colored">
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-left probootstrap-hero-text">
          <h1 class="probootstrap-animate" data-animate-effect="fadeIn">Register book</h1>
          <!--  -->
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
           <h2>Register Form</h2>
           <p>Please enter required info, to register books</p>
         </div>
         <form id="Register" method="POST">
          <div class="form-group">
            <label for='isbn'>Enter Book ISBN</label>
            <input type="text" name="isbn" class="form-control" id="inputISBN" placeholder="ISBN">
          </div>
          <div class="form-group">
            <label for="author">Enter Author Name</label>
            <input type="text" name="author" class="form-control" id="inputAuthor" placeholder="Author">
          </div>
          <div class="form-group">
            <label for="title">Enter Book Title</label>
            <input type="text" class="form-control" id="inputTitle" placeholder="Title">
          </div>        
          <div class="centerAlign">
            <button type="submit" class="btn btn-primary">Register</button></div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script src="js/scripts.min.js"></script>
  <script src="js/custom.min.js"></script>

  <?php 
  include "includes/footer.php";
  ?>

</body>
</html> 
