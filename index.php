<?php 
include 'includes/server.php';
?>

<!DOCTYPE html>
<html>
<?php 
$page_title = "BookShare";
include "includes/head.php";
?>

<body>
  <?php include "includes/navbar.php"; ?>
  <section class="probootstrap-hero probootstrap-xs-hero probootstrap-hero-colored">
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-left probootstrap-hero-text">
          <?php  if (!isset($_SESSION['email'])) : ?>
            <h1>Borrow or lend books here!</h1>
            <p><q>You are not done with a book until you pass it to another reader.</q> - Donalyn Miller</p>
            <?php else: ?>
              <h1>Search your favourite books!</h1>
              <p><q>You are not done with a book until you pass it to another reader.</q> - Donalyn Miller</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <section class="probootstrap-hero">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center probootstrap-hero-text pb0 probootstrap-animate" data-animate-effect="fadeIn">

            <?php  if (!isset($_SESSION['email'])) : ?>
              <p>
                <div class="col-md-offset-1 col-md-10"> 
                  <ul class="nav nav-fill nav-tabs" id="myTab" role="tablist" ata-animate-effect="fadeIn" >
                    <li class="nav-link-index active">
                      <a class="" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false" >Log In To Your Account</a>
                    </li>
                    <li class="nav-link-index">
                      <a class="" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Create An Account</a>
                    </li>
                  </ul>
                </div>
              </p>

              <!-- Tab content -->

              <!-- Log in tab -->
              <div class="tab-content col-md-offset-2 col-md-8 row">
                <div class="tab-pane active" id="login" role="tabpanel" aria-labelledby="signup-tab">
                  <form action="index.php" method="POST" class="probootstrap-form">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $email ?>">
                    </div> 
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Password" name="password" >
                    </div> 
                    <div class="form-group clearfix mb40">
                      <label for="remember" class="probootstrap-remember"><input type="checkbox" id="remember"> Remember Me</label>
                      <a href="#" class="probootstrap-forgot float-right block">Forgot Password?</a>
                    </div>
                    <?php include "includes/errors.php" ?>
                    <div class="form-group text-left">
                      <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                          <input type="submit" name="login" class="btn btn-primary" value="Log In">
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- Sign up tab -->
                <div class="tab-pane" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                  <form method="POST" action="index.php" class="probootstrap-form">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="First Name" name="fname" value="<?= $first_name ?>">
                    </div> 
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Last Name" name="lname"  value="<?= $last_name ?>">
                    </div> 
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $email ?>">
                    </div> 
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Password" name="password" >
                    </div> 
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Re-type Password" name="repeatpw" >
                    </div> 
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Address" name="address" value="<?= $address ?>">
                    </div> 
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="City" name="city" value="<?= $city ?>">
                    </div>
                    <div class="form-group clearfix mb40">
                      <label for="remember" class="probootstrap-remember"><input type="checkbox" id="remember01">Remember Me</label>
                    </div>
                    <?php include "includes/errors.php" ?> 
                    <div class="form-group text-left">
                      <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                          <input type="submit" class="btn btn-block btn-primary" name="register" value="Sign Up">
                        </div>
                      </div>
                    </div>                   
                  </form>
                </div>
              </div>

              <?php else: ?>
                <?php include "includes/searchForm.php" ?>
              <?php endif; ?>
            </div>
          </div>

          <!-- ##### Latest Books Area Start ##### -->

          <div class="row">
            <div class="col-md-12 section-heading probootstrap-animate text-center">
              <h2 id="latest">Latest Books</h2>
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
          </div>   
        </div>
      </section>

      <section class="probootstrap-cta">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2 class="probootstrap-animate" data-animate-effect="fadeInRight">We'd like to help and talk with you</h2>
              <a href="#" role="button" class="btn btn-primary btn-lg btn-ghost probootstrap-animate" data-animate-effect="fadeInLeft">Contact Us</a>
            </div>
          </div>
        </div>
      </section>

      <?php 
      include "includes/footer.php";
      ?>

    </body>
    </html>