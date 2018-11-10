<?php 
    include "includes/head.php";
    include "includes/navbar.php";
 ?>

<!DOCTYPE html>
<html>
<body>
  <section class="probootstrap-hero">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 text-center probootstrap-hero-text pb0 probootstrap-animate" data-animate-effect="fadeIn">
          <h1>Share your books!</h1>
          <p>
            <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal">Log In</a>
            <a href="#" class="btn btn-primary btn-ghost btn-lg" data-toggle="modal"  data-target="#signupModal">Sign Up</a>
          </p>
        </div>
      </div>
    
      <!-- ##### Latest Books Area Start ##### -->

      <div class="row">
        <div class="col-md-12 section-heading probootstrap-animate text-center">
          <h2>Latest Books</h2>
          <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
          <div class="row">
            <div class="col-lg-2 col-sm-4">
              <div class="thumbnail">
                <img class="img-thumbnail" src="img\img_01_book.jpg">
                <p class="text-sm-left">Title</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-4">
              <div class="thumbnail">
                <img class="img-thumbnail" src="img\img_02_book.jpg">
                <p class="text-sm-left">Title</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-4">
              <div class="thumbnail">
                <img class="img-thumbnail" src="img\img_03_book.jpg">
                <p class="text-sm-left">Title</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-4">
              <div class="thumbnail">
                <img class="img-thumbnail" src="img\img_04_book.jpg">
                <p class="text-sm-left">Title</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-4">
              <div class="thumbnail">
                <img class="img-thumbnail" src="img\img_05_book.jpg">
                <p class="text-sm-left">Title</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-4">
              <div class="thumbnail">
                <img class="img-thumbnail" src="img\img_06_book.jpg">
                <p class="text-sm-left">Title</p>
              </div>
            </div>
        </div>

        <!-- ##### Latest Books Area End ##### -->    
      </div>   
  </section>

  <section class="probootstrap-cta">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="probootstrap-animate" data-animate-effect="fadeInRight">We'd like to help and talk with you</h2>
          <a href="contact.php" role="button" class="btn btn-primary btn-lg btn-ghost probootstrap-animate" data-animate-effect="fadeInLeft">Contact Us</a>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
<?php 
  include "includes/signupForm.php";
  include "includes/loginForm.php";
  include "includes/footer.php";
?>