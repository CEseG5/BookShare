<?php 
include 'includes/server.php';
?>

<!DOCTYPE html>
<html>
<?php 
$page_title = "Contact";
include "includes/head.php";
?>

<body>
  <?php include "includes/navbar.php"; ?>
  <section class="probootstrap-hero probootstrap-xs-hero probootstrap-hero-colored">
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-left probootstrap-hero-text">
          <h1 class="probootstrap-animate" data-animate-effect="fadeIn">Contact Us</h1>
          <p class="probootstrap-animate" data-animate-effect="fadeIn">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="probootstrap-section probootstrap-bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-3 col-md-6 probootstrap-animate" data-animate-effect="fadeIn">
          <h2>Drop us a line</h2>
          <form action="#" method="post" class="probootstrap-form">
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" id="subject" name="subject">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea cols="30" rows="10" class="form-control" id="message" name="message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-lg" id="submit" name="submit" value="Submit Form">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  
  <?php 
  include "includes/footer.php";
  ?>
  
</body>
</html>