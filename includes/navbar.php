<!-- Fixed navbar -->
<!-- navbar-fixed-top  -->

<nav class="navbar probootstrap-megamenu navbar-default probootstrap-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" title="BookShare Logo">BookShare</a>
    </div>

    <div id="navbar-collapse" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="faq.php">FAQ</a></li>
        <li><a href="contact.php">Contact</a></li>

        <?php  if (isset($_SESSION['email'])) : ?>
          <li><a href="profile.php">Profile</a></li>
          <li class="probootstra-cta-button last"><a href="index.php?logout='1'"  class="btn btn-ghost">Log Out</a></li>
          <?php else: ?>
            <li class="probootstra-cta-button"><a href="#" class="btn" data-toggle="modal" data-target="#loginModal">Log in</a></li>
            <li class="probootstra-cta-button last"><a href="#" class="btn btn-ghost" data-toggle="modal" data-target="#signupModal">Sign up</a></li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>

  <?php include 'includes/errors.php'; ?>
  <?php include 'includes/logout.php'; ?>
