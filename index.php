<?php 
include 'includes/server.php';
?>

<!DOCTYPE html>
<html>
<?php 
$page_title = "BookShare";
include "includes/head.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src="js/book_requests.js"></script>
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
        <?php  if (!isset($_SESSION['email'])) : ?>              
          <div class="col-md-8 col-md-offset-2 text-center probootstrap-hero-text pb0 probootstrap-animate" data-animate-effect="fadeIn">
           <!-- BEFORE LOGIN STARTS HERE -->
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
            <div class="tab-content col-md-offset-2 col-md-8 row">
              <!-- Log in tab -->
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
              <!-- Login tab ends here -->

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
                    <input type="text" class="form-control" placeholder="Address" name="address" value="<?= $address ?>" id="city_address">
                  </div> 
                  <div class="form-group">
                    <select class="custom-select" name="city">
                      <option value="">City</option>
                      <?php
                      $query = "select * from cities";
                      $result = mysqli_query($connection, $query);
                      while ($row = mysqli_fetch_assoc($result)){
                        echo "<option value='{$row['id']}'>".$row['name']."</option>";
                      }
                      ?>
                    </select>
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
              <!-- Signup tab ends here -->
            </div>
            <!-- Tab content ends here -->
            <!-- BEFORE LOGIN ENDs HERE -->

            <?php else: ?>
              <div class="row">                   
                <div class="col-md-12 text-center probootstrap-hero-text pb0 probootstrap-animate" data-animate-effect="fadeIn">
                  <?php include "includes/searchForm.php"?>
                </div>
              </div>
            <?php endif; ?>
          </div>
          
          <!--  Latest Books Area Start  -->

          <div class="row">
            <div class="col-md-12 section-heading probootstrap-animate text-center">
              <h2 id="latest">Latest Books</h2>
              <div class="row">
                <?php 
                  $userLoggedIn = !isset($_SESSION['id']) ? "" :  "where  ub.user_id != '{$_SESSION['id']}' ";
                  $query = "SELECT u.id,b.img_name, b.author, ub.user_id, ub.book_id, c.name, u.address FROM books b join user_books ub on b.isbn = ub.book_id join users u on ub.user_id = u.id join cities c on c.id = u.city_id $userLoggedIn order by ub.date_registered DESC LIMIT 6 ";
                  $result = mysqli_query($connection, $query);
                  $hidden = !isset($_SESSION['email']) ? "hidden" : "" ;
                  
                  $id_borrower = "";
                  if(isset($_SESSION['id'])){
                    $id_borrower = $_SESSION['id'];
                  }
                  while ($row = mysqli_fetch_assoc($result)){
                    
                    $user_id = $row['id'];
                    $city_address = $row['name'].' '.$row['address'];
                    $book_id = $row['book_id'];
                    echo "<div class='col-md-2 col-sm-4'><div class='thumbnail'>";
                    echo "<img class='img-thumbnail  m-5 p-5' src='img/".$row['img_name']."'>";
                    echo "<p class='mh-100 pt-3' style= 'height: 30px; max-height: 100px'>".$row['author']."</p>";
                    echo "<div class='panel-footer $hidden'><a role='button' data-toggle='modal' data-target='#rentModal' data-session='$id_borrower' book-id='$book_id' data-city='$city_address' class='rent_book' data-id='$user_id' >Rent</a></div></div></div>"; 
                  }
                ?>
                
                </div>
              </div>
            </div>
          </div>
          

          <div class="container message alert col-md-offset-5" style="color:green" id="message"></div>
          <!--  Latest Books Area End  -->
      <?php include 'includes/requestForm.php' ?>
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
