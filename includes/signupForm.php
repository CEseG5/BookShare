<!-- Modal signup -->
<?php include('server.php');
      include('errors.php');
?>
<div class="modal fadeInUp probootstrap-animated" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-md vertical-align-center">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
        <div class="probootstrap-modal-flex">
          <div class="probootstrap-modal-figure" style="background-image: url(img/modal_bg.jpg);"></div>
          <div class="probootstrap-modal-content">
            <form method="POST" action="index.php" class="probootstrap-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="First Name" name="fname" required>
              </div> 
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Last Name" name="lname" required>
              </div> 
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email" name="email">
              </div> 
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
              </div> 
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Re-type Password" name="repeatpw" required>
              </div> 
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Address" name="address" required>
              </div> 
              <div class="form-group">
                <input type="text" class="form-control" placeholder="City" name="city" required>
              </div> 
              <div class="form-group text-left">
                <div class="row">
                  <div class="col-md-6">
                    <input type="submit" class="btn btn-primary btn-block" name="submit" value="Sign Up">
                  </div>
                </div>
               </div>                   
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END modal signup -->
